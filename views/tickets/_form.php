<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Customers;
use app\models\Employee;
use app\models\Ticketpriority;
use app\models\Ticketstate;
use app\models\Customerproduct;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-form">

    <?php
     $form = ActiveForm::begin(['id' => 'dynamic-form']); 
     ?>
    <?= $form->field($model, 'datetimecreated')->textInput(['readonly' => true, 'value' => date('d.m.Y - H:i:s')]) ?>

    <?= $form->field($model ,'fk_customer')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'fk_creator')->dropDownList(
        ArrayHelper::map(Employee::find()->where(['>=', 'systemtype', '2'])->all(), 'employeeid', 'fullname'),
        ['prompt', 'Erstellt von...']

    ) ?>

    <?= $form->field($model, 'fk_responsible')->dropDownList(
        ArrayHelper::map(Employee::find()->where(['<', 'systemtype', '2'])->andWhere(['=', 'active','1'])->all(), 'employeeid', 'fullname'),
        ['prompt', 'Verantwortlich']
    ) ?>

    <?= $form->field($model, 'fk_ticketpriority')->dropDownList(
        ArrayHelper::map(Ticketpriority::find()->all(), 'ticketpriorityid', 'priority'),
        ['prompt', 'Priorität']

    ) ?>

    <?= $form->field($model, 'fk_state')->dropDownList(
        ArrayHelper::map(Ticketstate::find()->all(), 'stateid', 'ticketstate'),
        ['prompt', 'Status']
    ) ?>


    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>


<div class="row">
 <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Produkte</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsTicketproduct[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'fk_customerproduct',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsTicketproduct as $i => $modelTicketproduct): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Product</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelTicketproduct->isNewRecord) {
                                echo Html::activeHiddenInput($modelTicketproduct, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelTicketproduct, "[{$i}]fk_customerproduct")->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(Customerproduct::find()->where(['fk_customer'=>$model->fk_customer])->all(), 'id', 'serialnumber'),
                                    'language' => 'de',
                                    'options' => ['placeholder' => 'Wähle ein Produkt aus...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                            </div>                    
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
</div>   
</div>   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
