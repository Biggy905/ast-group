<?php

namespace application\console\services;

use application\common\components\QueueComponent;
use application\common\enums\QueueChannel;
use application\common\repositories\ManagerRepository;
use application\console\jobs\ManagerStatusJob;

final class ManagerService
{
    public function __construct(
        private ManagerRepository $managerRepository,
        private QueueComponent $queueComponent,
    ) {

    }

    public function startSend(): void
    {
        $managers = $this->managerRepository->findAllByStatusNotProcessedAsArray();

        $managerJob = new ManagerStatusJob($managers);

        $delay = getenv('RETAIL_CRM_QUEUE_DELAY');

        $this->queueComponent->push(
            $managerJob,
            QueueChannel::CHANNEL_MANAGER_STATUS,
            $delay
        );
    }
}
