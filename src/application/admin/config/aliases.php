<?php

$rootDir = dirname(dirname(dirname(__DIR__)));
$applicationDir = dirname(dirname(__DIR__));

Yii::setAlias('web', $applicationDir . '/admin/public');
Yii::setAlias('webroot', $applicationDir . '/admin/public');

Yii::setAlias('resoursesMain', $applicationDir . '/admin/resourses/main');
Yii::setAlias('resoursesBootstrap', $applicationDir . '/admin/resourses/bootstrap');
Yii::setAlias('resoursesJquery', $applicationDir . '/admin/resourses/jquery');
Yii::setAlias('resoursesAdminLTE', $applicationDir . '/admin/resourses/admin_lte_v3');
