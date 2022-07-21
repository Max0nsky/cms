<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use rico\yii2images\behaviors\ImageBehave;
use common\components\Seo\SeoBehavior;
use Yii;

class Article extends AppModel
{
    public $image;

    public static function tableName()
    {
        return 'article';
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
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['article_category_id', 'created_at', 'updated_at', 'visibility', 'is_delete'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 254],
            [['text_short'], 'string', 'max' => 1000],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg', 'png'], 'maxFiles' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_category_id' => 'Категория',
            'name' => 'Наименование',
            'slug' => 'URL',
            'text_short' => 'Краткое описание',
            'text' => 'Контент',
            'created_at' => 'Добавление',
            'updated_at' => 'Редактирование',
            'visibility' => 'Видимость',
        ];
    }

    public function getArticleCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'article_category_id']);
    }

    public static function findWhereFront()
    {
        return self::find()->where(['visibility' => 1, 'is_delete' => 0]);
    }

    public function getLink()
    {
        $link = "/" . $this->slug;

        if (!empty($this->articleCategory)) {
            $link = "/" . $this->articleCategor->slug . $link;
        }

        return $link;
    }
}
