<?php

use yii\helpers\Html;
use yii\web\CArrayDataProvider;
use yii\widgets\DetailView;
use yii\widgets\Rela;

use yii\grid\GridView;

use yii\helpers\Url;
use yii\bootstrap\Modal;

use app\models\Customercontact;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->customer;
$this->params['breadcrumbs'][] = ['label' => 'Kunden', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kunde bearbeiten', ['update', 'id' => $model->customerid], ['class' => 'btn btn-primary']) ?>
       
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
        <?php $customercontacts = Customercontact::find()->where(['fk_customer'=>$model->customerid])->orderBy('lastname')->asArray()->all() ?>

    <?php


    ?>
     <p>
        <?= Html::a('Neues Ticket für Kunde', ['tickets/create','customerid' => $model->customerid], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::button('Zeige Tickets vom Kunde', ['value'=> Url::toRoute(['/tickets/filterlist','TicketsSearch[fk_customer]' => $model->customerid]), 'class' => 'btn btn-info modalone', 'id'=>'modalButton']) ?>
        <?= Html::button('Zeige Kontakte für Kunde', ['value'=> Url::toRoute(['/customercontact/index','CustomercontactSearch[fk_customer]' => $model->customerid]), 'class' => 'btn btn-info modalone', 'id'=>'modalButton2']) ?>
    </p>
 
    <h2>Produkte des Kunden</h2>
    <?= Html::button('Neues Produkt dem Kunde hinzufügen', ['value'=> Url::toRoute(['/customerproduct/create','customerid' => $model->customerid]), 'class' => 'btn btn-info modalone', 'id'=>'modalButton3']) ?>

    <p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fkProduct.pname:ntext',            
            'serialnumber',
            'location:ntext',            
            'year',
            'fkProduct.comment:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{showTickets},{update}',
            'buttons' => [
                'showTickets' => function ($url, $model) {
                    return Html::button('Zeige Tickets vom Maschine', [
                       'value'=> Url::toRoute(['/tickets/filterlist','TicketsSearch[ticketid]' => $model->id]),
                       'class' => 'btn btn-info modalone',
                       'id'=>'modalButton']);
                    },
                'update' => function ($url, $model) {
                    return Html::button('Ändern', [
                       'value'=> Url::toRoute(['/customerproduct/update','id' => $model->id]),
                       'class' => 'btn btn-info modalone',
                       'id'=>'modalButton']);
                    },    
                ]
            ],
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
