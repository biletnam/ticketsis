<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomersSearch */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="input-group">
    <?=$form->field($model, 'suche')->textInput(['placeholder' => 'Kundennummer, Kunde, Strasse, Kontaktperson...'])->label(false) ;?>

    <?php // $form->field($model, 'knr') ?>

    <?php // $form->field($model, 'customer') ?>

    <?php // $form->field($model, 'street') ?>

    <?php // $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <span class="align-bottom input-group-btn">
        <?= Html::submitButton('GO', ['class' => 'btn btn-primary']) ?>
    </span>

    <?php ActiveForm::end(); ?>

</div>
