<?php

$rootDir = dirname(dirname(dirname(__DIR__)));
$applicationDir = dirname(dirname(__DIR__));

Yii::setAlias('web', $applicationDir . '/site/public');
Yii::setAlias('webroot', $applicationDir . '/site/public');

Yii::setAlias('resoursesMain', $applicationDir . '/site/resourses/main');
Yii::setAlias('resoursesBootstrap', $applicationDir . '/site/resourses/bootstrap');
Yii::setAlias('resoursesJquery', $applicationDir . '/site/resourses/jquery');
