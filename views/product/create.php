<?php

use yii\helpers\Html;
use app\models\Producer;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
$model->fk_producer = Yii::$app->getRequest()->getQueryParam('producerid');
$producer = Producer::find()->where(['producerid'=>$model->fk_producer])->one();

$this->title = 'Produkt erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Producer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $producer->producer, 'url' => ['/producer/view', 'id' => $producer->producerid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
