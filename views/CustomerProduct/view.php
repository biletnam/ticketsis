<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerProduct */

$this->title = $model->customerproductid;
$this->params['breadcrumbs'][] = ['label' => 'Customer Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->customerproductid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customerproductid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customerproductid',
            'fk_customer',
            'fk_product',
            'serialnumber',
            'year',
            'location',
            'wartung:ntext',
            'w_schlauch:ntext',
            'w_waschmittel:ntext',
            'aktiv',
        ],
    ]) ?>

</div>
