<?php

declare(strict_types=1);

namespace application\common\repositories\interfaces;

use application\common\entities\Manager;

interface ManagerRepositoryInterface
{
    public function findById(int $id): ?Manager;

    public function existsById(int $id): bool;

    public function findAllSelectIdPhone(): array;

    public function findAll(int $page): array;

    public function findAllCount(): int;

    public function create(Manager $manager): bool;
}
