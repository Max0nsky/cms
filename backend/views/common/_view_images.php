<?php

use common\components\Support\Support;
use yii\helpers\Url;


?>

<div class="row">
    <?php if (!$model->isNewRecord) : ?>
        <?php $images = $model->getImages() ?>
        <?php if (!empty($images)) : ?>
            <?php foreach ($images as $image) : ?>
                <div class="col-sm-4 img-view">
                    <a href="<?= Url::to(['/' . Support::uncamelCase($image->modelName) . '/image-delete', 'id_img' => $image->id,  'id_model' => $model->id]) ?>">
                        <span class="pull-left btn btn-danger delete-image" style="position: absolute;">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </a>
                    <a href="<?= $image->getPath() ?>" data-rel="lightcase:g">
                        <img class="image-for-model" src="<?= $image->getPath('200') ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>