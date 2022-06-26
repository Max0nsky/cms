<?php

use common\components\Support\Support;
use common\models\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <p>
        <?= Html::a('Добавить новую', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridVieW::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'slug',
            'text_short',
            Support::editableColumn($model, 'visibility', 'Видимость', '/page/update-grid'),
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>