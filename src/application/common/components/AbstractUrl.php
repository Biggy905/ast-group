<?php

namespace application\common\components;

use yii\base\InvalidConfigException;
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

    /**
     * @throws InvalidConfigException
     */
    public static function base($scheme = false): string
    {
        $url = static::getUrlManager()->getBaseUrl();
        if ($scheme !== false) {
            $url = static::getUrlManager()->getHostInfo() . $url;
            $url = static::ensureScheme($url, $scheme);
        }

        return $url;
    }
}
