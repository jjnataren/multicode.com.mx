<?php

namespace backend\controllers;

use Yii;
use backend\models\Garantia;
use backend\models\search\GarantiaSearch;
use backend\models\search\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Object;
use backend\models\Producto;
use yii\base\Model;

/**
 * GarantiaController implements the CRUD actions for Garantia model.
 */
class GarantiaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Garantia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GarantiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Garantia model.
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
     * Creates a new Garantia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Garantia();
        
        $searchModel = new ProductoSearch();
        
        

        if ($model->load(Yii::$app->request->post()) ) {
        	
      
        	
        	try {
        		 
        	
        	//$model->save();
        	
        	$producto  = Producto::findOne($model->numero_serie);
        	
        	if ($producto && $producto->estado === Producto::STATUS_REGISTRED_CLIENT){
        		
        		$transaction = Garantia::getDb()->beginTransaction();
        		
        		$producto->estado = Producto::STATUS_GUARANTED_PROCESS;
        		
        		$model->estatus = Garantia::STATUS_REGISTERED;
        		
        		$model->fecha_captura = date('Y-m-d H:i:s');
        		
        		if($model->save() && $producto->save()){
        			
        			
        			$transaction->commit();
        			
        			return $this->redirect(['view', 'id' => $model->id_solicitud]);
        			
        		}else{
        			
        			$transaction->rollBack();
        			
        			Yii::$app->session->setFlash('alert', [
        					'options'=>['class'=>'alert-fatal'],
        					'body'=>Yii::t('backend', 'No fue posible completar la operación, intente mas tarde')
        			]);
        			
        		}
        		
        		
        	}else{
        		
        	
        		 
        		Yii::$app->session->setFlash('alert', [
        				'options'=>['class'=>'alert-fatal'],
        				'body'=>Yii::t('backend', 'Producto no valido')
        		]);
        		
        	}
        	
        	
        	} catch(\Exception $e) {
        		$transaction->rollBack();
        		throw $e;
        	}
        	
        	
          
            
        } 
        
        
        
        $allRequests = Garantia::find()->all();
        
        $notinProducts = [];
        
        foreach ($allRequests as $request){
        	
        	$notinProducts[] = $request->numero_serie;
        }
        
          
        
        $dataProvider = $searchModel->searchNotIn(Yii::$app->request->queryParams,$notinProducts,Producto::STATUS_REGISTRED_CLIENT);
        
        
             return $this->render('create', [
                'model' => $model,
            	'dataprovider'=>$dataProvider,
            	'searchModel'=>$searchModel,
            	
            		
            ]);
        
    }

    /**
     * Updates an existing Garantia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

      /*  if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_solicitud]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }*/
        
        
        $searchModel = new ProductoSearch();
        
        
        
        if ($model->load(Yii::$app->request->post()) ) {
        	 
        
        	 
        	try {
        		 
        		 
        		//$model->save();
        		
        		if (isset($model->fecha_valido_cliente) && $model->fecha_valido_cliente ==! null ){
        				$model->estatus = Garantia::STATUS_VALIDATED_CLIENT;
        		}elseif (isset($model->fecha_recibio_cliente) &&  $model->fecha_recibio_cliente ==! null){
        				$model->estatus = Garantia::STATUS_RECEIVED_CLIENT;
        		}elseif (isset($model->fecha_envio ) && $model->fecha_envio ==! null){
        				$model->estatus = Garantia::STATUS_SENT_CLIENT;
        		}else
        				$model->estatus = Garantia::STATUS_REGISTERED;
        			
        			 
        		 
        		$producto  = Producto::findOne($model->numero_serie);
        		 
        		if ($producto && $producto->estado === Producto::STATUS_GUARANTED_PROCESS){
        
        			$transaction = Garantia::getDb()->beginTransaction();
        
        			$producto->estado = Producto::STATUS_GUARANTED_PROCESS;
        
        			if($model->save() && $producto->save()){
        				 
        				 
        				$transaction->commit();
        				 
        				return $this->redirect(['view', 'id' => $model->id_solicitud]);
        				 
        			}else{
        				 
        				$transaction->rollBack();
        				 
        				Yii::$app->session->setFlash('alert', [
        						'options'=>['class'=>'alert-fatal'],
        						'body'=>Yii::t('backend', 'No fue posible completar la operación, intente mas tarde')
        				]);
        				 
        			}
        
        
        		}else{
        
        			 
        			 
        			Yii::$app->session->setFlash('alert', [
        					'options'=>['class'=>'alert-fatal'],
        					'body'=>Yii::t('backend', 'Producto no valido')
        			]);
        
        		}
        		 
        		 
        	} catch(\Exception $e) {
        		$transaction->rollBack();
        		throw $e;
        	}
        	 
        	 
        
        
        }
        
        
        
        $allRequests = Garantia::find()->all();
        
        $notinProducts = [];
        
        foreach ($allRequests as $request){
        	 
        	$notinProducts[] = $request->numero_serie;
        }
        
        
        
        $dataProvider = $searchModel->searchNotIn(Yii::$app->request->queryParams,$notinProducts,Producto::STATUS_REGISTRED_CLIENT);
        
        
        return $this->render('update', [
        		'model' => $model,
        		'dataprovider'=>$dataProvider,
        		'searchModel'=>$searchModel,
        		 
        
        ]);
    }

    /**
     * Deletes an existing Garantia model.
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
     * Finds the Garantia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Garantia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Garantia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
