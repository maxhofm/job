<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var array $data */
?>

<?php
    echo "<ul>";
    foreach ($data as $key => $child) {
        if (is_array($child)) {
            echo "<li> ({$key})";
            $this->render('_listItem', [
                'data' => $child,
            ]);
            echo "</li>";
        } else {
            echo "<li>{$child} ({$key})</li>";
        }
    }
    echo "</ul>";
?>

