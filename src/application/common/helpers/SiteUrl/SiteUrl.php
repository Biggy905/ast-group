<?php

declare(strict_types=1);

namespace application\common\helpers\SiteUrl;

use application\common\components\AbstractUrl;
use Yii;

final class SiteUrl extends AbstractUrl
{
    public static string $componentName = 'siteUrlManager';

    protected static function getUrlManager(): \yii\web\UrlManager
    {
        $componentName = self::$componentName;

        return Yii::$app->$componentName ?: Yii::$app->getUrlManager();
    }
}
