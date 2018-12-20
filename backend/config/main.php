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
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/admin',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/admin',
            ],
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
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<module>/<controller>/<action>',
                ['pattern' => 'yandex-market', 'route' => 'yml/default/index', 'suffix' => '.yml'],
                ['pattern' => 'prom-market', 'route' => 'prom/default/index', 'suffix' => '.yml'],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/views/yii2-app'
                ],
            ],
        ],
    ],
    'modules' => [
        'i18n' => Zelenin\yii\modules\I18n\Module::className(),
        'translation' => [
            'class' => 'sirgalas\translation\Module',
        ],
        'user' => [
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'controllerMap' => [
                'admin' => 'backend\controllers\SettingController'
            ],
        ],
        'menu'  =>[
            'class' =>  'sirgalas\menu\MenuModule',
            'imageDownloadPath'     =>  Yii::getAlias('@frontend/').'web/image/menu/',
            'imageSetPath'     =>  Yii::getAlias('@frontendWebroot').'/image/menu/',
            'imageResize'   =>  [[80, 40],[179,156]],
            'extra_menu'    =>  2,
            'models' =>  [
                [
                'class' =>  '\common\models\Gods',
                'label' =>  'выбирите товар',
                'title' =>  'title',
                'id'    =>  'id',
                'alias' =>  'slug_gods',
                'path'  =>  '/gods/gods/onegods',
                ],
                [
                'class' =>  '\common\models\Category',
                'title' =>  'name',
                'label' =>  'выбирите категорию',
                'id'    =>  'id',
                'alias' =>  'slug_category',
                'path'  =>  '/gods/gods/category',
                'image' =>  'true'
                ],
                [
                'class' =>  '\common\models\Page',
                'title' =>  'title',
                'label' =>  'выбирите страницу',
                'id'    =>  'id',
                'alias' =>  'slug_page',
                'path'  =>  '/office/office/index',
                ],
                [
                'class' =>  '\common\models\Post',
                'title' =>  'title',
                'label' =>  'выбирите новости',
                'id'    =>  'id',
                'alias' =>  'slug_post',
                'path'  =>  '/post/post/onepost',
                'image' =>  'true'
                ]
            ],
        ],
        'prom' => [
            'class' => 'backend\modules\prom\Module',
            'enableGzip' => true,
            'cacheExpire' => 1,
            'categoryPromModel' => 'common\models\Category',
            'shopOptions' => [
                'name' => 'Милый Дом',
                'company' => 'Интернет-магазин Милый Дом - большой выбор постельного белья по доступным ценам, полотенец для всей семьи, а также мужской и женской одежды по самым низким ценам',
                'url' => 'http://miliydom.com.ua/',
                'currencies' => [
                    [
                        'id' => 'UAH',
                        'rate' => 1
                    ]
                ],
            ],
            'offerPromModels' => [
                ['class' => 'common\models\Gods'],
            ],
        ],
        'yml' => [
            'class' => 'corpsepk\yml\YandexMarketYml',
            'enableGzip' => true,
            'cacheExpire' => 1,
            'categoryModel' => 'common\models\Category',
            'shopOptions' => [
                'name' => 'Милый Дом',
                'company' => 'Интернет-магазин Милый Дом - большой выбор постельного белья по доступным ценам, полотенец для всей семьи, а также мужской и женской одежды по самым низким ценам',
                'url' => 'http://miliydom.com.ua/',
                'currencies' => [
                    [
                        'id' => 'UAH',
                        'rate' => 1
                    ]
                ],
            ],
            'offerModels' => [
                ['class' => 'common\models\Gods'],
            ],
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'params' => $params,
];
