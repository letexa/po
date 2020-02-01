<?php

use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Status;

/* @var $this yii\web\View */

$this->title = 'Яблоки';
?>
<div class="site-index">

    <div class="container">

        <?= Html::a('Добавить яблок', ['/site/apples-create'], ['class'=>'btn btn-primary']) ?>

        <?php foreach ($models as $model) { ?>

            <div style="margin-bottom:70px">
                <h1>Яблоко <?=$model->id?></h1>
                <div style="margin-bottom:10px">
                    <strong>Статус: </strong><?= $model->status->name ?>
                </div>

                <?php if ($model->status_id == Status::HANGING_STATUS) { ?>
                    <?= Html::a('Упасть', ['/site/apple-fall/' . $model->id], ['class'=>'btn btn-success']) ?>
                <?php } ?>

                <?php if ($model->status_id == Status::FALL_STATUS) {  ?>
                    <div style="width:500px">
                        <?php $form = ActiveForm::begin(['options' => ['class' => 'apple-form'], 'enableClientValidation' => false]); ?>
                            <?= Html::hiddenInput('apple_id', $model->id); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$model->size?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$model->size?>%">
                                            <span class="sr-only"><?=$model->size?>% Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?= 
                                        $form->field($model, 'size')->textInput([
                                            'class' => 'size-input',
                                            'data-size' => $model->size
                                        ])->label(false); 
                                    ?>
                                </div>
                                <div class="col-md-2 percent">
                                    %
                                </div>
                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('Откусить', ['class' => 'btn btn-primary']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?=
            LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>

    </div>

</div>
