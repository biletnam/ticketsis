<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_customer')->textInput(['readonly' => true, ]) ?>

    <?= $form->field($model, 'datetimecreated')->textInput(['readonly' => true, 'value' => date('d.m.Y - H:i:s')]) ?>


    <?= $form->field($model, 'fk_creator')->textInput() ?>

    <?= $form->field($model, 'fk_ticketpriority')->textInput() ?>

    <?= $form->field($model, 'fk_responsible')->textInput() ?>

    <?= $form->field($model, 'fk_state')->textInput() ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
