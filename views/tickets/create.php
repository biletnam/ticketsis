<?php

use yii\web\Request;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use app\models\Customers;

/* @var $this yii\web\View */
/* @var $model app\models\Tickets */
$model->fk_customer = Yii::$app->getRequest()->getQueryParam('customerid');
$customer = Customers::find()->where(['customerid'=>$model->fk_customer])->one();
$this->title = 'Ticket erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $customer->customer, 'url' => ['customers/view', 'id' => $model->fk_customer]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tickets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTicketproduct'=>$modelsTicketproduct,
    ]) ?>

</div>
