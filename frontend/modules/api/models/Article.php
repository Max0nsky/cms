<?php

namespace frontend\modules\api\models;

use common\models\Article as ModelsArticle;
use Yii;

class Article extends ModelsArticle
{
    public function fields()
    {
        return [
            'id',
            'name',
            'slug',
            'text_short',
            'text',
            'date_created' => function($model){
                return date('d.m.y H:i:s', $model->created_at);
            },
            'date_updated' => function($model){
                return date('d.m.y H:i:s', $model->updated_at);
            },
        ];
    }
}
