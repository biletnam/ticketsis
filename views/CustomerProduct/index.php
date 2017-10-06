<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerproductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customerproducts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerproduct-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customerproduct', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_customer',
            'fk_product',
            'serialnumber',
            'year',
            // 'location',
            // 'wartung:ntext',
            // 'w_schlauch:ntext',
            // 'w_waschmittel:ntext',
            // 'aktiv',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
