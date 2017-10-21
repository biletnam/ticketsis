<?php

use yii\helpers\Html;
use app\models\Customers;
/* @var $this yii\web\View */
/* @var $model app\models\Tickets */
$model->fk_customer = Yii::$app->getRequest()->getQueryParam('customerid');
$customer =  $model->fkCustomer;

$this->title = 'Update Ticket mit ID: ' . $model->ticketid;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $customer->customer, 'url' => ['customers/view', 'id' => $model->fk_customer]];
$this->params['breadcrumbs'][] = ['label' => $model->ticketid, 'url' => ['view', 'id' => $model->ticketid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tickets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTicketproduct'=>$modelsTicketproduct,

    ]) ?>

</div>
