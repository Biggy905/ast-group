<?php

namespace application\admin\services;

use application\admin\forms\manager\CreateManagerForm;
use application\admin\forms\manager\DeleteManagerForm;
use application\admin\forms\manager\UpdateManagerForm;
use application\admin\forms\IdForm;
use application\admin\groups\TableDataItemGroup;
use application\admin\groups\TableDataListGroup;
use application\admin\groups\TableListGroup;
use application\admin\services\interfaces\AbstractServiceInterface;
use application\common\components\AbstractForm;
use application\common\entities\EventToManager;
use application\common\entities\Manager;
use application\common\enums\DateTimeFormatEnums;
use application\common\enums\ManagerStatusSendEnum;
use application\common\helpers\DateTimeHelper;
use application\common\repositories\EventToManagerRepository;
use application\common\repositories\ManagerRepository;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Exception;

final class ManagerService implements AbstractServiceInterface
{
    public function __construct(
        private readonly ManagerRepository $managerRepository,
        private readonly EventToManagerRepository $eventToManagerRepository,
    ) {

    }

    public function item(IdForm $form): array
    {
        $manager = $this->managerRepository->findById($form->id);

        return [
            'title' => 'Просмотр бренда:',
            'breadcrumbs' => [
                [
                    'url' => Url::to(['index/index'], true),
                    'title' => 'Домашняя страница',
                ],
                [
                    'url' => Url::to(['car-brand/item', 'id' => $form->id], true),
                    'title' => 'Просмотр бренда',
                ],
            ],
            'data' => TableDataItemGroup::toArray($manager),
            'list_form' => [
                'update_form' => new UpdateManagerForm(),
            ],
            'route' => [
                'update_url' => ['car-brand/update', 'id' => $manager->id],
            ],
        ];
    }

    public function list(int $page): array
    {
        $managers = $this->managerRepository->findAll($page);
        $dataUrlUpdate = [];
        $dataUrlDelete = [];
        foreach ($managers as $manager) {
            $dataUrlUpdate[$manager->id] = ['manager/update', 'id' => $manager->id];
            $dataUrlDelete[$manager->id] = ['manager/delete', 'id' => $manager->id];
        }

        return [
            'title' => 'Управление мероприятиями',
            'breadcrumbs' => [
                [
                    'url' => Url::to(['index/index'], true),
                    'title' => 'Домашняя страница',
                ],
                [
                    'url' => Url::to(['manager/list', 'page' => 1], true),
                    'title' => 'Управление организаторами',
                ],
            ],
            'tableList' => TableListGroup::toArray($managers),
            'list_form' => [
                'create_form' => new CreateManagerForm(),
                'update_form' => new UpdateManagerForm(),
                'delete_form' => new DeleteManagerForm(),
            ],
            'route' => [
                'create_urls' => ['manager/create'],
                'update_urls' => $dataUrlUpdate,
                'delete_urls' => $dataUrlDelete,
            ],
            'pagination' => new Pagination(
                [
                    'totalCount' => $this->managerRepository->findAllCount(),
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
            $manager = new Manager();
            $manager->name = $form->name;
            $manager->surname = $form->surname;
            $manager->email = $form->email;
            $manager->phone = $form->phone;
            $manager->status_send_to_external = ManagerStatusSendEnum::STATUS_NOT_PROCESSED->value;
            $manager->created_at = DateTimeHelper::getDateTime()
                ->format(
                    DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                );

            $result = $this->managerRepository->create($manager);

            if (!empty($form->events) && is_array($form->events)) {

                foreach ($form->events as $event) {

                    $existManager = $this->eventToManagerRepository->existsByEventId($manager->id, $event);
                    if (!$existManager) {
                        $eventToManager = new EventToManager();
                        $eventToManager->event_id = $event;
                        $eventToManager->manager_id = $manager->id;
                        $eventToManager->created_at = DateTimeHelper::getDateTime()
                            ->format(
                                DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                            );

                        $this->eventToManagerRepository->create($eventToManager);
                    }
                }
            }

            $data = match ($result) {
                true => ['status' => 'success', 'url' => Url::to(['manager/list', 'page' => 1], true)],
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
    public function update(AbstractForm $form): array
    {
        try {
            $manager = $this->managerRepository->findById($form->id);
            if ($manager) {
                $manager->name = $form->name;
                $manager->surname = $form->surname;
                $manager->email = $form->email;
                $manager->phone = $form->phone;
                $manager->updated_at = DateTimeHelper::getDateTime()
                    ->format(
                        DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                    );

                $result = $this->managerRepository->create($manager);

                if (!empty($form->events) && is_array($form->events)) {
                    foreach ($form->events as $event) {
                        $existManager = $this->eventToManagerRepository->existsByEventId($manager->id, $event);
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
                true => ['status' => 'success', 'url' => Url::to(['manager/list', 'page' => 1], true)],
                false => ['status' => 'error', 'save' => 'Не удалось сохранить!'],
            };
        } catch (Exception $e) {
            $data =  ['status' => 'error', 'save' => 'Не удалось сохранить! ' . $e->getMessage()];
        }

        return $data;
    }

    public function delete(IdForm $form): array
    {
        $manager = $this->managerRepository->findById($form->id);
        if ($manager) {
            $manager->deleted_at = DateTimeHelper::getDateTime()
                ->format(
                    DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                );

            $eventToManagers = $this->eventToManagerRepository->findByManagerId($manager->id);
            foreach ($eventToManagers as $eventToManager) {
                $eventToManager->deleted_at = DateTimeHelper::getDateTime()
                    ->format(
                        DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value
                    );

                $this->eventToManagerRepository->create($eventToManager);
            }
        }

        return match ($this->managerRepository->create($manager)) {
            true => ['status' => 'success', 'url' => Url::to(['event/list', 'page' => 1], true)],
            false => ['status' => 'error', 'update' => 'Не удалось удалить!'],
        };
    }

    public static function toItem(?int $id = null): array
    {
        $data = [];
        if ($id) {
            $repository = new ManagerRepository();
            $manager = $repository->findById($id);

            $data = ArrayHelper::map(
                [TableDataItemGroup::toArray($manager)],
                'id',
                'phone'
            );
        }

        return $data;
    }

    public static function toItems(array $array = []): array
    {
        $data = [];
        if (!empty($array)) {
            if (!empty($array['relation_data'])) {
                $data = ArrayHelper::getColumn(
                    $array['relation_data'],
                    'id'
                );
            }
        }

        return $data;
    }

    public static function toList(): array
    {
        $repository = new ManagerRepository();
        $managers = $repository->findAllSelectIdPhone();

        return ArrayHelper::map(
            TableDataListGroup::toArray($managers),
            'id',
            'phone'
        );
    }

    public static function to(): array
    {
        $repository = new ManagerRepository();
        $managers = $repository->findAllSelectIdPhone();

        return ArrayHelper::getColumn(
            TableDataListGroup::toArray($managers),
            'id',
        );
    }
}
