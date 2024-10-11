<?php

use application\common\helpers\SiteUrl\SiteUrl;

$db = require '../../common/config/db.php';
$routes = require 'routes.php';
$siteRoutes = require '../../site/config/routes.php';
$singletons = require 'singletons.php';
$params = require 'params.php';

$config = [
    'id' => 'admin',
    'name' => 'Сайт',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log', 'queue'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerNamespace' => 'application\admin\controllers',
    'components' => [
        'db' => $db,
        'assetManager' => [
            'linkAssets' => false,
            'forceCopy' => true,
        ],
        'request' => [
            'class' => \yii\web\Request::class,
            'cookieValidationKey' => 'tnb245vDdVgZwHZ1f-geEj8yF4nQ4gR5',
        ],
        'cache' => [
            'class' => \yii\redis\Cache::class,
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'ast-redis',
            'port' => 6379,
            'database' => 0,
            'retries' => 1,
            'socketClientFlags' => STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'commandClass' => \application\common\components\queue\QueueCommand::class,
            'redis' => 'redis',
            'channel' => 'main',
        ],
        'retailCrmUrlManager' => [
            'class' => \application\common\components\urls\RetailCRM\RetailCrmUrlManager::class,
            'hostInfo' => 'https://testirovanie.retailcrm.ru/',
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
        'user' => [
            'identityClass' => \application\common\components\UserIdentity::class,
            'loginUrl' => ['user/login'],
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
        SiteUrl::$componentName  => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'baseUrl' => '/',
            'hostInfo' => sprintf('%s://%s:%s', 'http', 'localhost', '7000'),
            'rules' => $siteRoutes,
        ],
    ],
    'params' => $params,
    'container' => [
        'singletons' => $singletons,
        'definitions' => [],
    ],
];

if (getenv('YII_GII') === 1) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
