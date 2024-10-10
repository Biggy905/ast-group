<?php

return [
    \Psr\Log\LoggerInterface::class => static function () {
        $processor = new \Monolog\Processor\WebProcessor();

        $logger = new \Monolog\Logger('common');
        $logger->pushProcessor($processor);

        return $logger;
    }
];
