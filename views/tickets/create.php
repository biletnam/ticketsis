<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tickets */

$this->title = 'Ticket für: ' . $model->fk_customer;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fk_customer, 'url' => ['customers/view', 'id' => $model->fk_customer]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
