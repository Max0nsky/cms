<?php

namespace common\widgets;

use Yii;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use mihaildev\elfinder\ElFinder;

class CkeditorSite extends CKEditor {

    public function initOptions() {
        Yii::$app->view->registerJs("CKEDITOR.plugins.addExternal('codemirror', '/backend/web/js/ckeditor_plugins/codemirror/', 'plugin.js');");

        $this->clientOptions = ElFinder::ckeditorOptions(['elfinder'], []);
        $this->clientOptions = ArrayHelper::merge($this->getCustom(), $this->clientOptions);
       
    }

    private function getCustom() {
        return [
            'extraPlugins' => 'codemirror',
            'contentsCss' => '/frontend/web/css/main.css',
            'allowedContent' => true,
            'height' => 300,
            'toolbar' => [
                ['name' => 'document', 'items' => ['Source','Save', '-']],
                ['name' => 'clipboard', 'items' => ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']],
                // ['name' => 'editing', 'items' => ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']],
                ['name' => 'basicstyles', 'items' => ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']],
                ['name' => 'paragraph', 'items' => ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']],
                ['name' => 'links', 'items' => ['Link', 'Unlink', 'Anchor']],
                ['name' => 'insert', 'items' => ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']],
                ['name' => 'styles', 'items' => ['Format']],
                ['name' => 'colors', 'items' => ['TextColor', 'BGColor']],
                ['name' => 'tools', 'items' => ['Maximize', 'ShowBlocks']],
            ],
//            'removeButtons' => 'Save,NewPage,Preview,Print,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Language,BidiRtl,BidiLtr,Flash,Smiley,Iframe,Styles,Font,FontSize,About',
            'removePlugins' => 'elementspath',
            'keystrokes'  => ['CKEDITOR.CTRL + 83', 'save'],
            'forcePasteAsPlainText' => true,
        ];
    }

}
// CKEDITOR.config.forcePasteAsPlainText = true;