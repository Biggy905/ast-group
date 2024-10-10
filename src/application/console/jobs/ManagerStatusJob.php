<?php

namespace application\console\jobs;

use application\common\components\AbstractJob;
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
        LoggerInterface $logger
    ): void {
        try {
            foreach ($this->managers as $manager) {

            }
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
