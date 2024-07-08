<?php

declare(strict_types=1);

namespace application\common\helpers\AdminUrl;

use application\common\components\AbstractUrl;
use Yii;

final class AdminUrl extends AbstractUrl
{
    public static string $componentName = 'adminUrlManager';

    protected static function getUrlManager(): \yii\web\UrlManager
    {
        $componentName = self::$componentName;

        return Yii::$app->$componentName ?: Yii::$app->getUrlManager();
    }
}
