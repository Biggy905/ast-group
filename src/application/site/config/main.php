<?php

use application\common\helpers\ApiUrl\AdminUrl;

$db = require '../../common/config/db.php';
$routes = require 'routes.php';
$apiRoutes = require '../../api/config/routes.php';
$containers = require 'containers.php';
$params = require 'params.php';

$config = [
    'id' => 'site',
    'name' => 'Сайт',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'application\site\controllers',
    'components' => [
        'assetManager' => [
            'linkAssets' => false,
            'forceCopy' => true,
        ],
        'request' => [
            'class' => \yii\web\Request::class,
            'cookieValidationKey' => 'tnb245vDdVgZwHZ1f-geEj8yF4nQ4gR5',
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'errorHandler' => [
            'class' => \yii\web\ErrorHandler::class,
            'errorAction' => 'error/index',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
        \application\common\helpers\AdminUrl\AdminUrl::$componentName  => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'baseUrl' => '/',
            'hostInfo' => sprintf('%s://%s:%s', 'http', 'localhost', '5020'),
            'rules' => $apiRoutes,
        ],
    ],
    'params' => $params,
    'container' => [
        'singletons' => $containers,
        'definitions' => [],
    ],
];

if (getenv('YII_DEBUG') === 1) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

if (getenv('YII_GII') === 1) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
