<?php

declare(strict_types=1);

namespace application\common\repositories\interfaces;

use application\common\entities\EventToManager;

interface EventToManagerRepositoryInterface
{
    public function findById(int $id): ?EventToManager;

    public function existsById(int $id): bool;

    public function findAllSelectIdTitle(): array;

    public function findAll(int $page): array;

    public function findAllCount(): int;

    public function create(EventToManager $eventToManager): bool;
}
