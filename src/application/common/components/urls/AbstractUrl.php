<?php

namespace application\common\components\urls;

use yii\helpers\BaseUrl;

abstract class AbstractUrl extends BaseUrl
{
    protected string $cleanUrl;

    public function getUrl(): string
    {
        $string = '';

        if (!empty($this->cleanUrl)) {
            $string = $this->cleanUrl;
        }

        return $string;
    }

    public static function base($scheme = false): string
    {
        $url = self::getUrlManager()->getBaseUrl();
        if ($scheme !== false) {
            $url = self::getUrlManager()->getHostInfo() . $url;
            $url = self::ensureScheme($url, $scheme);
        }

        return $url;
    }
}
