<?php

use backend\components\widgets\RecursiveListWidget;
use common\models\JsonData;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\JsonData $model */
/** @var DataProvider $listDataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Json Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="json-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= RecursiveListWidget::widget(['data' => $model->data]) ?>

</div>
