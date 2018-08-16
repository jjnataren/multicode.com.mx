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
use backend\models\TipoProducto;

/**
 * Site controller
 */
class ProductoGeneralController extends Controller
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
     * Retrieves a particular tipo producto model
     * @throws NotFoundHttpException
     * @return \yii\web\Response|string
     */
    public function actionVerTipoProducto($id)
    {
    	
    	$model = TipoProducto::findOne(['id_tipo_producto'=>$id,'categoria'=>TipoProducto::CATEGORIA_MULTICODE]) ;
    	if(!$model) throw new NotFoundHttpException('The requested page does not exist.');
        return $this->render('tipo-producto', [
            'model' => $model,
        ]);
        
    }
    
    
        
    
}
