<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Customers;

use app\models\Tickets;
use app\models\TicketsSearch;
use app\models\Ticketproduct;
use app\models\Model;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tickets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tickets model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

     /**
     * Creates a new Customers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tickets();
        Yii::trace("------".$model->fk_customer);

        $modelsTicketproduct = [new Ticketproduct];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::trace($modelsTicketproduct);

            $modelsTicketproduct = Model::createMultiple(Ticketproduct::classname());
            Model::loadMultiple($modelsTicketproduct, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsTicketproduct) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsTicketproduct as $modelTicketproduct) {
                            $modelTicketproduct->fk_ticket = $model->ticketid;
                            if (! ($flag = $modelTicketproduct->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                         return $this->redirect(['view', 'id' => $model->ticketid]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            else {
                  Yii::trace("Validation Success Failed.");
            }
        } else {
            
            return $this->render('create', [
                'model' => $model,
                'modelsTicketproduct' => (empty($modelsTicketproduct)) ? [new Ticketproduct] : $modelsTicketproduct,
               
            ]);
        }
    }

     public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsTicketproduct =  $model->ticketproducts; 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsTicketproduct, 'id', 'id');
            
            $modelsTicketproduct = Model::createMultiple(Ticketproduct::classname(), $modelsTicketproduct);
            Model::loadMultiple($modelsTicketproduct, Yii::$app->request->post());
            
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsTicketproduct, 'id', 'id')));


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsTicketproduct) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Ticketproduct::deleteAll(['id' => $deletedIDs]);
                        }
                       foreach ($modelsTicketproduct as $modelTicketproduct) {
                            $modelTicketproduct->fk_ticket = $model->ticketid;
                            if (! ($flag = $modelTicketproduct->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->ticketid]);
                    }
                } catch (Exception $e) {
                    Yii::trace("----".$e);

                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsTicketproduct' => (empty($modelsTicketproduct)) ? [new Ticketproduct] : $modelsTicketproduct,              
            ]);
        }
    }

    /**
     * Deletes an existing Tickets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
