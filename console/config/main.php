<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'node-socket' => '\YiiNodeSocket\NodeSocketCommand',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'nodeSocket' => [
            'class' => '\YiiNodeSocket\NodeSocket',
            'host' => 'localhost',
            'allowedServerAddresses' => [
                "localhost",
                "127.0.0.1"
            ],
            'origin' => ':',
            'sessionVarName' => 'PHPSESSID',
            'port' => 3001,
            'socketLogFile' => '/var/log/node-socket.log',
        ],
    ],
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacConsoleModule',

    ],
    'params' => $params,
];
