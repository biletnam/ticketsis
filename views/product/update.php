<?php

use yii\helpers\Html;
use app\models\Producer;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Update Produkt: ' . $model->pname;
$producer = Producer::find()->where(['producerid'=>$model->fk_producer])->one();

$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $producer->producer, 'url' => ['/producer/view', 'id' => $producer->producerid]];
$this->params['breadcrumbs'][] = ['label' => $model->pname, 'url' => ['view', 'id' => $model->productid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
