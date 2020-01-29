<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AppleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Яблоки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить яблоко', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'color_id',
                'filter' => ArrayHelper::map(\common\models\Color::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'value' => function($data) {
                    return isset($data->color->name) ? $data->color->name : null; 
                },
            ],
            [
                'attribute' => 'status_id',
                'filter' => ArrayHelper::map(\common\models\Status::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'value' => function($data) {
                    return isset($data->status->name) ? $data->status->name : null; 
                },
            ],
            [
                'attribute' => 'size',
                'value' => function($data) {
                    return 
                    '<div class="small font-weight-bold"><span class="float-right">&nbsp;' . $data->size . '%</span></div>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: ' . $data->size . '%" aria-valuenow="' . $data->size . '" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'createdate',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'createdate',
                    'language' => 'ru', 
                    'dateFormat' => 'yyyy-MM-dd'
                ]),
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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
