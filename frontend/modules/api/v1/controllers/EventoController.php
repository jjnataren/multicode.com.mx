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

/**
 * @author Jesus Nataren <jesus.nataren@terentev.net>
 */
class EventoController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'frontend\modules\api\v1\resources\EventoAlarma';

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

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass
            ],
        
        	    
       	/*	'create' => [
        				'class' => 'yii\rest\CreateAction',
        				'modelClass' => $this->modelClass,
        			//	'findModel' => [$this, 'actionCreate']
        		],*/
        		        		
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
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
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public function findModel($id){
    	
    	
    	$timeZone = isset($_GET['tz'])?$_GET['tz']:'America/Mexico_City';
    	
    	date_default_timezone_set($timeZone);
    	 
    	$fecha = date('Y-m-d H:i:s');
    	
        $model = EventoAlarma::findBySql('select * from tbl_evento_alarma 
        		where ( fecha_suceso > date_sub(\''.$fecha.'\', interval 5 minute) AND fecha_suceso < \''.$fecha.'\' )and id_alarma =' .$id .' order by fecha_suceso desc')->one();
	    	
    	if (!isset($model)) {
    		return ['ESTATUS'=>'0'];
    	}
    	
    	return $model;
    	
        
    }
    
    
    /**
     * Creates  a new alarma evento
     */
    public function actionCreate()
    {
  
    	
    	$post = file_get_contents("php://input");
    	
    	//decode json post input as php array:
    	$data =Json::decode($post, true);
    	
    	$model = new EventoAlarma();
    	
    	$model->attributes = $data;
    	

    	
    	$timeZone = isset($_GET['tz'])?$_GET['tz']:'America/Mexico_City';
    	

    	date_default_timezone_set($timeZone);
    	
    	$model->FECHA_SUCESO = date('Y-m-d H:i:s');
    	
    	$model->save();
    	
    	//load json data into model:
    	
    	    	
    	return ["ID_EVENTO"=>$model->ID_EVENTO,'FECHA'=>$model->FECHA_SUCESO];
    }
}
