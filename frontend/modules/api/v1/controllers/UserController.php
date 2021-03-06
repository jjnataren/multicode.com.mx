<?php

namespace frontend\modules\api\v1\controllers;

use common\models\User;
use frontend\modules\api\v1\resources\User as UserResource;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\base\Object;
use yii\base\Exception;
use yii\helpers\Json;
use frontend\modules\user\models\SignupForm;
use backend\models\Producto;
use backend\models\Cliente;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'frontend\modules\api\v1\resources\User';

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
                        return ($user && $user->validatePassword($password) )
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
                'do-login'  => ['post'],
                'signup'   => ['post'],
           //     'create' => ['get', 'post'],
            //    'update' => ['get', 'put', 'post'],
            //    'delete' => ['post', 'delete'],
            ],
        ];
        
        return $behaviors;
    }
    
    
    /**
     * Creates  signup event
     */
    public function actionSignup()
    {
    	 
    	 
    	$post = file_get_contents("php://input");
    
    	//decode json post input as php array:
    	$data =Json::decode($post, true);
    
    	$sModel = new SignupForm();
    	 
    	$sModel->attributes = $data;
    	
    	
    	$producto = Producto::findOne(['numero_serie'=>$sModel->serial,'codigo_registro'=>$sModel->codigo]);
    	 
    	if (!$sModel->validate() || !$producto ||  isset($producto->idPropietario)){
    		
    		if (isset($producto->idPropietario)){
    			
    			$sModel->addError('serial','El producto ya ha sido registrado');
    		}elseif(!$producto){
    			
    			$sModel->addError('serial','El producto indicado no existe');
    		}
    
    		
    		$separado_por_comas = implode(",", $sModel->getFirstErrors());
    		
    		throw new \yii\web\HttpException(500,Json::encode($sModel->getErrors()));
    		
    	}
    	
    	
    
    	$transaction = Producto::getDb()->beginTransaction();
    	 
    	$model =  new User();
    	 
    	$model->username = $sModel->username;
    	 
    	$model->email = $sModel->email;
    	 
    	$model->status  =  User::STATUS_ACTIVE;
    	 
    	$model->setPassword($sModel->password);
    	 
    	if(!$model->save()) {
    		
    			$transaction->rollBack();
    
    			throw new \yii\web\HttpException(500,$model->getErrors()) ;
    			
    			
    		 
    	};
    	
    	
    	$clienteModel  =  new Cliente();
    	 
    	$clienteModel->email =   $sModel->email;
    	
    	$clienteModel->id_usuario  =  $model->id;
    	
    	if(!$clienteModel->save()) {
    		
    		$transaction->rollBack();
    	
    		throw new \yii\web\HttpException(500,$clienteModel->getErrors()) ;

    		
    	};
    	
    	
    	$producto->id_propietario = $clienteModel->id_cliente;
    	
    	$producto->fecha_registro = date('Y-m-d');
    	 
    	$producto->estado = Producto::STATUS_REGISTRED_CLIENT;
    	
    	if (!$producto->save()){
    		
    		$transaction->rollBack();
    	
    		throw new \yii\web\HttpException(500,$producto->getErrors()) ;

    	
    	};
    	
    	$transaction->commit();
    
    	$model->afterSignup();
    
    	return $model;
    	
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
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction'
            ]
        ];
    }
    
    
    /**
     * Creates  login event
     */
    public function actionDoLogin()
    {
    
    	
    	$user  = \Yii::$app->user;
    	
    	$cliente = Cliente::findOne(['id_usuario'=>$user->id]);
    	
    	if (!$cliente){
    		
    		throw new \yii\web\HttpException(500, 'El usuario no esta autorizado') ;
    	}
    	
    	return ['login'=>true,'date'=>date('Y-m-d H:i:s'),'user_id'=>\Yii::$app->user->id];
    }

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        $model = UserResource::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $model;
    }
}
