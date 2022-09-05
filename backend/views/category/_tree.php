<?php
use yii\web\JsExpression;

$data = common\models\Category::getUpperLevelTree();

echo \wbraganca\fancytree\FancytreeWidget::widget([
    'id' => 'tree-f',
    'options' => [
        'quicksearch' => true,
        'source' => $data,
        'extensions' => ['filter'],
        'filter' => [
            'autoApply' => true,
            "autoExpand" => true,
            "counter" => true,
            "fuzzy" => false,
            "hideExpandedCounter" => true,
            "hideExpanders" => true,
            "highlight" => true,
            "leavesOnly" => false,
            "nodata" => true,
            "mode" => "hide"
            
        ],
        'activate' => new JsExpression('function(node, data) {
            let id = data.node.key;
            myVar.idTree = id;

            PubSub.publish(
                "activateTree", 
                {
                    node: node, 
                    data : data,
                    urlCategory : "'.yii\helpers\Url::to(['category-tree']).'?id="+id,
                    id:id
                }
            );
        }'),
        'lazyLoad' => new JsExpression('function(event, data){
            let id = data.node.key;
            myVar.idTree = id;

            data.result = {
                url: "' . yii\helpers\Url::to(['children']) . '",
                data: {id: id},
                cache: false
            };
        }'),
    ]
]);