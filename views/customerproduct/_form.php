<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;
use kartik\select2\Select2;

use app\models\Product;
use app\models\Customers;
/* @var $this yii\web\View */
/* @var $model app\models\Customerproduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customerproduct-form">

    <?php 
    $customer = Customers::find()->where(['customerid'=>$model->fk_customer])->one();            
    $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'fk_customer')->hiddenInput(['value'=> $model->fk_customer])->label(false); ?>

    <?= $form->field($model, "fk_product")->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Product::find()->orderBy('pname')->all(), 'productid', 'pname','fkProducer.producer'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Wähle ein Produkt aus...'],
                    'pluginOptions' => [
                        'allowClear' => true
                        ],
        ]); ?>

    <?= $form->field($model, 'serialnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        
    <?= $form->field($model, 'active')->dropDownList([ '1' => 'Aktiv', '2' => 'Inaktiv' ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
