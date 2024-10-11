<?php

namespace application\console\controllers;

use application\console\services\ManagerService;
use yii\console\Controller;

final class ManagerController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ManagerService $managerService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionSend(): void
    {
        $this->managerService->startSend();
    }
}
