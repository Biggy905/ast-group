<?php

namespace application\console\controllers;

use application\common\components\ExchangeData\ExchangeDataHandler;
use application\common\components\ExchangeData\RetailCRM\RetailCrmExchangeData;
use application\common\components\HttpClient\HttpClient;
use application\common\components\urls\RetailCRM\enums\RetailCrmUrlEnum;
use application\common\components\urls\RetailCRM\RetailCrmUrl;
use application\common\repositories\ManagerRepository;
use application\console\services\ManagerService;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use DomainException;

final class ManagerController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ManagerService $managerService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionSend(): void
    {
        $this->managerService->startSend();
    }

    public function actionTest()
    {
        $data = [];

        $repository = new ManagerRepository();
        $managers = $repository->findAllByStatusNotProcessedAsArray();
        $managerIds = ArrayHelper::getColumn($managers, 'id');

        foreach ($managerIds as $managerId) {
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

        $repository->updateAll($managerIds);
    }
}
