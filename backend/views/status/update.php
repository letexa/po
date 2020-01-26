<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Status */

$this->title = 'Обновление статуса: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Статусы', 'url' => ['/status']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
