<?php

namespace application\common\components\ExchangeData\RetailCRM;

use application\common\components\ExchangeData\AbstractExchangeDataComponent;
use application\common\components\HttpClient\enums\MethodHttpEnum;
use application\common\components\HttpClient\HttpClient;
use application\common\components\urls\RetailCRM\RetailCrmUrl;

final class RetailCrmExchangeData extends AbstractExchangeDataComponent
{
    public function __construct(
        public readonly RetailCrmUrl $retailCrmUrl,
        public readonly HttpClient $httpClient,
    ) {

    }

    public function createClients(array $data): array
    {
        return $this->httpClient->exec(
            MethodHttpEnum::METHOD_POST,
            $this->retailCrmUrl,
            [
                'x-api-key' => 'TNkNYmltlpKCR1vMpOU5Th8BBa0k04Yy'
            ],
            $data,
        );
    }
}
