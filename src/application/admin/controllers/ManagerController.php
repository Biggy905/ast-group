<?php

namespace application\admin\controllers;

use application\admin\forms\manager\CreateManagerForm;
use application\admin\forms\manager\DeleteManagerForm;
use application\admin\forms\manager\UpdateManagerForm;
use application\admin\forms\IdForm;
use application\admin\forms\PageForm;
use application\admin\services\ManagerService;
use application\common\repositories\ManagerRepository;

final class CarBrandController extends AbstractAdminController
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
}
