<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use frontend\models\ValidateForm;
use yii\web\Controller;
use yii\base\Object;
use backend\models\Venta;
use backend\models\Cliente;
use backend\models\Producto;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ProductoClienteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    
    
    /**
     * devuelve todos los productos relacionados a un clietne
     * @throws NotFoundHttpException
     * @return \yii\web\Response|string
     */
    public function actionMisProductos()
    {
        
        /*$model = new ContactForm();
        
        $cliente = Cliente::findOne(Yii::$app->user->identity->id);
        
        if(!$cliente) throw new NotFoundHttpException('The requested page does not exist.');
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options'=>['class'=>'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'There was an error sending email.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }*/
    	
    	
    	$cliente = Cliente::findOne(['id_usuario'=> Yii::$app->user->identity->id]);
    	
    	if(!$cliente) throw new NotFoundHttpException('The requested page does not exist.');
    	
    	$model = new Producto();
    	
    	$productos = Producto::findBySql('select * from tbl_producto where id_propietario = :id and estado > :estado ',[':id'=>$cliente->id_cliente, ':estado'=>2])->all();
    	
        return $this->render('index', [
            'model' => $model,
        	'productos'=>$productos	
        ]);
        
    }
    
    
    /**
     * Actualiza informacion del cliente
     */
    public function actionRegistroProducto(){
    	
    	$cliente = Cliente::findOne(['id_usuario'=> Yii::$app->user->identity->id]);
    	
    	if(!$cliente) throw new NotFoundHttpException('Usuario no registrado');
    	
    	$productoModel = new ValidateForm();
    	
    	if ($productoModel->load(Yii::$app->request->post())) {
    		
    		$producto = Producto::findOne(['numero_serie'=>$productoModel->numero_serie, 'codigo_registro'=>$productoModel->codigo_registro]);
    		
    		if($productoModel->fechaAdquirio){//hay valor en la fecha, entonces se formatea para mysql
    			$dateTmp = \DateTime::createFromFormat('d/m/Y', $productoModel->fechaAdquirio);
    			$productoModel->fechaAdquirio = $dateTmp->format('Y-m-d');
    		}
    		
    		if(!$producto) $productoModel->addError('numero_serie','Producto no encontrado, revise  número de serie y  proveedor.');
    			else {
    				
    				if ($producto->estado  > Producto::STATUS_VALIDATED_PROVIDER){
    				
    					if ($producto->id_propietario ===  $cliente->id_cliente){
    						
    					//	$productoModel->addError('numero_serie','');
    						
    						Yii::$app->getSession()->setFlash('alert', [
    								'body'=>Yii::t('frontend', 'Ya se ha asociado el producto a su cuenta'),
    								'options'=>['class'=>'alert-info']
    						]);
    						
    						$productoModel->addError('numero_serie','El producto ya esta asociado a su cuenta.');
    					}else    					
    						$productoModel->addError('numero_serie','Producto registrado  por  otro cliente, contacte al administrador');
    					
    				}elseif ($producto->estado > Producto::STATUS_CREATED){
    					
    						$producto->id_propietario	= 	$cliente->id_cliente;
    						$producto->estado	= Producto::STATUS_REGISTRED_CLIENT;
    						$producto->fecha_registro = date('Y-m-d');
    						$producto->fecha_adquirio_cliente = $productoModel->fechaAdquirio;	
    						
    						if($producto->save() ) {
    							
    							//Linea de tiempo 
    							
    							Yii::$app->getSession()->setFlash('alert', [
    									'body'=>Yii::t('frontend', 'Producto registrado correctamente !'),
    									'options'=>['class'=>'alert-success']
    							]);
    							
    							
    							
    						}else{
    							
    							Yii::$app->getSession()->setFlash('alert', [
    									'body'=>Yii::t('frontend', '! No fue posible registrar el producto, intente mas tarde !'),
    									'options'=>['class'=>'alert-danger']
    							]);
    								
    								
    						}
    						
    						return $this->redirect('mis-productos');
    					
    				}else{
    					
    					$productoModel->addError('numero_serie','Producto no disponible para registro');
    					
    				}	
    				
    				
    			}
    			
    			
				
			

			
    	}
    	
    	
    	return $this->render('registra-producto', [
    			'model' => $productoModel,
    	]);
    	
    }
    
    
    

    public function actionValidateProducto()
    {
    	$model = new ValidateForm();
    	$modelResult = null;
    	$modelVentaResult = null;
    	
    	if ($model->load(Yii::$app->request->post())) {
    		
    		$modelResult = Producto::findOne($model->numero_serie);
    		$modelVentaResult = Venta::findOne(['numero_serie'=>$model->numero_serie]);
    		
    		if ($modelResult || $modelVentaResult){
    			
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>Yii::t('frontend', 'Producto encontrado'),
    					'options'=>['class'=>'alert-success']
    			]);
    			
    		}else{
    			
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>\Yii::t('frontend', 'El producto indicado no existe en inventario.'),
    					'options'=>['class'=>'alert-danger']
    			]);
    			
    		}
    			
    		
    		/*
    		if ($model->contact(Yii::$app->params['adminEmail'])) {
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
    					'options'=>['class'=>'alert-success']
    			]);
    			return $this->refresh();
    		} else {
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>\Yii::t('frontend', 'There was an error sending email.'),
    					'options'=>['class'=>'alert-danger']
    			]);
    		}*/
    		
    	}
    
    	return $this->render('validate-product', [
    			'model' => $model,
    			'modelResult' => $modelResult,
    			'modelVentaResult'=>$modelVentaResult
    	]);
    }
    
    
    
}
