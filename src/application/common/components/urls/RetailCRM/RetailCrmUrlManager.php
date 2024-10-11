<?php

namespace application\common\components\urls\RetailCRM;

use application\common\components\urls\RetailCRM\interfaces\RetailCrmUrlManagerInterface;
use yii\web\UrlManager;
use InvalidArgumentException;
use Yii;

final class RetailCrmUrlManager extends UrlManager
{
    public $enablePrettyUrl = true;
    public $enableStrictParsing = true;
    public $showScriptName = false;
    public $baseUrl = '/';

    public static function getManagers(): array
    {
        return [
            RetailCrmUrlManagerInterface::MANAGER_RETAIL_CRM,
        ];
    }

    public function createAbsoluteUrl($params, $scheme = null): string
    {
        if (empty($scheme)) {
            $scheme = parse_url($this->hostInfo, PHP_URL_SCHEME);
        }

        return parent::createAbsoluteUrl($params, $scheme);
    }

    public function createAbsoluteUrlTo(string $urlManagerName, $params, ?string $scheme = null): string
    {
        if (!in_array($urlManagerName, RetailCrmUrlManager::getManagers())) {
            throw new InvalidArgumentException('Unknown url manager name "' . $urlManagerName . '" specified.');
        }

        /** @var \yii\web\UrlManager $urlManager */
        $urlManager = Yii::$app->$urlManagerName;

        return $urlManager->createAbsoluteUrl($params, $scheme);
    }
}
