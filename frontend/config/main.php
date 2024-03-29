<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module',
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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

        'request' => [
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
              ],
        ],

        'urlManager' => [
            'baseUrl' => '/',
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'article',
                    'pluralize' => false
                ],
                'GET article/index' => 'article/index',
                'GET article/<id:\d+>' => 'article/view',

                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ]
    ],
    'params' => $params,
];
