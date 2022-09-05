<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use rico\yii2images\behaviors\ImageBehave;
use common\components\Seo\SeoBehavior;
use paulzi\adjacencyList\AdjacencyListBehavior;
use yii\db\Query;
use Yii;

class Category extends AppModel
{
    public $images;

    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'SluggableBehavior' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'immutable' => true,
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
            'SeoBehavior' => [
                'class' => SeoBehavior::class,
            ],
            'ImageBehave' => [
                'class' => ImageBehave::class,
            ],
            'AdjacencyListBehavior' => [
                'class' => AdjacencyListBehavior::class,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name',], 'required'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['parent_id'], 'integer'],
            [['sort'], 'integer'],
            [['created_at', 'updated_at', 'is_public', 'is_delete'], 'integer'],
            [
                ['images'],
                'file',
                'skipOnEmpty' => true,
                'maxFiles' => 10,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => (10000 * 1024),
                'tooBig' => 'Размер превышает 10MB'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'slug' => 'URL',
            'parent_id' => 'Родительская категория',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'is_public' => 'Видимость',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    public function getChilds()
    {
        return $this->hasMany(self::class, ['parent_id' => 'id']);
    }

    public function getGoods()
    {
        return $this->hasMany(Good::class, ['category_id' => 'id']);
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public static function findWhereFront()
    {
        return self::find()->where(['is_public' => 1, 'is_delete' => 0]);
    }

    public static function getUpperLevelTree($id = null)
    {
        $tree = (new Query())
            ->select(['id AS key', 'name AS title'])
            ->from(self::tableName())
            ->where(['parent_id' => $id])
            ->orderBy(['sort' => SORT_ASC])
            ->all();

        $tree = array_map(function (&$value) {
            if (!empty($value)) {
                $value['folder'] = true;
                $value['lazy'] = true;

                return $value;
            }
        }, $tree);

        return $tree;
    }

    public static function treeUp($id)
    {
        $model = self::findOne($id);

        $up = self::find()
            ->where(['<', 'sort', $model->sort])
            ->limit(1)
            ->andWhere(['parent_id' => $model->parent_id, 'is_delete' => 0])
            ->orderBy(['sort' => SORT_DESC])
            ->one();

        if (!empty($up)) {
            $sort = $model->sort;
            $model->sort = $up->sort;
            $up->sort = $sort;
            $model->save(false);
            $up->save(false);

            self::setSortBrand($model->parent_id);

            return true;
        }
        return false;
    }

    public static function treeDown($id)
    {
        $model = self::findOne($id);

        $up = self::find()
            ->where(['>', 'sort', $model->sort])
            ->andWhere(['parent_id' => $model->parent_id])
            ->limit(1)
            ->orderBy(['sort' => SORT_ASC])
            ->one();

        if (!empty($up)) {
            $sort = $model->sort;
            $model->sort = $up->sort;
            $up->sort = $sort;
            $model->save(false);
            $up->save(false);

            self::setSortBrand($model->parent_id);

            return true;
        }
        return false;
    }

    private static function setSortBrand($parendId)
    {
        $models = self::find()->where(['parent_id' => $parendId])->orderBy(['sort' => SORT_ASC])->all();

        $i = 0;

        foreach ($models as $model) {
            $model->sort = $i;
            $model->save(false);
            $i++;
        }
    }
}
