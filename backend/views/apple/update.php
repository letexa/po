<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apple */

$this->title = 'Обновление яблока: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Яблоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="apple-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
