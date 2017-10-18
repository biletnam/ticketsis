<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
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

</div>