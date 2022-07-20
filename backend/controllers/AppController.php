<?php

namespace backend\controllers;

use common\components\Support\Support;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'update-grid', 'image-delete'],
                        'allow' => true,
                        'roles' => ['canAdmin'],
                    ],
                ],
            ],
        ];
    }
}
