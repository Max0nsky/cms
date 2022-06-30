<?php

namespace backend\controllers;

use common\components\Support\Support;
use common\models\ArticleCategory;
use common\models\search\ArticleCategorySearch;
use kartik\grid\EditableColumnAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use Yii;

class ArticleCategoryController extends AppController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ArticleCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->redirect(['index']);
    }

    public function actionCreate()
    {
        $model = new ArticleCategory();

        if ($model->load(Yii::$app->request->post())) {
            $image = \yii\web\UploadedFile::getInstance($model, 'image');

            $model->save();
            $model->uploadImage($image);

            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = \yii\web\UploadedFile::getInstance($model, 'image');

            $model->save();
            $model->uploadImage($image);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ArticleCategory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested ArticleCategory does not exist.');
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'update-grid' => [
                'class' => EditableColumnAction::class,
                'modelClass' => ArticleCategory::class,
                'outputValue' => function ($model, $attribute, $key, $index) {
                    switch ($attribute) {
                        case 'visibility':
                            $result = Support::getListYesNo($model->$attribute);
                            break;
                    }
                    return $result;
                },
            ]
        ]);
    }
}