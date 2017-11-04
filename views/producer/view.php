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

<div class="row">
    <div class="col-6 col-sm-3 .box">
        <div class="card-block">
            <h4 class="card-title">Hersteller bearbeiten</h4>
            <p class="card-text">Ändern Sie die Herstellerdaten.</p>
            <?= Html::a('Ändern', ['update', 'id' => $model->producerid], ['class' => 'btn btn-primary']) ?>

        </div>
    </div>
    </div>


    <h2>Produkte des Herstellers</h2>
    <?= Html::button('Neues Produkt des Herstellers hinzufügen', ['value'=> Url::toRoute(['/product/create','producerid' => $model->producerid]), 'class' => 'btn btn-success modalone']) ?>
    <p>
        <?php
    $dataProvider->setSort([
         'defaultOrder' => [ 'pname' => SORT_ASC],
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pname',
            'comment',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model) {
                    $url = Url::toRoute(['product/update', 'id' => $model->productid]);
                   return Html::button('Update', ['value'=> $url, 'class' => 'btn btn-primary modalone']);
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
