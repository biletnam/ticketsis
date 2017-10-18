<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Producer;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->pname;
$producer = Producer::find()->where(['producerid'=>$model->fk_producer])->one();
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $producer->producer, 'url' => ['/producer/view', 'id' => $producer->producerid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ändern', ['update', 'id' => $model->productid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Löschen', ['delete', 'id' => $model->productid], [
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
            'productid',
            'fkProducer.producer',
            'pname:ntext',
            'comment:ntext',
            'file:ntext',
        ],
    ]) ?>

 
<!--Html::button('Zeige alle Kunde mit einer solchen Maschine', ['value'=> Url::toRoute(['/customer/indexmodal','CustomerSearch[fk_customer]' => $model->customerid]), 'class' => 'btn btn-info', 'id'=>'modalButton'])
--> 

</div>
