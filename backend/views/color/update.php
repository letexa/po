<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Color */

$this->title = 'Обновить цвет: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Цвет', 'url' => ['/color']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="color-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
