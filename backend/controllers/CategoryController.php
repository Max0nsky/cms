<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Good;
use common\models\search\CategorySearch;
use common\traits\AjaxTrait;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    use AjaxTrait;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $responseData = [
                'status' => true,
                'content' => [
                    $this->getTextIndex($model->id)
                ]
            ];

            return $this->sendAjaxResponse($responseData);
        }

        $responseData = [
            'status' => false,
            'text' => $model->getFirstErrors()

        ];

        return $this->sendAjaxResponse($responseData);
    }

    public function actionCreateForm()
    {
        $model = new Category();
        $response = [
            'status' => true,
            'content' => $this->renderAjax('create', compact('model'))
        ];

        $this->sendAjaxResponse($response);
    }

    public function actionCategoryTree($id)
    {
        $responseData = [
            'status' => true,
            'content' => [
                $this->getTextIndex($id)
            ]
        ];

        return $this->sendAjaxResponse($responseData);
    }

    public function actionChildren($id)
    {
        $tree = Category::getUpperLevelTree($id);

        if (!empty($tree)) {
            return $this->sendAjaxResponse($tree);
        }

        return $this->sendAjaxResponse([]);
    }


    private function getTextIndex($id)
    {
        $model = $this->findModel($id);

        $responseData = [
            'tree' => $this->renderAjax('_tree', ['id' => $id]),
            'goods' => 'Для начала работы выберите подкатегорию',
            'category' => $this->renderAjax('_cat-edit', compact('model')),
        ];

        if (!empty($model->parent_id)) {
            $query = Good::findWhereFront()->andWhere(['category_id' => $id]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => false,
                'pagination' => false
            ]);
            $responseData['goods'] = $this->renderAjax('goods', compact('dataProvider', 'model'));
        }

        return $responseData;
    }

    public function actionTreeUp($id)
    {
        $result = Category::treeUp($id);
        if ($result) {
            return $this->sendAjaxResponse([
                'status' => true,
                'content' => [
                    ['tree' => $this->renderAjax('_tree', ['id' => $id]),]
                ]
            ]);
        } else {
            return $this->sendAjaxResponse([
                'status' => false,
                'content' => 'Выше некуда'
            ]);
        }
    }

    public function actionTreeDown($id)
    {
        $result = Category::treeDown($id);
        if ($result) {
            return $this->sendAjaxResponse([
                'status' => true,
                'content' => [
                    ['tree' => $this->renderAjax('_tree', ['id' => $id]),]
                ]
            ]);
        } else {
            return $this->sendAjaxResponse([
                'status' => false,
                'content' => 'Ниже некуда'
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
