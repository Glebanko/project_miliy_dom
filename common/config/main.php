<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'Europe/Moscow',
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],

            'root' => [
                'baseUrl'=>'@frontend',
                'basePath'=>'@frontend',
                'path' => '/web/image',
                'name' => '/web/image'
            ],
            'watermark' => [
                'source'         => __DIR__.'/logo.png', // Path to Water mark image
                'marginRight'    => 5,          // Margin right pixel
                'marginBottom'   => 5,          // Margin bottom pixel
                'quality'        => 95,         // JPEG image save quality
                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                'targetMinPixel' => 200         // Target image minimum pixel size
            ]
        ]
    ],
    'components' => [
        
        'sypexGeo' => [
            'class' => 'omnilight\sypexgeo\SypexGeo',
            'database' => '@frontend/widget/SxGeo.dat',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:j F, H:i',
            'timeFormat' => 'php:H:i:s',
            'defaultTimeZone' => 'Europe/Moscow',
            'locale' => 'ru-RU'
        ],
        'i18n' => [
            'class' => Zelenin\yii\modules\I18n\components\I18N::className(),
            'languages' => ['ru-RU'],
            'translations' => [
                'yii' => [
                    'class' => yii\i18n\DbMessageSource::className()
                ]
            ]
            /*'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],*/
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
    ],
    'aliases' => [
        '@YiiNodeSocket' => '@vendor/oncesk/yii-node-socket/lib/php',
        '@nodeWeb' => '@vendor/oncesk/yii-node-socket/lib/js'
    ],
    'modules' => [
        'menu'  =>[
            'class' =>  'sirgalas\menu\MenuModule',
            'modelDb' =>  '\common\models\FrontendSetup',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'modelMap' => [
                'User' => 'common\models\User',
            ],
            'adminPermission' => 'role, permission',
            'admins'=>['Sergalas','zayabelka'],
            
        ],

        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
];
