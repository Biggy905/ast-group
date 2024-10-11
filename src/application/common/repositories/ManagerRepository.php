<?php

declare(strict_types=1);

namespace application\common\repositories;

use application\common\components\repository\AbstractRepository;
use application\common\entities\EventToManager;
use application\common\entities\Manager;
use application\common\enums\DateTimeFormatEnums;
use application\common\enums\ManagerStatusSendEnum;
use application\common\helpers\DateTimeHelper;
use application\common\repositories\interfaces\EventToManagerRepositoryInterface;
use application\common\repositories\interfaces\ManagerRepositoryInterface;
use DomainException;
use Exception;
use yii\helpers\ArrayHelper;

final class ManagerRepository extends AbstractRepository implements ManagerRepositoryInterface
{
    public function findById(int $id): ?Manager
    {
        return Manager::find()
            ->byId($id)
            ->one();
    }

    public function findByIds(array $ids): array
    {
        return Manager::find()
            ->byIds($ids)
            ->all();
    }

    public function existsById(int $id): bool
    {
        return Manager::find()
            ->byId($id)
            ->exists();
    }

    public function findAllSelectIdPhone(): array
    {
        return Manager::find()
            ->select('id, phone')
            ->all();
    }

    public function findAll(int $page): array
    {
        return Manager::find()
            ->page($page, 16)
            ->joinWith('events')
            ->all();
    }

    public function findAllCount(): int
    {
        return Manager::find()
            ->count();
    }

    public function findAllByStatusNotProcessedAsArray(): array
    {
        return Manager::find()
            ->selectByIdAndStatus()
            ->byStatusNotProcessed()
            ->asArray()
            ->all();
    }

    /**
     * @throws Exception
     */
    public function create(Manager $manager): bool
    {
        $result = $manager->save();
        if (!$result) {
            throw new DomainException('Error save in DB from class: "' . $manager::class . '"');
        }

        return $result;
    }

    public function updateAll(array $managers): void
    {
        $ids = ArrayHelper::getColumn($managers, 'id');

        Manager::updateAll(
            [
                Manager::tableName() . '.status_send_to_external' => ManagerStatusSendEnum::STATUS_PROCESSED->value,
                Manager::tableName() . '.updated_at' => (
                    DateTimeHelper::getDateTime()
                        ->format(DateTimeFormatEnums::FORMAT_DATABASE_DATE->value)
                ),
            ],
            [
                Manager::tableName() . '.id' => $ids
            ],
        );
    }
}
