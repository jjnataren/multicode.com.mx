<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use frontend\models\ValidateForm;
use yii\web\Controller;
use yii\base\Object;
use backend\models\Producto;
use backend\models\Venta;
use backend\models\Cliente;
use yii\web\NotFoundHttpException;
use backend\models\Proveedor;
use backend\models\Promocion;

/**
 * Site controller
 */
class SiteController extends Controller
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

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    
    public function actionPortfolio()
    {
    	return $this->render('portfolio');
    }
    
    public function actionNosotros()
    {
    	return $this->render('nosotros');
    }    
    
    
    public function actionServicios()
    {
    	return $this->render('servicios');
    }
    
    public function actionMulticode()
    {
    	return $this->render('multicode');
    }
    
    public function actionVentas()
    {
    	return $this->render('ventas');
    }
    
    public function actionDiagnostico()
    {
    	return $this->render('diagnostico');
    }
    public function actionAccesorios()
    {
    	return $this->render('accesorios');
    }
    
    public function actionDistribuidor()
    {
    	
    	$proveedorModel = Proveedor::findBySql('select * from tbl_proveedor')->all();
    	
    	return $this->render('distribuidor',['proveedores'=>$proveedorModel]);
    }
    
    
    /**
     * Get avaliable promotions
     */
    public function actionPromociones()
    {
    	 
    	$promotions = Promocion::findBySql('SELECT * FROM tbl_promocion where now() between fecha_inicio and fecha_fin')->all();
    	 
    	return $this->render('promociones',['promotions'=>$promotions]);
    
    }
    
    
    /**
     * Get a particular promotion
     * @param integer $id
     */
    public function actionPromocion($id)
    {
    
    	$promotion = Promocion::findBySql('SELECT * FROM tbl_promocion where id_promocion = '.$id.' and estatus = 1 and now() between fecha_inicio and fecha_fin')->one();
    
    	return $this->render('promocion',['promotion'=>$promotion]);
    
    }
    
    
    
    public function actionContact()
    {
        $model = new ContactForm();
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
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }
    
    
    /**
     * Actualiza informacion del cliente
     */
    public function actionActualizarInformacionPersonal(){
    	
    	$cliente = Cliente::findOne(['id_usuario'=>Yii::$app->user->identity->id]);
    	
    	if(!$cliente) throw new NotFoundHttpException('The requested page does not exist.');
    	
    	
    	if($cliente->fecha_nacimiento){//hay valor en la fecha, entonces se formatea para mysql
    		$dateTmp = \DateTime::createFromFormat('d/m/Y', $cliente ->fecha_nacimiento);
    		$cliente->fecha_nacimiento = $dateTmp->format('Y-m-d');
    	}
    	
    	if ($cliente->load(Yii::$app->request->post()) && $cliente->save()) {
    		
    		
    		Yii::$app->getSession()->setFlash('alert', [
    				'body'=>Yii::t('frontend', 'Información actualizada correctamente'),
    				'options'=>['class'=>'alert-success']
    		]);
    		
    		return $this->redirect('/site/actualizar-informacion-personal');
    		
    		
    	}
    	
    	return $this->render('informacion-personal', [
    			'model' => $cliente,
    	]);
    	
    }
    
    
    
/**
 * Validates a  particular product against its serial number
 */
    public function actionValidarProducto()
    {
    	$model = new ValidateForm();
    	$modelResult = null;
    	$modelVentaResult = null;
    	
    	if ($model->load(Yii::$app->request->post())) {
    		
    		$modelResult = Producto::findOne($model->numero_serie);
    		
    		$modelVentaResult = ($modelResult)?$modelResult->numeroOrden : null;
    		
    		if ($modelResult && $modelResult->estado > Producto::STATUS_CREATED &&  $modelResult->idProvedor &&  $modelVentaResult ){
    			
    			
    			if ($modelResult->estado === Producto::STATUS_ASIGNDED_PROVIDER){
    				
    				$modelResult->estado = Producto::STATUS_VALIDATED_PROVIDER;
    				
    				$modelResult->fecha_valido_proveedor = date('Y-m-d H:m:s');
    				
    				$modelResult->email_valido_producto = $model->correo_electronico_proveedor;
    				
    				$modelResult->save();
    			}
    			
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>Yii::t('frontend', 'Producto encontrado'),
    					'options'=>['class'=>'alert-success']
    			]);
    			
    			
    		}else{
    			
    			
    			if(!$modelResult)
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
    			'modelVentaResult'=> $modelVentaResult
    	]);
    }
    
    
    
}
