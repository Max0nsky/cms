<?php

namespace common\components\Support;

use kartik\editable\Editable;
use Yii;

class Support
{
    /**
     * Заменяет элементы текста по типу:
     * {слово1, слово2, слово3, слово4}
     * На случайное выражение из фигурных скобок
     */
    public static function generateSynonymText($text)
    {
        $result = preg_replace_callback('/{([^{}]*)}/', function ($value) {
            $synonymArray = explode(",", $value[1]);
            $words = array_map('trim', $synonymArray);
            return $words[array_rand($words)];
        }, $text);

        return $result;
    }

    public static function getListYesNo($key = false)
    {
        $array = [
            'Нет',
            'Да',
        ];
        if (is_bool($key)) {
            return $array;
        }
        return $array[$key];
    }

    public static function editableColumn($model, $attribute, $name, $actionPath)
    {
        return [
            'attribute' => 'visibility',
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions' => [
                'formOptions' => ['action' => [$actionPath]],
                'header' => 'значение',
                'inputType' => Editable::INPUT_CHECKBOX,
                'options' => [
                    'class' => 'new_class',
                    'label' => $name,
                ],
                'pjaxContainerId' => 'pjax-table',
            ],
            'content' => self::getListYesNo($model->$attribute),
            'format' => 'boolean',
            'filter' => self::getListYesNo(),
            'label' => $name,
        ];
    }
}
