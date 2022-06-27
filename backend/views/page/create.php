<?php

use yii\helpers\Html;

$this->title = 'Создание страницы';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <h1> <?= $this->title ?> </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>