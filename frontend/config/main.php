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
        'assetManager' => [
            'appendTimestamp' => true,
        ],
		'view' => [
            'theme' => [
                'basePath' => '@app/themes/desktop',
                'baseUrl' => '@web/themes/desktop',
                'pathMap' => [
                    '@app/views' => '@app/themes/desktop',
                ],
            ],
        ],
        'urlManager' => [
        	'enablePrettyUrl' => true,
        	'showScriptName'=>false,
        	'enableStrictParsing' => false,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
