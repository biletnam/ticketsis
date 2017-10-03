<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ticketid') ?>

    <?= $form->field($model, 'fk_customer') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'fk_creator') ?>

    <?= $form->field($model, 'fk_ticketpriority') ?>

    <?php // echo $form->field($model, 'fk_responsible') ?>

    <?php // echo $form->field($model, 'fk_state') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'datetimecreated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
