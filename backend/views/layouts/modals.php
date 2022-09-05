<?php

use yii\widgets\ActiveForm;
use backend\models\forms\ChangePasswordForm;

$changePasswordForm = new ChangePasswordForm();

?>

<div class="modal fade" id="modal-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['id' => 'change-pass', 'action' => '/admin/site/change-password']); ?>
            <div class="modal-header">
                <div class="row">
                    <div class="col-sm-11">
                        <h4 class="modal-title">Изменение данных аккаунта</h4>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($changePasswordForm, 'new_password')->passwordInput(['placeholder' => '']) ?>
                        <?= $form->field($changePasswordForm, 'repeat_new_password')->passwordInput(['placeholder' => '']) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<div class="modal fade" id="modalInfo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-close" data-dismiss="modal"><a href="#"><i class="fa fa-times-circle" style="font-size: 25px;"></i></a></div>
                <h4 class="modal-title" id="modalInfo-title"></h4>
            </div>
            <div class="modal-body" id="modalInfo-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalError">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-close" data-dismiss="modal"><a href="#"><i class="fa fa-times-circle" style="font-size: 25px;"></i></a></div>
                <h4 class="modal-title" id="modalError-title"></h4>
            </div>
            <div class="modal-body" id="modalError-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="control-sidebar" id="control-slider-id">
    <a href="#" onclick="myModal.panel.close()" class="button_closePr"><i class="fa  fa-close" style="font-size: 19px;"></i></a>
    <div id="control-info-modal" style="margin-top: -30px"></div>
</div>