<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\JsonData $model */

$this->title = 'Update Json Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Json Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="json-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
