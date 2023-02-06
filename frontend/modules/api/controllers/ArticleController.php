<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class ArticleController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Article';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete']);
        unset($actions['create']);

        return $actions;
    }
}
