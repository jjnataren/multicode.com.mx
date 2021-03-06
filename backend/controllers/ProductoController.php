<?php

namespace backend\controllers;

use Yii;
use backend\models\Producto;
use backend\models\search\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use trntv\filekit\actions\UploadAction;
use trntv\filekit\actions\DeleteAction;
use Intervention\Image\ImageManagerStatic;
use yii\base\Object;
use backend\models\search\TimelineEventSearch;
use backend\models\TipoProducto;
use kartik\mpdf\Pdf;
use yii\helpers\Json;


/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
    
    public function actions()
    {
    	return [
    			'avatar-upload' => [
    					'class' => UploadAction::className(),
    					'deleteRoute' => 'avatar-delete',
    					'on afterSave' => function ($event) {
    						/* @var $file \League\Flysystem\File */
    						$file = $event->file;
    						$img = ImageManagerStatic::make($file->read())->fit(215, 215);
    						$file->put($img->encode());
    					}
    			],
    			'avatar-delete' => [
    					'class' => DeleteAction::className()
    			]
    			];
    }
    
    /**
     * Generates a PDF reporte de producto
     * @param integer $id
     */
    public function actionReporteProducto($id){
    	 
    	//	Yii::$app->response->format = 'pdf';
    	 
    	$model = $this->findModel($id);
    	 
    	$content = $this->renderPartial('reporte-producto',['model'=>$model]);
    	 
    	 
    	$pdf = new Pdf([
    			// set to use core fonts only
    			'mode' => Pdf::MODE_UTF8,
    			// A4 paper format
    			'format' => Pdf::FORMAT_A4,
    			// portrait orientation
    			'orientation' => Pdf::ORIENT_PORTRAIT,
    			// stream to browser inline
    			//'destination' => Pdf::DEST_BROWSER,
    			// your html content input
    			'content' => $content,
    			// format content from your own css file if needed or use the
    			// enhanced bootstrap css built by Krajee for mPDF formatting
    			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
    			// any css to be embedded if required
    			'cssInline' => '.kv-heading-1{font-size:18px}
    							#menu{
								      font:5px;
								    }',
    			// set mPDF properties on the fly
    			'options' => ['title' => 'Reporte de producto'],
    			// call mPDF methods on the fly
    			'methods' => [
    					'SetHeader'=>['Reporte producto'],
    					'SetFooter'=>['{PAGENO}'],
    			]
    	]);
    	 
    	// return the pdf output as per the destination setting
    	return $pdf->render();
    	 
    	 
    }
    
    
    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * categoria del producto 
     * 
     */
    public function  actionGetCategoriaPro($id){
    	 
    	//verificar si hay atributo de activo
    	$tipos = TipoProducto::findAll(['CATEGORIA'=>$id]);
    	 
    	 
    	if($tipos){
    		foreach($tipos as $tipo){
    			echo "<option value='".$tipo->id_tipo_producto."'>".$tipo->nombre."</option>";
    		}
    	}
    	else{
    		echo "<option>--</option>";
    	}
    	 
    	 
    	 
    }
    /**
     * Returns precio sugerido
     * @param unknown $id
     */
    public function actionGetPublicPrice($id){
    	
    	$model = Producto::findOne($id);
    	
    	/*Yii::$app->mailer->compose()
    	->setTo('jesus.nataren@gmail.com')
    	->setSubject('Message subject')
    	->setTextBody('Plain text content')
    	->setHtmlBody('<b>HTML content</b>')
    	->send();*/
    	
    	return $model ? $model->precio_sugerido : '0';
    	
    }
    
    
    
    /**
     * Displays a single Producto model.
     * @param string $id
     * @return mixed
     */
    public function actionSearchParticular($id)
    {
    	
    //	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	
    	$model = Producto::findOne($id);
    	
    	return Json::encode(['nombre_producto'=>$model->tipoProducto->nombre,'precio_producto'=>$model->precio_sugerido, 
    			'numero_serie'=>$model->numero_serie,
    			'fecha_registro'=>$model->fecha_registro,
    			'nombre_cliente'=>$model->idPropietario->nombre . ' ' . $model->idPropietario->apellido_materno ,
    			'telefono_cliente'=>$model->idPropietario->telefono ,
    			'email_cliente'=>$model->idPropietario->email,
    			
    	]);	
	    	
    }
 
    
    
    /**
     * Displays a single Producto model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	
    	$searchModel = new TimelineEventSearch();
    	
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    	$dataProvider->sort = [
    			'defaultOrder'=>['created_at'=>SORT_DESC]
    	];
    	
    	if (Yii::$app->request->post()) {
			
    		$model = $this->findModel($id);
    		
    		$numeroRegistros = isset($_POST['numero_registros'])?$_POST['numero_registros']:0;
    		
    		$t = 0;
    		
    		return $this->redirect(['create-products', 'id' => $model->numero_serie,'registros'=>$numeroRegistros]);
    		
    	}
    	
        return $this->render('view', [
            'model' => $this->findModel($id),
        		'searchModel' => $searchModel,
        		'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
    	$model = new Producto();
        
        $model->codigo_registro = Yii::$app->getSecurity()->generateRandomString(8);

        if ($model->load(Yii::$app->request->post())) {
            
        	
        	$model->estado = Producto::STATUS_CREATED;
        	$model->fecha_registro = date('Y-m-d H:i:s');
        	
        	
        	if ($model->save())        	
        		return $this->redirect(['view', 'id' => $model->numero_serie]);
            
            
        }
        
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }
    
    
    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateProducts($id,$registros)
    {
    
    	$model =  $this->findModel($id);
    
    	$numeroRegistros = $registros;
    	
    	$models=[];
    	
    	$re = '/[0-9]{3}$/';
    	
    	$str = $model->numero_serie;
    	
    	
    	if (Yii::$app->request->post()) {
    	
    		
			    $count = count(Yii::$app->request->post('Producto', []));
			 	$productos = [new Producto()];
			 	
			    for($i = 1; $i < $count; $i++) {
			        $productos[] = new Producto();
			    }
			    
		    	if (Producto::loadMultiple($productos, Yii::$app->request->post()) && Producto::validateMultiple($productos)) {
		    		
		    		$transaction = Producto::getDb()->beginTransaction();
		    		
		    		try {
				            foreach ($productos as $producto) {
				            	
				            	if(!isset($model->id_provedor))
				            		$producto->id_provedor = NULL;
				            		$producto->fecha_registro = date('Y-m-d H:i:s');
				                	$producto->save(false);
				                	
				            }
				            
				            $transaction->commit();
				            
					}catch (\Exception $e) {
					    $transaction->rollBack();
					    throw $e;
					} catch (\Throwable $e) {
					    $transaction->rollBack();
					    throw $e;
					}
		            
		           Yii::$app->session->setFlash('success', "Se han creado [" . count($productos) . '] productos correctamente');
		            
		            return $this->redirect('index');
		        }else{
		        	
		        	return $this->render('create-products', [
		        			'models' => $productos,'model'=>$model
		        	]);
		        	
		        }
			    
    	
    	
    	
    	}
    	
    	
    	if (preg_match($re, $str, $matches)){
    		
    		
    		$serieSuf = $matches[0];
    		
    		if ( ($serieSuf + $numeroRegistros)  < 1000 ){ //tres ultimos digitos.
    			
      		
    		$models=[];
    		 
    		for ($i = 0; $i<$numeroRegistros; $i++){
    		
    			$newModel = new Producto();
    			
    			$serieSuf++;
    			
    			$strSerieSuf = '000'.$serieSuf;
    		
    			$newModel->setAttributes($model->attributes);
    			
    			$newModel->numero_serie =  substr($model->numero_serie,0, -3) . substr($strSerieSuf,-3);
    		
    			/*
    		
    			$newModel->tipo_producto = $model->tipo_producto;
    		
    			$newModel->precio_sugerido = $model->precio_sugerido;
    		
    			$newModel->categoria = $model->categoria;
    		
    			$newModel->descripcion = $model->descripcion;
    		
    			$newModel->email_valido_producto = $model->email_valido_producto;
    		
    			$newModel->estado = $model->estado;
    		
    			*/
    		
    		
    		
    			$newModel->codigo_registro = Yii::$app->getSecurity()->generateRandomString(8);
    		
    			$newModel->validate();
    		
    			$models[] = $newModel;
    			}
    			
    		}else{
    			
    		$model->addError('numero_serie','Este producto no puede ser creado en serie. Se deben solicitar menos productos en serie.');
    			
    		}
    		
    		
    	} else{
    		
    		$model->addError('numero_serie','Este producto no puede ser creado en serie. El numero de serie debe terminar con 3 digitos');
    		
    	}
    	
      	
    
    	
    
    	return $this->render('create-products', [
    			'models' => $models,'model'=>$model
    	]);
    
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->numero_serie]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
