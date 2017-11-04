<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kunden';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Neuer Kunde erstellen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   
<?php Pjax::begin();
 $dataProvider->setSort([
    'defaultOrder' => [ 'customer' => SORT_ASC],
]);
?>  
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'knr',
            'customer',
            'street',
            'place',
            'zip',
            // 'comment:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
