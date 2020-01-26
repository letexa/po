<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Status */

$this->title = 'Создать статус';
$this->params['breadcrumbs'][] = ['label' => 'Статус', 'url' => ['/status']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
