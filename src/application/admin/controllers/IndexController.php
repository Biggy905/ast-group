<?php

declare(strict_types=1);

namespace application\admin\controllers;

use application\common\components\AbstractController;
use yii\web\NotFoundHttpException;

final class IndexController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
