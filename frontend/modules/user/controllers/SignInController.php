<?php

namespace frontend\modules\user\controllers;

use common\commands\SendEmailCommand;
use common\models\User;
use backend\models\Cliente;
use common\models\UserToken;
use common\models\UserProfile;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\ValidateForm;
use frontend\modules\user\models\PasswordResetRequestForm;
use frontend\modules\user\models\ResetPasswordForm;
use frontend\modules\user\models\SignupForm;
use Yii;

use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\base\Object;
use backend\models\Producto;

/**
 * Class SignInController
 * @package frontend\modules\user\controllers
 * @author Eugene Terentev <eugene@terentev.net>
 */
class SignInController extends \yii\web\Controller
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
        	
        		'captcha' => [
        				'class' => 'yii\captcha\CaptchaAction',
        				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
        		],
            'oauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successOAuthCallback']
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'signup', 'login', 'request-password-reset', 'reset-password', 'oauth', 'activation','captcha'
                        ],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => [
                            'signup', 'login', 'request-password-reset', 'reset-password', 'oauth', 'activation','captcha'
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                        'denyCallback' => function () {
                            return Yii::$app->controller->redirect(['/user/default/index']);
                        }
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * @return array|string|Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if (Yii::$app->request->isAjax) {
            $model->load($_POST);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        	
        	Yii::$app->getSession()->setFlash('alert', [
        			'body' => Yii::t(
        					'frontend',
        					'Acceso correcto'
        			),
        			'options' => ['class'=>'alert-success']
        	]);
        	
            return $this->redirect("/");
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * @return string|Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        
        $userProfile = new UserProfile();
        
        $product = new ValidateForm();
        
        if ($model->load(Yii::$app->request->post())) {
        	
        	$product->load(Yii::$app->request->post());
        	
        	$newProduct = Producto::findOne(['numero_serie'=>$product->numero_serie, 'codigo_registro'=>$product->codigo_registro]);

        	if (!$newProduct || $newProduct->id_propietario || $newProduct->estado > Producto::STATUS_SOLED_CLIENT  ){
        		
        		$product->addError('numero_serie','El número de serie indicado no existe en inventario o esta asignado a otro usuario.');
        		
        		$model->validate();
        		
        		$userProfile->load(Yii::$app->request->post());	
        		
        		$userProfile->validate();
        			
        		return $this->render('signup', [
        				'model' => $model,
        				'userProfile'=>$userProfile,
        				'productoModel'=>$product,
        		
        		]);
        		
        		
        	}
        	
        	
        	$transaction = Cliente::getDb()->beginTransaction();
        	
        	try {
        		
        		
        		$user = $model->signup();
        		 
        		$userProfile = isset($user)? UserProfile::findOne($user->id) : new UserProfile();
        		
        		$userProfile->load(Yii::$app->request->post());
        		 
        		$cliente  =  new Cliente();
        		 
        		$cliente->fecha_registro  = date("Y-m-d H:i:s");
        		 
        		$cliente->apellido_materno   = $userProfile->lastname;
        		 
        		$cliente->apellido_paterno   = $userProfile->middlename;
        		 
        		$cliente->nombre   = $userProfile->firstname;
        		 
        		$cliente->id_usuario  = isset($user->id) ? $user->id : null;
        		 
        		$cliente->save();
        		 
        		$userProfile->save();
        		 
        		$newProduct->fecha_registro = date('Y-m-d');
        		 
        		$newProduct->estado = Producto::STATUS_REGISTRED_CLIENT;
        		 
        		$newProduct->id_propietario	= 	$cliente->id_cliente;
        		 
        		$newProduct->save();
        	
        		$transaction->commit();
        	
        	}catch (\Exception $e) {
        		$transaction->rollBack();
        		throw $e;
        	} catch (\Throwable $e) {
        		$transaction->rollBack();
        		throw $e;
        	}
            
            if ($user && $newProduct && $cliente) {

            	if ($model->shouldBeActivated()) {
                	
                } else {
                    Yii::$app->getUser()->login($user);
                }
                
                Yii::$app->getSession()->setFlash('alert', [
                		'body' =>'Tu cuenta ha sido creada, consulta tu correo para mas detalles.',
                		'options' => ['class'=>'alert-success']
                ]);
                
              
                return $this->goHome();
            }else{
            	

            	Yii::$app->getSession()->setFlash('alert', [
            			'body' => Yii::t(
            					'frontend',
            					'Error on create user.'
            			),
            			'options' => ['class'=>'alert-danger']
            	]);
            	
            }
        }

        return $this->render('signup', [
            'model' => $model,
        	'userProfile'=>$userProfile,
        	'productoModel'=>$product,	
        ]);
    }

    
    /**
     * 
     * @param unknown $token
     * @throws BadRequestHttpException
     */
    public function actionActivation($token)
    {
        $token = UserToken::find()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->notExpired()
            ->one();

        if (!$token) {
            throw new BadRequestHttpException;
        }

        $user = $token->user;
        $user->updateAttributes([
            'status' => User::STATUS_ACTIVE
        ]);
        $token->delete();
        Yii::$app->getUser()->login($user);
        Yii::$app->getSession()->setFlash('alert', [
            'body' => Yii::t('frontend', 'Your account has been successfully activated.'),
            'options' => ['class'=>'alert-success']
        ]);

        return $this->goHome();
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Check your email for further instructions.'),
                    'options'=>['class'=>'alert-success']
                ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('alert', [
                'body'=> Yii::t('frontend', 'New password was saved.'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @param $client \yii\authclient\BaseClient
     * @return bool
     * @throws Exception
     */
    public function successOAuthCallback($client)
    {
        // use BaseClient::normalizeUserAttributeMap to provide consistency for user attribute`s names
        $attributes = $client->getUserAttributes();
        $user = User::find()->where([
                'oauth_client'=>$client->getName(),
                'oauth_client_user_id'=>ArrayHelper::getValue($attributes, 'id')
            ])
            ->one();
        if (!$user) {
            $user = new User();
            $user->scenario = 'oauth_create';
            $user->username = ArrayHelper::getValue($attributes, 'login');
            $user->email = ArrayHelper::getValue($attributes, 'email');
            $user->oauth_client = $client->getName();
            $user->oauth_client_user_id = ArrayHelper::getValue($attributes, 'id');
            $password = Yii::$app->security->generateRandomString(8);
            $user->setPassword($password);
            if ($user->save()) {
                $profileData = [];
                if ($client->getName() === 'facebook') {
                    $profileData['firstname'] = ArrayHelper::getValue($attributes, 'first_name');
                    $profileData['lastname'] = ArrayHelper::getValue($attributes, 'last_name');
                }
                $user->afterSignup($profileData);
                $sentSuccess = Yii::$app->commandBus->handle(new SendEmailCommand([
                    'view' => 'oauth_welcome',
                    'params' => ['user'=>$user, 'password'=>$password],
                    'subject' => Yii::t('frontend', '{app-name} | Your login information', ['app-name'=>Yii::$app->name]),
                    'to' => $user->email
                ]));
                if ($sentSuccess) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options'=>['class'=>'alert-success'],
                            'body'=>Yii::t('frontend', 'Welcome to {app-name}. Email with your login information was sent to your email.', [
                                'app-name'=>Yii::$app->name
                            ])
                        ]
                    );
                }

            } else {
                // We already have a user with this email. Do what you want in such case
                if ($user->email && User::find()->where(['email'=>$user->email])->count()) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options'=>['class'=>'alert-danger'],
                            'body'=>Yii::t('frontend', 'We already have a user with email {email}', [
                                'email'=>$user->email
                            ])
                        ]
                    );
                } else {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options'=>['class'=>'alert-danger'],
                            'body'=>Yii::t('frontend', 'Error while oauth process.')
                        ]
                    );
                }

            };
        }
        if (Yii::$app->user->login($user, 3600 * 24 * 30)) {
            return true;
        } else {
            throw new Exception('OAuth error');
        }
    }
}
