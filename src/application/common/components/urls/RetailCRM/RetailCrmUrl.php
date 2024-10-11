<?php

namespace application\common\components\urls\RetailCRM;

use application\common\components\urls\AbstractUrl;
use application\common\components\urls\interfaces\UrlInterface;
use application\common\components\urls\RetailCRM\enums\RetailCrmUrlEnum;
use Yii;

final class RetailCrmUrl extends AbstractUrl implements UrlInterface
{
    public function __construct(
        RetailCrmUrlEnum $retailCrmUrlEnum,
        ?array $params = [],
    ) {
        $this->cleanUrl = RetailCrmUrl::to($retailCrmUrlEnum->toUrl($params), true);
    }

    protected static function getUrlManager(): \yii\web\UrlManager
    {
        return Yii::$app->retailCrmUrlManager ?: Yii::$app->getUrlManager();
    }
}
