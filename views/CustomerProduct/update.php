<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerProduct */

$this->title = 'Update Customer Product: ' . $model->customerproductid;
$this->params['breadcrumbs'][] = ['label' => 'Customer Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customerproductid, 'url' => ['view', 'id' => $model->customerproductid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
