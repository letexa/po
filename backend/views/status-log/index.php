<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;


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
            [
                'attribute' => 'old_status_id',
                'filter' => ArrayHelper::map(\common\models\Status::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm']
            ],
            [
                'attribute' => 'new_status_id',
                'filter' => ArrayHelper::map(\common\models\Status::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm']
            ],
            [
                'attribute' => 'updatedate',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updatedate',
                    'language' => 'ru', 
                    'dateFormat' => 'dd-MM-yyyy'
                ]),
            ], 
        ],
    ]); ?>


</div>
