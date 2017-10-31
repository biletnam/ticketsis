<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;


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


    <h2>Produkte des Herstellers</h2>
    <?= Html::button('Neues Produkt des Herstellers hinzufügen', ['value'=> Url::toRoute(['/product/create','producerid' => $model->producerid]), 'class' => 'btn btn-info modalone']) ?>
    <p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pname',
            'comment',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{leadView}, {update}',
            'buttons' => [
                'update' => function ($url, $model) {
                    $url = Url::toRoute(['product/update', 'id' => $model->productid]);
                   return Html::button('<i class="fa fa-eye">Update</i>', ['value'=> $url, 'class' => 'btn btn-info modalone']);
                },     
             ]],
        ],
    ]); ?>
    </p>


<?php Modal::begin([
            'id' => 'modal',
            'size'=>'modal-lg',
            'class' => '',
            ]);
        echo "<div id='modalContent'></div>";       
        Modal::end();
        ?>
</div>
