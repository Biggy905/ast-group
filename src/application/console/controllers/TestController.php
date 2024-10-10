<?php

namespace application\console\controllers;

use yii\console\Controller;

final class TestController extends Controller
{
    public function actionAddUser(): void
    {
        echo \Yii::$app->security->generatePasswordHash('123456789');
    }
}
