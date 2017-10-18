<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Customers;
use app\models\CustomersSearch;
use app\models\Customercontact;
use app\models\Model;

use app\models\CustomerproductSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomersController implements the CRUD actions for Customers model.
 */
class CustomersController extends Controller
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
     * Lists all Customers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

        /**
     * Lists all Tickets models.
     * @return mixed
     */
    public function actionIndexmodal()
    {
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('indexmodal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);       
        $searchModel = new CustomerproductSearch();
        $searchModel->fk_customer = $model->customerid;
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Customers model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewfilter($id)
    {
        return $this->renderAjax('viewfilter', [
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
        $model = new Customers();
        $modelsCustomercontact = [new Customercontact];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::trace($modelsCustomercontact);

            $modelsCustomercontact = Model::createMultiple(Customercontact::classname());
            Model::loadMultiple($modelsCustomercontact, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCustomercontact) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCustomercontact as $modelsCustomercontact) {
                            $modelsCustomercontact->fk_customer = $model->customerid;
                            if (! ($flag = $modelsCustomercontact->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->customerid]);
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
                'modelsCustomercontact' => (empty($modelsCustomercontact)) ? [new Customercontact] : $modelsCustomercontact
            ]);
        }
    }

    /**
     * Updates an existing Customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsCustomercontact =  $model->customercontacts;
  
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsCustomercontact, 'id', 'id');
            
            $modelsCustomercontact = Model::createMultiple(Customercontact::classname(), $modelsCustomercontact);
            Model::loadMultiple($modelsCustomercontact, Yii::$app->request->post());
            
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsCustomercontact, 'id', 'id')));


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCustomercontact) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Customercontact::deleteAll(['id' => $deletedIDs]);
                        }
                       foreach ($modelsCustomercontact as $modelsCustomercontact) {
                            $modelsCustomercontact->fk_customer = $model->customerid;
                            if (! ($flag = $modelsCustomercontact->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->customerid]);
                    }
                } catch (Exception $e) {
                    Yii::trace("----".$e);

                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsCustomercontact' => (empty($modelsCustomercontact)) ? [new Customercontact] : $modelsCustomercontact
            ]);
        }
    }

    /**
     * Deletes an existing Customers model.
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
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
