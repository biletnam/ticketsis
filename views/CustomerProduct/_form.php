<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customerproductid')->textInput() ?>

    <?= $form->field($model, 'fk_customer')->textInput() ?>

    <?= $form->field($model, 'fk_product')->textInput() ?>

    <?= $form->field($model, 'serialnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wartung')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'w_schlauch')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'w_waschmittel')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aktiv')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
