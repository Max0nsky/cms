<?php

namespace backend\controllers;

use common\models\search\AdministratorSearch;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

class AdministratorController extends AppController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new AdministratorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        // TODO
    }

    public function actionUpdate($id)
    {
        // TODO
    }

    public function actionDelete($id)
    {
        // TODO
    }

    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested Article does not exist.');
    }
}
