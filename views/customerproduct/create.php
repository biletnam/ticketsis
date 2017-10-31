<?php

use yii\helpers\Html;
use app\models\Customers;


/* @var $this yii\web\View */
/* @var $model app\models\Customerproduct */
$model->fk_customer = Yii::$app->getRequest()->getQueryParam('customerid');
$customer = Customers::find()->where(['customerid'=>$model->fk_customer])->one();

$this->title = 'Produkt dem Kunde hinzufügen '.$customer->customer;
$this->params['breadcrumbs'][] = ['label' => 'Customerproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerproduct-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
