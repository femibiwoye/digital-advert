<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'name'=>'moreSave',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/views/yii2-app'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class'=>'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' =>false,
            'useFileTransport' => false,
            'htmlLayout' => 'layouts/verification',

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'abiodunnoyekunle@gmail.com',
                'password' => 'December_1994',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];
