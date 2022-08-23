<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = 'Редактирование страницы: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="item-update">

    <h1> <?= $this->title ?> </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>