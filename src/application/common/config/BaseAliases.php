<?php

$rootDir = dirname(dirname(dirname(__DIR__)));
$applicationDir = dirname(dirname(__DIR__));

Yii::setAlias('app', $rootDir);
Yii::setAlias('root', $rootDir . '/../');
Yii::setAlias('vendor', $rootDir . '/vendor');

Yii::setAlias('common', $applicationDir . '/common');
Yii::setAlias('site', $applicationDir . '/site');
Yii::setAlias('admin', $applicationDir . '/admin');
Yii::setAlias('console', $applicationDir . '/console');
Yii::setAlias('ImagePublic', $applicationDir . '/site/public/uploads');
Yii::setAlias('resoursesWidget', $applicationDir . '/common/widgets');
