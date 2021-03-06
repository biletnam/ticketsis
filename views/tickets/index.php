<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\models\Ticketproduct;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' =>'fk_customer',
                'value'=>'fkCustomer.customer',
            ],
            [
                'attribute' =>'fk_ticketpriority',
                'value'=>'fkTicketpriority.priority',
            ],
            [
                'attribute' =>'fk_responsible',
                'value'=>'fkResponsible.fullname',
            ],
            [
                'attribute' =>'fk_state',
                'value'=>'fkState.ticketstate',
            ],

            // 'desc:ntext',
            'datetimecreated',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            ],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>