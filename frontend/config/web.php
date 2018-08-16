<?php
$config = [
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
            'shouldBeActivated' => true
        ],
        
    		'api' => [
    				'class' => 'frontend\modules\api\Module',
    				'modules' => [
    						'v1' => ['class'=> 'frontend\modules\api\v1\Module',
    						],
    						
    						'components' => [
    								// list of component configurations
    								'request' => [
    										'class'=>'yii\web\Request',
    										'parsers' => [
    												'application/json' => '\yii\web\JsonParser',
    										]
    								]
    						],
    				]
    		],
    		
    		'rest' => [
    				'class' => 'frontend\modules\rest\Module',
    				// ... other configurations for the module ...
    		],
    ],
    'components' => [
    		
    			'mailer' => [
    				'class' => 'yii\swiftmailer\Mailer',
    				'transport' => [
    						'class' => 'Swift_SmtpTransport',
    						'host' => 'mail.multicode.com.mx',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
    						'username' => 'contacto@multicode.com.mx',
    						'password' => 'Contacto2016.',
    						'port' => '25', // Port 25 is a very common port too
    						//'encryption' => 'ssl', // It is often used, check your provider or mail server specs
    					//	'timeout' => 2000 //in second
    				],
    		],
    		
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => env('GITHUB_CLIENT_ID'),
                    'clientSecret' => env('GITHUB_CLIENT_SECRET')
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => env('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => env('FACEBOOK_CLIENT_SECRET'),
                    'scope' => 'email,public_profile',
                    'attributeNames' => [
                        'name',
                        'email',
                        'first_name',
                        'last_name',
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => 'common\components\maintenance\Maintenance',
            'enabled' => function ($app) {
                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ]
    ],
    'as globalAccess'=>[
    		'class'=>'\common\behaviors\GlobalAccessBehavior',
    		'rules'=>[
    				[
    						'controllers'=>['producto-cliente'],
    						'allow' => true,
    						'roles' => ['@'],
    						
    				],
    				[
    				'controllers'=>['site'],
    				'allow' => true,
    				'roles' => ['?', '@'],
    				
    				],
    				[
    				'controllers'=>['user/sign-in'],
    				'allow' => true,
    				'roles' => ['@','?'],
    				
    				],
    				[
    				'controllers'=>['user/default'],
    				'allow' => true,
    				'roles' => ['@','?'],
    				
    				],
    				[
    				'controllers'=>['api/v1/user'],
    				'allow' => true,
    				'roles' => ['@','?'],
    				
    				],
    				[
    				'controllers'=>['api/v1/device-service'],
    				'allow' => true,
    				'roles' => ['@','?'],
    				
    				],
    				
    				[
    				'controllers'=>['api/v1/promocion-service'],
    				'allow' => true,
    				'roles' => ['@','?'],
    				
    				],
    				
    		]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'messageCategory'=>'frontend'
            ]
        ]
    ];
}

return $config;
