<?php

namespace backend\assets;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

class AdminLteAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@backend/web/adminlte';
    public $css = [
        'css/AdminLTE.min.css',
    ];
    public $js = [
        'js/adminlte.min.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $skin = '_all-skins';

    public function init()
    {
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }
            $this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
        }
        parent::init();
    }
}
