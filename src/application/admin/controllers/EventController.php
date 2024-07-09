<?php

declare(strict_types=1);

namespace application\admin\controllers;

use application\admin\forms\event\CreateEventForm;
use application\admin\forms\event\DeleteEventForm;
use application\admin\forms\event\UpdateEventForm;
use application\admin\forms\IdForm;
use application\admin\forms\PageForm;
use application\admin\services\EventService;
use application\common\repositories\EventRepository;

final class EventController extends AbstractAdminController
{
    public function __construct(
        $id,
        $module,
        IdForm $idForm,
        PageForm $pageForm,
        protected EventService $service,
        $config = []
    ) {
        static::$_repository = new EventRepository();
        static::$_createForm = new CreateEventForm();
        static::$_updateForm = new UpdateEventForm();
        static::$_deleteForm = new DeleteEventForm();

        parent::__construct(
            $id,
            $module,
            $idForm,
            $pageForm,
            $config
        );
    }
}
