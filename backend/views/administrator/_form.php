<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="article-form">
<div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Основные</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-10">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email (Логин администратора)') ?>
                                <?= $form->field($model, 'password')->textInput(['maxlength' => true])->label('Пароль')  ?>
                                <?= $form->field($model, 'repeat_password')->textInput(['maxlength' => true])->label('Повторите пароль')  ?>
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
