<?php

use yii\helpers\Url;

\kartik\select2\Select2Asset::register($this);
\backend\assets\CategoryAsset::register($this);

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="brand-index">
    <div class="row">
        <div class="col-lg-4 brand__tree">
            <div class="box">
                <div class="box-header with-border">
                    <div style="float: left">
                        <h3 class="box-title"><?= $this->title; ?></h3>
                    </div>
                    <div class="pull-right box-tools">
                        <label>Фильтр:</label>
                        <input name="search" placeholder="Введите слово" autocomplete="off">
                    </div>
                </div>
                <div class="box-body" id="box-body-tree" style="min-height: 600px; max-height: 600px; overflow: auto">
                    <?= $this->render('_tree') ?>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?= Url::to(['create-form']) ?>" class="btn btn-info" data-button-tree="create"><span class="glyphicon glyphicon-plus"></span></a>
                                <a href="<?= Url::to(['delete']) ?>" class="btn btn-info " data-button-no-active-pr='true' data-button-tree="delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?= Url::to(['/category/tree-up']) ?>" class="btn btn-info " data-button-no-active-pr='true' data-button-tree="up"><span class="glyphicon glyphicon-arrow-up"></span></a>
                                <a href="<?= Url::to(['/category/tree-down']) ?>" class="btn btn-info " data-button-no-active-pr='true' data-button-tree="down"><span class="glyphicon glyphicon-arrow-down"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <div class="tabs-block">
                <ul class="tabs-list clearfix">
                    <li class="active">
                        <a data-toggle="tab" href="#panel_cats"><span>Категория</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#panel_goods"><span>Товары</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="panel_goods" class="tab-pane fade ">
                        <div id="data-modal-good">Для начала работы выберите подкатегорию</div>
                    </div>
                    <div id="panel_cats" class="tab-pane fade in active">
                        <div id="data-modal">Для начала работы выберите категорию</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>