<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\components\Seo\SeoBehavior;
use Yii;

class ArticleCategory extends AppModel
{
    public $image;

    public static function tableName()
    {
        return 'article_ctegory';
    }

    public function behaviors()
    {
        return [
            'SluggableBehavior' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'immutable' => false,
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
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'visibility', 'is_delete'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg','jpeg', 'png'], 'maxFiles' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'slug' => 'URL',
            'description' => 'Описание',
            'text' => 'Контент',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'visibility' => 'Видимость',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::class, ['article_category_id' => 'id']);
    }

    public static function findWhereFront()
    {
        return self::find()->where(['visibility' => 1, 'is_delete' => 0]);
    }

    public function getLink()
    {
        $link = '/' . $this->slug;
        return $link;
    }
}
