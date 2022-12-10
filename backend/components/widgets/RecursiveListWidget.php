<?php

namespace backend\components\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class RecursiveListWidget extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
        if (is_null($this->data)) {
            $this->data = [];
        }
    }

    public function run()
    {
        echo "<ul class='expandable'>";
        foreach ($this->data as $key => $child) {
            if (is_array($child)) {
                $childCnt = count($child);
                echo "<li'> {$key} [{$childCnt}]";
                echo Html::button('+', ['class' => 'toogle-list-btn']);
                echo self::widget(['data' => $child]);
                echo "</li>";
            } else {
                echo "<li>{$child} ({$key})</li>";
            }
        }
        echo "</ul>";
    }
}