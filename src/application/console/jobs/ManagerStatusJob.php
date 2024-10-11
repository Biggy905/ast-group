<?php

namespace application\console\jobs;

use application\common\components\AbstractJob;
use application\common\repositories\ManagerRepository;
use Psr\Log\LoggerInterface;
use Exception;
use DomainException;
use Throwable;

final class ManagerStatusJob extends AbstractJob
{
    public function __construct(
        public array $managers,
    ) {

    }

    public function exec(
        ManagerRepository $managerRepository,
        LoggerInterface $logger
    ): void {
        try {
            $managerRepository->updateAll($this->managers);
        } catch (Throwable $throwable) {
            $logger->error(
                $throwable->getMessage(),
                [
                    'category' => 'manager-status',
                    ''
                ]
            );
        }
    }
}
