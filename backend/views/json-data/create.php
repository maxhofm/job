<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\JsonData $model */

$this->title = 'Create Json Data';
$this->params['breadcrumbs'][] = ['label' => 'Json Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="json-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
