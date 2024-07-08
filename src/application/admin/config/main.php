<?php

use application\common\helpers\SiteUrl\SiteUrl;

$db = require '../../common/config/db.php';
$routes = require 'routes.php';
$siteRoutes = require '../../site/config/routes.php';
$containers = require 'containers.php';
$params = require 'params.php';

$config = [
    'id' => 'site',
    'name' => 'Сайт',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
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
        'singletons' => $containers,
        'definitions' => [],
    ],
];

return $config;
