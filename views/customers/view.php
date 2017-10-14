<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->customer;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->customerid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customerid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <p>
        <?= Html::a('Add Ticket', ['tickets/create','customerid' => $model->customerid], ['class' => 'btn btn-success']) ?>
    </p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customerid',
            'knr',
            'customer',
            'street',
            'place',
            'zip',
            'phone',
            'comment:ntext',
        ],
    ]) ?>
            <div class="row">

<div class="col-lg-4">
    <h2>Produkte</h2>

        <?php foreach ($model->customerproducts as $i => $modelCustomerproduct): ?>

        <?= DetailView::widget([
            'model' => $modelCustomerproduct,
            'attributes' => [
                'serialnumber',
                'year',
                'fkProduct.pname:ntext',
                'fkProduct.comment:ntext',
                'location:ntext',
            ],
        ]) ?>
            <?php foreach ($modelCustomerproduct->ticketproducts as $i => $modelTicketproduct): ?>
                <?= DetailView::widget([
                'model' => $modelTicketproduct,
                'attributes' => [
                    'fk_ticket',
                    'fkTicket.desc:ntext',
                    'fkTicket.datetimecreated',
                ],
            ]) ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    </div>
</div>