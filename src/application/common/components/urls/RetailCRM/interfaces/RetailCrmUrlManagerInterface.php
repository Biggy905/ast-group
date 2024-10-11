<?php

namespace application\common\components\urls\RetailCRM\interfaces;

interface RetailCrmUrlManagerInterface
{
    public const MANAGER_RETAIL_CRM = 'retailCrmUrlManager';

    public function createAbsoluteUrlTo(string $urlManagerName, $params, ?string $scheme = null);
}
