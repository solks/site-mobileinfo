<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'urlManager' => [
        	'enablePrettyUrl' => true,
        	'showScriptName'=>false,
        	'enableStrictParsing' => false,
        	'rules' => [
        		'posts' => 'post/index',
        		'blog' => 'blog/index',
        		'categories' => 'category/index',
        		'comments' => 'comment/index',
        		'users' => 'user/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	],
        ],
        'urlManagerFrontend' => [
        	'class' => 'yii\web\UrlManager',
        	'baseUrl' => $params['baseUrl'],
        	'hostInfo' => '',
        	'enablePrettyUrl' => true,
        	'enableStrictParsing' => true,
        	'showScriptName' => false,
        	'rules' => [
        		'blog/<id:\d+>-<title>' => 'blog/view',
        		'blog' => 'blog/index',
        		'site/<action:\w+>' => 'site/<action>',
        		'<category:[\w-]+>/<id:\d+>-<title>' => 'post/view',
        		'<category:[\w-]+>/<tag:[\w-]+>' => 'post/index',
        		'<category:[\w-]+>' => 'post/index',
        		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        	],
        ],
    ],
    'params' => $params,
];
