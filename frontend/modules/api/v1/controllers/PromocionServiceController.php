<?php

namespace frontend\modules\api\v1\controllers;

use common\models\User;
use frontend\modules\api\v1\resources\EventoAlarma;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\Json;
use yii\base\Object;
use backend\models\AlarmaConfig;
use yii\base\Exception;
use frontend\models\AlarmaUsuario;
use frontend\models\AlarmaColab;
use backend\models\Cliente;
use backend\models\Producto;
use backend\models\CodigoLog;
use frontend\models\ValidateForm;
use backend\models\Promocion;


/**
 * @author Jesus Nataren <jesus.nataren@pinfosoft.com.mx>
 */
class PromocionServiceController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'backend\models\Promocion';

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

           list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['REDIRECT_HTTP_AUTHORIZATION'], 6)));


        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $user = User::findByLogin($username);
                        return $user->validatePassword($password)
                            ? $user
                            : null;
                    }
                ],
                HttpBearerAuth::className(),
                QueryParamAuth::className()
            ]
        ];

        
        $behaviors['verbFilter'] = [
        		'class' => \yii\filters\VerbFilter::className(),
        		'actions' => [
        				'get-avaliable-promotions'   => ['get'],
        		],
        ];
        
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        		
         /*   'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass
            ],*/
        
        	    
       	/*	'create' => [
        				'class' => 'yii\rest\CreateAction',
        				'modelClass' => $this->modelClass,
        			//	'findModel' => [$this, 'actionCreate']
        		],*/
        		        		
     /*       'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],*/
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            		'request' => [
            				'class'=>'yii\web\Request',
            				'parsers' => [
            						'application/json' => '\yii\web\JsonParser',
            				]
            		]
            ]
        ];
    }

    /**
     * @return null|static
     * @throws NotFoundHttpException
     */
    public function actionGetAvaliablePromotions(){
    
    	$user  = \Yii::$app->user;
    	
		$client = Cliente::findOne(['id_usuario'=>$user->id]);
		
		if  (!$client){
			
			throw new \yii\web\HttpException(500,'Cliente no autorizado');
		}
    	
		
		$promociones = Promocion::findBySql('SELECT * FROM tbl_promocion where now() between fecha_inicio and fecha_fin')->all();
    	
    	return $promociones;
    
    }
    
    
}


//manejar Desbloqueo