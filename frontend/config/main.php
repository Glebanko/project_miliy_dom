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
    'language'=>'ru-RU',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'goods/<id:[0-9a-zA-Z_-]+>'=>'site/goods',
                'cartgoods/<id:[0-9a-zA-Z_-]+>'=>'site/cartgoods',
                'basket' => 'basket/basket',
                'massivecookie' => 'basket/massivecookie',
                'deletebasketform' => 'basket/deletebasketform',
                'gobasket' => 'basket/gobasket',
                'basketrequest' => 'basket/basketrequest',
                'gobasketcookie' => 'basket/gobasketcookie',
                'searchcookie' => 'basket/searchcookie',
                'amountgoods' => 'basket/amountgoods',
                'profile' => 'profile/profile',
                'settings-profile' => 'profile/settings-profile',
                'upload-image' => 'profile/upload-image',
            ],
        ],
    ],
    'params' => $params,
];
