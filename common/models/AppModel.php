<?php

namespace common\models;

use \yii\db\ActiveRecord;
use yii\helpers\Inflector;
use Yii;

abstract class AppModel extends ActiveRecord
{
    public static function generateSlug($name)
    {
        return Inflector::slug($name);
    }
}
