<?php

$db = require __DIR__ . '/../../common/config/db.php';

return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'application\console\controllers',
    'controllerMap' => [
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::class,
            'migrationNamespaces' => [
                'console/console/migrations',
            ],
            'migrationTable' => 'history_migration',
        ],
    ],
    'components' => [
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
        'log' => [
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'container' => [
        'singletons' => require __DIR__ . '/singletons.php',
        'definitions' => [],
    ],
    'params' => [],
];
