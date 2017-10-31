<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use kartik\select2\Select2;

use app\models\Customers;
use app\models\CustomersSearch;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Sistec Service',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Kunden', 'url' => ['/customers/index']],
            ['label' => 'Tickets', 'url' => ['/tickets/index'],
            'items' => [
                ['label' => 'Offen', 'url' => ['tickets/index', 'TicketsSearch[fk_state]' => 1]],
                ['label' => 'Erledigt', 'url' => ['tickets/index', 'TicketsSearch[fk_state]' => 4]],                
                ['label' => 'Rapportiert', 'url' => ['tickets/index', 'TicketsSearch[fk_state]' => 6]],
            ], 
        ],
            ['label' => 'Produkte und Hersteller', 'url' => ['/producer/index']],
    ],
    ]);
   
   
    NavBar::end();
   
?>

    <div class="container">
    <div class="body-content">;
        <?php 
          $searchModel = new CustomersSearch();
         echo $this->render('/customers/_search', ['model' => $searchModel]); 
         /*
         $form = ActiveForm::begin(['action' =>['customers/index']]);
         $searchModel = new CustomersSearch();
         echo $form->field($searchModel, 'searchstring', [
                 'template' =>
                 '
                 <div class="input-group">
                     {input}
                     <span class="input-group-btn">'.Html::submitButton('Los', ['class' => 'btn btn-primary']).'</span>
                 </div>',
                 
             ])->textInput(['placeholder' => 'Kundennummer, Kunde, Strasse, Kontaktperson...']);
         ActiveForm::end();*/
             
     
         $form = ActiveForm::begin(['action' =>['tickets/index']]);
         $searchModel = new CustomersSearch();
         echo $form->field($searchModel, 'searchstring', [
                 'template' =>
                 '<div class="input-group">
                     {input}
                     <span class="input-group-btn">'.Html::submitButton('Los', ['class' => 'btn btn-primary']).'</span>
                 </div>',
                 
             ])->textInput(['placeholder' => 'Ticketnummer, Rapportnummer...']);
         ActiveForm::end();
         echo '</div>';
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Sistec Service Gmbh <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
