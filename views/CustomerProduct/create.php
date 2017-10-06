<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Customerproduct */

$this->title = 'Create Customerproduct';
$this->params['breadcrumbs'][] = ['label' => 'Customerproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerproduct-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
