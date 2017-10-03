<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'customerproductid') ?>

    <?= $form->field($model, 'fk_customer') ?>

    <?= $form->field($model, 'fk_product') ?>

    <?= $form->field($model, 'serialnumber') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'wartung') ?>

    <?php // echo $form->field($model, 'w_schlauch') ?>

    <?php // echo $form->field($model, 'w_waschmittel') ?>

    <?php // echo $form->field($model, 'aktiv') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
