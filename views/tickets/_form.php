<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Customers;
use app\models\Employee;
use app\models\Ticketpriority;
use app\models\Ticketstate;
use app\models\Customerproduct;

use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-form">

    <?php
     $form = ActiveForm::begin(); 
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

<?php
            if (! $modelsTicketproduct->isNewRecord) {
                echo Html::activeHiddenInput($modelsTicketproduct, "id");
            }
        ?>

        <?= $form->field($modelsTicketproduct, "fk_customerproduct")->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Customerproduct::find()->where(['fk_customer'=>$model->fk_customer])->all(), 'id', 'serialnumber'),
        'language' => 'de',
        'options' => ['placeholder' => 'Wähle ein Produkt aus...'],
        'pluginOptions' => [
            'allowClear' => true
            ],
        ]); ?>
 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
