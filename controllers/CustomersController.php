<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Customers;
use app\models\CustomersSearch;
use app\models\Customerproduct;
use app\models\Model;

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
     * Displays a single Customers model.
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
        $model = new Customers();
        $modelsCustomerproduct = [new Customerproduct];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::trace($modelsCustomerproduct);

            $modelsCustomerproduct = Model::createMultiple(Customerproduct::classname());
            Model::loadMultiple($modelsCustomerproduct, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCustomerproduct) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCustomerproduct as $modelCustomerproduct) {
                            $modelCustomerproduct->fk_customer = $model->customerid;
                            if (! ($flag = $modelCustomerproduct->save(false))) {
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
                'modelsCustomerproduct' => (empty($modelsCustomerproduct)) ? [new Customerproduct] : $modelsCustomerproduct
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
        Yii::trace("boy".$id);
        $modelsCustomerproduct =  $model->customerproducts;
        Yii::trace("boy1");
  

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsCustomerproduct, 'id', 'id');
            
            $modelsCustomerproduct = Model::createMultiple(Customerproduct::classname(), $modelsCustomerproduct);
            Model::loadMultiple($modelsCustomerproduct, Yii::$app->request->post());
            
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsCustomerproduct, 'id', 'id')));


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCustomerproduct) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Customerproduct::deleteAll(['id' => $deletedIDs]);
                        }
                       foreach ($modelsCustomerproduct as $modelCustomerproduct) {
                            $modelCustomerproduct->fk_customer = $model->customerid;
                            if (! ($flag = $modelCustomerproduct->save(false))) {
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
                'modelsCustomerproduct' => (empty($modelsCustomerproduct)) ? [new Customerproduct] : $modelsCustomerproduct
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
