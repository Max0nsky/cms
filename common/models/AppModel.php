<?php

namespace common\models;

use \yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\imagine\Image;

abstract class AppModel extends ActiveRecord
{
    public function uploadImage($imagesContainer)
    {
        if (!empty($imagesContainer)) {
            $this->removeImage($this->getImage());
            $path = $_SERVER['DOCUMENT_ROOT'] . '/files/images/store/' . $imagesContainer->baseName . '.' . $imagesContainer->extension;
            Image::resize($imagesContainer->tempName, 1200, 900, true, false)->save($path);
            $this->attachImage($path, true, $this->tableName() . '_image');
            @unlink($path);
        }
    }
    
    public static function generateSlug($name)
    {
        return Inflector::slug($name);
    }
}
