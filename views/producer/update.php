<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producer */

$this->title = 'Ändern Hersteller: ' . $model->producer;
$this->params['breadcrumbs'][] = ['label' => 'Hersteller', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->producer, 'url' => ['view', 'id' => $model->producerid]];
$this->params['breadcrumbs'][] = 'Ändern';
?>
<div class="producer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
