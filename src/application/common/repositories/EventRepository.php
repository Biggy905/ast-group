<?php

declare(strict_types=1);

namespace application\common\repositories;

use application\common\components\repository\AbstractRepository;
use application\common\entities\Event;
use application\common\repositories\interfaces\EventRepositoryInterface;
use DomainException;
use Exception;

final class EventRepository extends AbstractRepository implements EventRepositoryInterface
{
    public function findById(int $id): ?Event
    {
        return Event::find()
            ->byId($id)
            ->one();
    }

    public function findByIds(array $ids): array
    {
        return Event::find()
            ->byIds($ids)
            ->all();
    }

    public function existsById(int $id): bool
    {
        return Event::find()
            ->byId($id)
            ->exists();
    }

    public function findAllSelectIdTitle(): array
    {
        return Event::find()
            ->select('id, title')
            ->all();
    }

    public function findAll(int $page): array
    {
        return Event::find()
            ->page($page, 16)
            ->all();
    }

    public function findAllCount(): int
    {
        return Event::find()
            ->count();
    }

    /**
     * @throws Exception
     */
    public function create(Event $event): bool
    {
        $result = $event->save();
        if (!$result) {
            throw new DomainException('Error save in DB from class: "' . $event::class . '"');
        }

        return $result;
    }
}
