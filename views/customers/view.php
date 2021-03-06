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
    <div class="row">
    <div class="col-6 col-sm-3 .box">
        <div class="card-block">
            <h4 class="card-title">Kunde Bearbeiten</h4>
            <p class="card-text">Ändern Sie die Kundendaten oder Kontaktpersonen.</p>
            <?= Html::a('Kunde bearbeiten', ['update', 'id' => $model->customerid], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-6 col-sm-3 .box">
        <div class="card-block">
            <h4 class="card-title">Neues Ticket</h4>
            <p class="card-text">Erstellen Sie für diesen Kunde ein neues Ticket.</p>
            <?= Html::a('Neues Ticket erfassen', ['tickets/create','customerid' => $model->customerid], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="col-6 col-sm-3 .box">
        <div class="card-block">
            <h4 class="card-title">Tickets anzeigen</h4>
            <p class="card-text">Sehen Sie alle Tickets von diesem Kunde.</p>
            <?= Html::button('Tickets anzeigen', ['value'=> Url::toRoute(['/tickets/filterlist','TicketsSearch[fk_customer]' => $model->customerid]), 'class' => 'btn btn-info modalone']) ?>
            </div>
    </div>
    <div class="col-6 col-sm-3 .box">

        <div class="card-block">
            <h4 class="card-title">Kontaktpersonen</h4>
            <p class="card-text">Zeigen Sie die zugeordneten Kontaktpersonen dieses Kunden.</p>
            <?= Html::button('Kontakte anzeigen zeigen', ['value'=> Url::toRoute(['/customercontact/index','CustomercontactSearch[fk_customer]' => $model->customerid]), 'class' => 'btn btn-info modalone']) ?>
            </div>
    </div>
    </div>
    <hr/>
    <h2>Produkte des Kunden</h2>
    <?= Html::button('Neues Produkt dem Kunde hinzufügen', ['value'=> Url::toRoute(['/customerproduct/create','customerid' => $model->customerid]), 'class' => 'btn btn-success modalone']) ?>

    <p>
        <?php
            $dataProvider->setSort([
                'defaultOrder' => [ 'serialnumber' => SORT_ASC],
            ]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fkProduct.pname:ntext',
            'serialnumber',
            'location:ntext',
            'year',
            [
                'attribute'=>'active',
                'filter'=>array("2"=>"Inaktiv","1"=>"Aktiv",""=>"Alle"),
            ],
            
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::button('Bearbeiten', [
                       'value'=> Url::toRoute(['/customerproduct/update','id' => $model->id]),
                       'class' => 'btn btn-primary modalone']);
                },
                ]
            ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{showTickets}',
            'buttons' => [
                'showTickets' => function ($url, $model) {
                    return Html::button('Tickets von Kundenprodukt anzeigen', [
                       'value'=> Url::toRoute(['/tickets/filterlist','TicketsSearch[ticketid]' => $model->id]),
                       'class' => 'btn btn-info modalone']);
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
