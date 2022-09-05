<?php

use common\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


$parents = ArrayHelper::map(
    Category::findAll(['parent_id' => null]),
    'id', 'name'
);

$idForm = 'category-create';
$action = Url::to(['create']);
if (Yii::$app->controller->action->id == 'update-form') {
    $idForm = 'category-update';
    $action = Url::to(['update']);
}

?>


<div class="col-lg-8">
    <div class="box">
        <?php 
        $form = ActiveForm::begin([
            'id' => $idForm,
            'action' => $action
        ]); 
        ?>
        <div class="box-header with-border">
            <div style="float: left">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-tools pull-right">
                <?= Html::submitButton('<i class="fa fa-save" aria-label="false"></i>', ['class' => 'btn btn-info']) ?>
            </div>
        </div>
        <div class="box-body">
            <div class="entity-form">
                <div class="tabs-block">
                    <ul class="tabs-list clearfix">
                        <li class="active">
                            <a data-toggle="tab" href="#panel1">
                                <span>Основные параметры</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="panel1" class="tab-pane fade in active">
                            <div class="row">
                                <?= $form->field($model, 'name', ['options'=> ['class' => 'col-lg-6']])->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'parent_id', ['options'=> ['class' => 'col-lg-6']])->dropDownList($parents, ['prompt' => 'Верхнего уровня']) ?>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

