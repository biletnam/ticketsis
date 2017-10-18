<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Producer */

$this->title = $model->producer;
$this->params['breadcrumbs'][] = ['label' => 'Hersteller', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ändern', ['update', 'id' => $model->producerid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Löschen', ['delete', 'id' => $model->producerid], [
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
            'producerid',
            'producer',
            'description:ntext',
            'homepage:ntext',
            'onHomepage',
        ],
    ]) ?>

    <p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'productid',
            'pname',
            'comment',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{leadView}',
            'buttons' => [
                'leadView' => function ($url, $model) {
                    $url = Url::to(['product/view', 'id' => $model->productid]);
                   return Html::a('<i class="fa fa-eye">H</i>', $url, ['title' => 'view']);
                },
     
             ]],
        ],
    ]); ?>
    </p>
</div>
