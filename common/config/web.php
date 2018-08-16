<?php
$config = [
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'linkAssets' => env('LINK_ASSETS'),
            'appendTimestamp' => YII_ENV_DEV
        ],
    		/*'mailer' => [
    				'class' => 'yii\swiftmailer\Mailer',
    				'transport' => [
    						'class' => 'Swift_SmtpTransport',
    						'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
    						'username' => 'jesus.nataren@gmail.com',
    						'password' => 'Karen621Quetzal.',
    						'port' => '587', // Port 25 is a very common port too
    						'encryption' => 'tls', // It is often used, check your provider or mail server specs
    				],
    		],*/
    		
    ],
    'as locale' => [
        'class' => 'common\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ]
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
}

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1'],
    ];
}


return $config;
