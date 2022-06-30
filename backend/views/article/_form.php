<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$seo = $model->getSeo();

?>

<div class="article-form">
<div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Основные</a></li>
                    <li><a href="#tab_2" data-toggle="tab">SEO</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-10">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($seo, 'h1')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'text_short')->textarea(['rows' => 3]) ?>
                                <?= $form->field($model, 'text')->widget(common\widgets\CkeditorSite::class, []) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'visibility', ['options' => ['class' => 'form-group cust-checkbox'], 'template' => '<label> {input} <span class="cust-checkbox__box"></span> Опубликовать</label>'])->checkbox([], false);  ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'slug')->textInput(['readonly' => true]) ?>
                                <?= $form->field($seo, 'title')->textInput() ?>
                                <?= $form->field($seo, 'keywords')->textInput() ?>
                                <?= $form->field($seo, 'description')->textarea(['rows' => 4, 'onkeyup' => 'myVar.lenghtChar(this)']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success save-btn']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
