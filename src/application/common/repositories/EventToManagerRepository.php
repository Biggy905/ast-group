<?php

declare(strict_types=1);

namespace application\common\repositories;

use application\common\components\repository\AbstractRepository;
use application\common\entities\EventToManager;
use application\common\repositories\interfaces\EventToManagerRepositoryInterface;
use DomainException;
use Exception;

final class EventToManagerRepository extends AbstractRepository implements EventToManagerRepositoryInterface
{
    public function findById(int $id): ?EventToManager
    {
        return EventToManager::find()
            ->byId($id)
            ->one();
    }

    public function existsById(int $id): bool
    {
        return EventToManager::find()
            ->byId($id)
            ->exists();
    }

    public function findAllSelectIdTitle(): array
    {

        return EventToManager::find()
            ->select('id, title')
            ->all();
    }

    public function findAll(int $page): array
    {
        return EventToManager::find()
            ->page($page, 16)
            ->all();
    }

    public function findAllCount(): int
    {
        return EventToManager::find()
            ->count();
    }

    /**
     * @throws Exception
     */
    public function create(EventToManager $eventToManager): bool
    {
        $result = $eventToManager->save();
        if (!$result) {
            throw new DomainException('Error save in DB from class: "' . $eventToManager::class . '"');
        }

        return $result;
    }
}