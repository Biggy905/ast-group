<?php

declare(strict_types=1);

namespace application\common\enums;

enum TimeZoneEnums: string
{
    case TIMEZONE_UTC = 'UTC';
    case TIMEZONE_MOSCOW = 'Europe/Moscow';
}
