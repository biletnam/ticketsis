<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProducerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hersteller';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Hersteller erfassen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'producerid',
            'producer',
            'description:ntext',
            'homepage:ntext',
            'onHomepage',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            ]
        ],
    ]); ?>
</div>
