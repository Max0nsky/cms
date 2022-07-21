<?php

use common\components\Support\Support;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

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

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            Support::imageColumn(),
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
    
    <?php Pjax::end(); ?>

</div>