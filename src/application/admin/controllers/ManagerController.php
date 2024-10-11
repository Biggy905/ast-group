<?php

namespace application\admin\controllers;

use application\admin\forms\manager\CreateManagerForm;
use application\admin\forms\manager\DeleteManagerForm;
use application\admin\forms\manager\UpdateManagerForm;
use application\admin\forms\IdForm;
use application\admin\forms\PageForm;
use application\admin\services\ManagerService;
use application\common\repositories\ManagerRepository;

final class ManagerController extends AbstractAdminController
{
    public function __construct(
        $id,
        $module,
        IdForm $idForm,
        PageForm $pageForm,
        protected ManagerService $service,
        $config = []
    ) {
        static::$_repository = new ManagerRepository();
        static::$_createForm = new CreateManagerForm();
        static::$_updateForm = new UpdateManagerForm();
        static::$_deleteForm = new DeleteManagerForm();

        parent::__construct(
            $id,
            $module,
            $idForm,
            $pageForm,
            $config
        );
    }

    public function actionRun(): array
    {
        $this->service->startSend();

        return $this->response(
            [
                'status' => 'queue',
                'data' => [
                    'Queue' => 'Запущен процесс!',
                ]
            ]
        );
    }

    public function beforeAction($action): bool
    {
        if (
            ($this->action->id == 'create')
            || ($this->action->id == 'update')
            || ($this->action->id == 'delete')
            || ($this->action->id == 'run')
        ) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
}
