<?php

use common\components\Support\Support;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <div class="row head-page-content">
        <div class="col-sm-10">
            <h1> <?= $this->title ?> </h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-primary create-btn']) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img(Url::toRoute($model->getImage()->getPath('80x')), [
                        'style' => 'width:80px;'
                    ]);
                },
            ],
            'name',
            'slug',
            'text_short',
            Support::editableColumn($model, 'visibility', 'Видимость', '/article/update-grid'),
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>