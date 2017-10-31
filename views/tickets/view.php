<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tickets */
$this->title = $model->ticketid;
$customer =  $model->fkCustomer;

$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $customer->customer, 'url' => ['customers/view', 'id' => $model->fk_customer]];

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ticketid, 'customerid' => $model->fk_customer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ticketid], [
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
            'ticketid',
            'fkCustomer.customer',
            'datetimecreated',            
            'fkCreator.fullname',
            'fkTicketpriority.priority',
            'fkResponsible.fullname',
            'fkState.ticketstate',
            'desc:ntext',
            'ticketproducts.fkCustomerproduct.fullName',
        ],
    ]) ?>
<?= Html::a('Zeige Kunde', ['/customers/view','id' => $model->fk_customer], ['class' => 'btn btn-info', 'id'=>'modalButton']) ?>


<?php Modal::begin([
            'id' => 'modal',
            'size'=>'modal-lg',
            'class' => '',
            ]);
        echo "<div id='modalContent'></div>";       
        Modal::end();
        ?>
</div>
