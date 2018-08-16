<?php

namespace backend\controllers;

use Yii;
use backend\models\SolicitudRobo;
use backend\models\search\SolicitudRoboSearch;
use backend\models\search\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Producto;
use yii\base\Object;

/**
 * SolicitudRoboController implements the CRUD actions for SolicitudRobo model.
 */
class SolicitudRoboController extends Controller
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
     * Lists all SolicitudRobo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudRoboSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SolicitudRobo model.
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
     * Creates a new SolicitudRobo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    
    
    public function actionCreate()
    {
    	$model = new SolicitudRobo();
    
    	$searchModel = new ProductoSearch();
    
    
    
    	if ($model->load(Yii::$app->request->post()) ) {
    		 
    
    		 
    		try {
    			 
    			 
    			//$model->save();
    			 
    			$producto  = Producto::findOne($model->numero_serie);
    			 
    			if ($producto && $producto->estado === Producto::STATUS_REGISTRED_CLIENT){
    
    				$transaction = SolicitudRobo::getDb()->beginTransaction();
    
    				$producto->estado = Producto::STATUS_STOLED_PROCESS;
    				
    				$model->estatus = SolicitudRobo::STATUS_CREADO;
    				
    				$model->fecha_captura =  date('Y-m-d H:i:s');
    
    				if($model->save() && $producto->save()){
    					 
    					 
    					$transaction->commit();
    					 
    					return $this->redirect(['view', 'id' => $model->id_solicitud_robo]);
    					 
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
    
    
    
    	$allRequests = SolicitudRobo::find()->all();
    
    	$notinProducts = [];
    
    	foreach ($allRequests as $request){
    		 
    		if (isset( $request->numero_serie) ){
    		
    		$notinProducts[] = $request->numero_serie;
    		
    		}
    	}
    
    
    
    	$dataProvider = $searchModel->searchNotIn(Yii::$app->request->queryParams,$notinProducts,Producto::STATUS_REGISTRED_CLIENT);
    
    
    	return $this->render('create', [
    			'model' => $model,
    			'dataprovider'=>$dataProvider,
    			'searchModel'=>$searchModel,
    			 
    
    	]);
    
    }
    
    
    /**
     * Updates an existing SolicitudRobo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            
        	
        	$producto = Producto::findOne($model->numero_serie);
        	
        
        	try {
        		
        		
        	
        		$transaction = SolicitudRobo::getDb()->beginTransaction();
        		
        		if (isset($model->fecha_desactivar) && $model->fecha_desactivar ==! null ){
        			 
        			$model->estatus = SolicitudRobo::STATUS_ACEPTADO;
        		
        			$producto->estado = Producto::STATUS_DEACTIVATED;
        		
        		}elseif (isset($model->fecha_validacion) &&  $model->fecha_validacion ==! null){
        			
        			$model->estatus = SolicitudRobo::STATUS_VALIDADO;
        			
        		}else{
        			$model->estatus = SolicitudRobo::STATUS_CREADO;
        			
        			$producto->estado = Producto::STATUS_STOLED_PROCESS;
        		}
        		
        		
        		if($model->save() && $producto->save()){
        			 
        			 
        			$transaction->commit();
        			 
        			return $this->redirect(['view', 'id' => $model->id_solicitud_robo]);
        			 
        		}else{
        			 
        			$transaction->rollBack();
        			 
        			Yii::$app->session->setFlash('alert', [
        					'options'=>['class'=>'alert-fatal'],
        					'body'=>Yii::t('backend', 'No fue posible completar la operación, intente mas tarde')
        			]);
        			 
        		}
        		
        		
        		
        	} catch(\Exception $e) {
        		$transaction->rollBack();
        		throw $e;
        	}
        	
        	
        	
        	
        	
            
        } 
        
            
            
            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing SolicitudRobo model.
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
     * Finds the SolicitudRobo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SolicitudRobo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudRobo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
