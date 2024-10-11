<?php

namespace application\common\components\urls\interfaces;

interface UrlEnumInterface
{
    public function toUrl(array $params): string;

    public function checkParams(object $object, array $params): ?array;
}
