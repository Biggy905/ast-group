<?php

namespace application\admin\services;

use application\admin\forms\manager\CreateEventForm;
use application\admin\forms\manager\DeleteEventForm;
use application\admin\forms\manager\UpdateEventForm;
use application\admin\forms\IdForm;
use application\admin\groups\TableDataItemGroup;
use application\admin\groups\TableDataListGroup;
use application\admin\groups\TableListGroup;
use application\admin\services\interfaces\AbstractServiceInterface;
use application\common\components\AbstractForm;
use application\common\entities\Event;
use application\common\entities\EventToManager;
use application\common\enums\DateTimeFormatEnums;
use application\common\helpers\DateTimeHelper;
use application\common\repositories\EventRepository;
use application\common\repositories\EventToManagerRepository;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Exception;

final class EventService implements AbstractServiceInterface
{
    public function __construct(
        private readonly EventRepository $eventRepository,
        private readonly EventToManagerRepository $eventToManagerRepository,
    ) {

    }

    public function item(IdForm $form): array
    {
        $event = $this->eventRepository->findById($form->id);

        return [
            'title' => 'Просмотр мероприятия',
            'breadcrumbs' => [
                [
                    'url' => Url::to(['index/index'], true),
                    'title' => 'Домашняя страница',
                ],
                [
                    'url' => Url::to(['event/item', 'id' => $form->id], true),
                    'title' => 'Просмотр мероприятия',
                ],
            ],
            'data' => TableDataItemGroup::toArray($event),
            'list_form' => [
                'update_form' => new UpdateEventForm(),
            ],
            'route' => [
                'update_url' => ['event/update', 'id' => $event->id],
            ],
        ];
    }

    public function list(int $page): array
    {
        $events = $this->eventRepository->findAll($page);
        $dataUrlUpdate = [];
        $dataUrlDelete = [];
        foreach ($events as $event) {
            $dataUrlUpdate[$event->id] = ['event/update', 'id' => $event->id];
            $dataUrlDelete[$event->id] = ['event/delete', 'id' => $event->id];
        }

        return [
            'title' => 'Управление мероприятиями',
            'breadcrumbs' => [
                [
                    'url' => Url::to(['index/index'], true),
                    'title' => 'Домашняя страница',
                ],
                [
                    'url' => Url::to(['event/list', 'page' => 1], true),
                    'title' => 'Управление мероприятиями',
                ],
            ],
            'tableList' => TableListGroup::toArray($events),
            'list_form' => [
                'create_form' => new CreateEventForm(),
                'update_form' => new UpdateEventForm(),
                'delete_form' => new DeleteEventForm(),
            ],
            'route' => [
                'create_urls' => ['event/create'],
                'update_urls' => $dataUrlUpdate,
                'delete_urls' => $dataUrlDelete,
            ],
            'pagination' => new Pagination(
                [
                    'totalCount' => $this->eventRepository->findAllCount(),
                    'defaultPageSize' => 16,
                ]
            ),
        ];
    }

    /**
     * @throws Exception
     */
    public function create(AbstractForm $form): array
    {
        try {
            $event = new Event();
            $event->title = $form->title;
            $event->description = $form->description;
            $event->date = $form->date;
            $event->created_at = DateTimeHelper::getDateTime()
                ->format(
                    DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                );

            $result = $this->eventRepository->create($event);

            if (!empty($form->managers) && is_array($form->managers)) {
                foreach ($form->managers as $manager) {
                    $existManager = $this->eventToManagerRepository->existsByManagerId($manager['id']);
                    if (!$existManager) {
                        $eventToManager = new EventToManager();
                        $eventToManager->event_id = $event->id;
                        $eventToManager->manager_id = $manager['id'];
                        $eventToManager->created_at = DateTimeHelper::getDateTime()
                            ->format(
                                DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                            );

                        $this->eventToManagerRepository->create($eventToManager);
                    }
                }
            }

            $data = match ($result) {
                true => ['status' => 'success', 'url' => Url::to(['event/list', 'page' => 1], true)],
                false => ['status' => 'error', 'save' => 'Не удалось сохранить!'],
            };
        } catch (\Exception $e) {
            $data = match ($this->eventRepository->create($event)) {
                false => ['status' => 'error', 'save' => 'Не удалось сохранить! ' . $e->getMessage()],
            };
        }

        return $data;
    }

    /**
     * @throws Exception
     */
    public function update(AbstractForm $form): array
    {
        try {
            $event = $this->eventRepository->findById($form->id);
            if ($event) {
                $event->title = $form->title;
                $event->description = $form->description;
                $event->date = $form->date;
                $event->updated_at = DateTimeHelper::getDateTime()
                    ->format(
                        DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                    );

                $result = $this->eventRepository->create($event);

                if (!empty($form->managers) && is_array($form->managers)) {
                    foreach ($form->managers as $manager) {
                        $existManager = $this->eventToManagerRepository->existsByManagerId($manager['id']);
                        if (!$existManager) {
                            $eventToManager = new EventToManager();
                            $eventToManager->event_id = $event['id'];
                            $eventToManager->manager_id = $manager->id;
                            $eventToManager->created_at = DateTimeHelper::getDateTime()
                                ->format(
                                    DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                                );

                            $this->eventToManagerRepository->create($eventToManager);
                        }
                    }
                }
            }

            $data = match ($result) {
                true => ['status' => 'success', 'url' => Url::to(['event/list', 'page' => 1], true)],
                false => ['status' => 'error', 'save' => 'Не удалось сохранить!'],
            };
        } catch (Exception $e) {
            $data =  ['status' => 'error', 'save' => 'Не удалось сохранить! ' . $e->getMessage()];
        }

        return $data;
    }

    /**
     * @throws Exception
     */
    public function delete(IdForm $form): array
    {
        $event = $this->eventRepository->findById($form->id);
        if ($event) {
            $event->deleted_at = DateTimeHelper::getDateTime()
                ->format(
                    DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                );

            $eventToManagers = $this->eventToManagerRepository->findByEventId($event->id);
            foreach ($eventToManagers as $eventToManager) {
                $eventToManager->deleted_at = DateTimeHelper::getDateTime()
                    ->format(
                        DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                    );

                $this->eventToManagerRepository->create($eventToManager);
            }
        }

        return match ($this->eventRepository->create($event)) {
            true => ['status' => 'success', 'url' => Url::to(['event/list', 'page' => 1], true)],
            false => ['status' => 'error', 'update' => 'Не удалось удалить!'],
        };
    }

    public static function toItem(?int $id = null): array
    {
        $data = [];
        if ($id) {
            $repository = new EventRepository();
            $event = $repository->findById($id);

            $data = ArrayHelper::map(
                [TableDataItemGroup::toArray($event)],
                'id',
                'title'
            );
        }

        return $data;
    }

    public static function toList(): array
    {
        $repository = new EventRepository();
        $events = $repository->findAllSelectIdTitle();

        return ArrayHelper::map(
            TableDataListGroup::toArray($events),
            'id',
            'title'
        );
    }

    public static function to(): array
    {
        $repository = new EventRepository();
        $events = $repository->findAllSelectIdTitle();

        return ArrayHelper::getColumn(
            TableDataListGroup::toArray($events),
            'id',
        );
    }
}
