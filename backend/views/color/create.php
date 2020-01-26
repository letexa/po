<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Color */

$this->title = 'Добавить цвет';
$this->params['breadcrumbs'][] = ['label' => 'Цвет', 'url' => ['/color']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
