<?php

namespace application\common\components\urls\RetailCRM\enums;

use application\common\components\urls\interfaces\UrlEnumInterface;

enum RetailCrmUrlEnum implements UrlEnumInterface
{
    // Авторизация
    case URL_AUTH;
    // Расчет стоимости доставки
    case URL_CALCULATION_DELIVERY;
    // Список населенных пунктов
    case URL_LIST_CITY;
    // Создание заказа
    case URL_ORDER;
    case URL_GET_DELIVERY;

    case URL_CREATE_CLIENT;

    public function toUrl(array $params): string
    {
        return match ($this) {
            self::URL_AUTH => 'v2/oauth/token?parameters',
            self::URL_CALCULATION_DELIVERY => 'v2/calculator/tarifflist',
            self::URL_LIST_CITY => 'v2/location/cities',
            self::URL_ORDER => 'v2/orders',
            self::URL_GET_DELIVERY => 'site/order/' . $this->checkParams(new Object(), $params)[0]->type,
            self::URL_CREATE_CLIENT => '/api/v5/customers/fix-external-ids',
        };
    }

    public function checkParams(object $object, array $params): ?array
    {
        $data = null;

        foreach ($params as $param) {
            if (
                $param instanceof Object
            ) {
                $data[] = $param;
            }
        }

        return $data;
    }
}
