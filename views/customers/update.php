<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = 'Kunde ändern: ' . $model->customer;
$this->params['breadcrumbs'][] = ['label' => 'Kunden', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer, 'url' => ['view', 'id' => $model->customerid]];
$this->params['breadcrumbs'][] = 'Ändern';
?>
<div class="customers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsCustomercontact'=>$modelsCustomercontact,
      ]) ?>

</div>
