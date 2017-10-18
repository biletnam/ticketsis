<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customercontact */

$this->title = $model->customercontactid;
$this->params['breadcrumbs'][] = ['label' => 'Customercontacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customercontact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->customercontactid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customercontactid], [
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
            'customercontactid',
            'fk_customer',
            'firstname',
            'lastname',
            'phone',
            'position',
            'email:email',
        ],
    ]) ?>

</div>
