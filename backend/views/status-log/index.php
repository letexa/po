<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\StatusLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Логи статусов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => [
                    'style' => 'width: 150px;',
                ],
            ],
            'apple_id',
            [
                'attribute' => 'status_id',
                'filter' => ArrayHelper::map(\common\models\Status::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'value' => function($data) {
                    return isset($data->status->name) ? $data->status->name : null; 
                },
            ],
            [
                'attribute' => 'updatedate',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updatedate',
                    'language' => 'ru', 
                    'dateFormat' => 'yyyy-MM-dd'
                ]),
            ], 
        ],
    ]); ?>


</div>
