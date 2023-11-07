<?php
    use yii\web\JsExpression;

    echo \wbraganca\fancytree\FancytreeWidget::widget([
        'options' =>[
            'source' => $data,
            'extensions' => ['dnd'],
            'dnd' => [
                'preventVoidMoves' => true,
                'preventRecursiveMoves' => true,
                'autoExpandMS' => 400,
                'dragStart' => new JsExpression('function(node, data) {
                    return true;
                }'),
                'dragEnter' => new JsExpression('function(node, data) {
                    return true;
                }'),
                'dragDrop' => new JsExpression('function(node, data) {
                    $.get("/menu/move", {
                        item: data.otherNode.key.substr(1),
                        action: data.hitMode,
                        second: node.key.substr(1)
                    }, function(){
                        data.otherNode.moveTo(node, data.hitMode);
                    });
                }'),
            ],

        ]









    ]);
?>