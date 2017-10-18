<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProducerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'producerid') ?>

    <?= $form->field($model, 'producer') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'homepage') ?>

    <?= $form->field($model, 'onHomepage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
