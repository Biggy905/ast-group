<?php

return [
    \Psr\Log\LoggerInterface::class => static function () {
        $processor = new \Monolog\Processor\WebProcessor();

        $logger = new \Monolog\Logger('common');
        $logger->pushProcessor($processor);

        return $logger;
    },

    \application\console\services\ManagerService::class => \application\console\services\ManagerService::class,

    \application\common\repositories\interfaces\ManagerRepositoryInterface::class =>
        \application\common\repositories\ManagerRepository::class,
];
