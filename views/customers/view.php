<?php

use yii\helpers\Html;
use yii\web\CArrayDataProvider;
use yii\widgets\DetailView;
use yii\widgets\Rela;

use yii\grid\GridView;

use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->customer;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kunde bearbeiten', ['update', 'id' => $model->customerid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Kunde löschen', ['delete', 'id' => $model->customerid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Möchten Sie den Kunde wirklich löschen?',
                'method' => 'post',
            ],
        ]) ?>
       
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
    <?php 


    ?>
     <p>
        <?= Html::a('Neues Ticket für Kunde', ['tickets/create','customerid' => $model->customerid], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Zeige Tickets vom Kunde', ['value'=> Url::toRoute(['/tickets/filterlist','TicketsSearch[fk_customer]' => $model->customerid]), 'class' => 'btn btn-info', 'id'=>'modalButton']) ?>
    </p>
 
    <h2>Produkte des Kunden</h2>
    <?= Html::a('Neues Produkt dem Kunde hinzufügen', ['update', 'id' => $model->customerid], ['class' => 'btn btn-primary']) ?>

    <p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'serialnumber',
            'year',
            'fkProduct.pname:ntext',
            'fkProduct.comment:ntext',
            'location:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{leadView}',
            'buttons' => [
                'leadView' => function ($url, $model) {
                    $url = Url::to(['product/view', 'id' => $model->fk_product]);
                   return Html::button('Zeige Tickets vom Maschine', [
                       'value'=> Url::toRoute(['/tickets/filterlist','TicketsSearch[ticketid]' => $model->id]),
                       'class' => 'btn btn-info', 
                       'id'=>'modalButton']);
                },
     
             ]],
        ],
    ]); ?>
    </p>
    <?php Modal::begin([
            'id' => 'modal',
            'size'=>'modal-lg',
            'class' => '',
            ]);
        echo "<div id='modalContent'></div>";       
        Modal::end();
        ?>
