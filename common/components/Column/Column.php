<?php

namespace common\components\Column;

use common\components\Support\Support;
use kartik\daterange\DateRangePicker;
use kartik\editable\Editable;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class Column
{
    const SIZE_COLUMN_IMG = 80;

    public static function editableColumn($model, $attribute, $name, $actionPath)
    {
        return [
            'attribute' => $attribute,
            'class' => '\kartik\grid\EditableColumn',
            'editableOptions' => [
                'formOptions' => ['action' => [$actionPath]],
                'header' => 'значение',
                'inputType' => Editable::INPUT_CHECKBOX,
                'options' => [
                    'label' => $name,
                ],
                'pjaxContainerId' => 'pjax-table',
            ],
            'content' => Support::getListYesNo($model->$attribute),
            'format' => 'boolean',
            'filter' => Support::getListYesNo(),
            'label' => $name,
        ];
    }

    public static function imageColumn()
    {
        $size = self::SIZE_COLUMN_IMG;

        return [
            'label' => 'Изображение',
            'format' => 'raw',
            'options' => ['style' => 'width: ' . $size . 'px; max-width: ' . $size . 'px;'],
            'contentOptions' => ['style' => 'width: ' . $size . 'px; max-width: ' . $size . 'px;'],
            'value' => function ($model) {
                $size = self::SIZE_COLUMN_IMG;
                return Html::img(Url::toRoute($model->getImage()->getPath($size . 'x' . $size)), [
                    'style' => 'width:' . $size . 'px;'
                ]);
            },
        ];
    }

    public static function dateRangeColumn($searchModel, $attribute, $attribute_start, $attribute_send, $width = '250px')
    {
        return [
            'attribute' => $attribute,
            'width' => $width,
            'value' => function ($model) use ($attribute) {
                return date('d.m.Y', $model->$attribute);
            },
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => $attribute,
                'convertFormat' => true,
                'useWithAddon' => true,
                'language' => 'ru',
                'hideInput' => true,
                'presetDropdown' => true,
                'startAttribute' => $attribute_start,
                'endAttribute' => $attribute_send,
                'pluginOptions' => [
                    'locale' => ['format' => 'd.m.Y'],
                    'separator' => ' - ',
                    'opens' => 'right',
                    'showDropdowns' => true
                ],
            ]),
        ];
    }
}
