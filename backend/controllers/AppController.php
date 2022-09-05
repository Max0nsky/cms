<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
