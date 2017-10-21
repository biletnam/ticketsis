<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\CHtml;
use yii\helpers\Url;
$this->title = 'Ticketsis';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Ticketsis 2.0</h1>
        <p>
        <?= Html::a('Kunden', ['/customers/index'], ['class' => 'btn btn-primary']) ?>
        </p>
        <p>
        <?= Html::a('Offene Tickets', ['/tickets/index','TicketsSearch[fk_state]' => 1,'sort'=>'-datetimecreated'],['class' => 'btn btn-primary',]) ?>
        <?= Html::a('Ticket Archiv', ['/tickets/index','TicketsSearch[fk_state]' => 4,'TicketsSearch[fk_state]' => 5,'sort'=>'-datetimecreated'],['class' => 'btn btn-primary']) ?>
        <?= Html::a('Rapportierte Tickets', ['/tickets/index','TicketsSearch[fk_state]' => 6, 'sort'=>'-datetimecreated'],['class' => 'btn btn-primary']) ?>
        </p>
    </div>

    <div class="body-content">

        

    </div>
</div>
