<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Apple */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apple-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(
                \common\models\Status::find()->select(['id', 'name'])->orderBy('id')->all(), 
                'id', 'name'
            )
        );
    ?>

    <?= $form->field($model, 'size')->textInput(['value' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
