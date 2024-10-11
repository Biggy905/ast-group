<?php

namespace application\console\jobs;

use application\common\components\AbstractJob;
use application\common\components\ExchangeData\ExchangeDataHandler;
use application\common\components\ExchangeData\RetailCRM\RetailCrmExchangeData;
use application\common\components\HttpClient\HttpClient;
use application\common\components\urls\RetailCRM\enums\RetailCrmUrlEnum;
use application\common\components\urls\RetailCRM\RetailCrmUrl;
use application\common\repositories\ManagerRepository;
use Psr\Log\LoggerInterface;
use Exception;
use DomainException;
use Throwable;
use yii\helpers\ArrayHelper;

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
            foreach ($this->managers as $managerId) {
                $data[] = [
                    'id' => $managerId,
                    'externalId' => (string) $managerId
                ];
            }
            $payload = [
                'customers' => json_encode($data),
            ];

            $retail = new RetailCrmExchangeData(
                new RetailCrmUrl(
                    RetailCrmUrlEnum::URL_CREATE_CLIENT
                ),
                new HttpClient()
            );
            $handler = new ExchangeDataHandler(
                $retail->createClients($payload)
            );

            if ($handler->hasError()) {
                throw new DomainException('Не удалось создать записи на сервисе RetailCRM');
            }

            $managerRepository->updateAll($this->managers);

        } catch (Throwable $throwable) {
            $logger->error(
                $throwable->getMessage(),
                [
                    'category' => 'manager-status',
                ]
            );
        }
    }
}
