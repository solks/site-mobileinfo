<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
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
        'urlManager' => [
        	'enablePrettyUrl' => true,
        	'showScriptName'=>false,
        	'enableStrictParsing' => true,
        	'rules' => [
        		'blog/<id:\d+>-<title>' => 'blog/view',
        		'blog' => 'blog/index',
        		'<category:\w+>/<id:\d+>-<title>' => 'post/view',
        		'<category:\w+>/<tag:\w+>' => 'post/index',
        		'<category:\w+>' => 'post/index',
        		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        	],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
