<?php

use common\models\JsonData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Json Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="json-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Json Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'data',
                'value' => function ($model, $key, $index, $column) {
                    return \yii\helpers\Json::htmlEncode($model->data);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JsonData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
