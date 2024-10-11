<?php

namespace application\common\components\HttpClient\enums;

enum MethodHttpEnum
{
    case METHOD_GET;
    case METHOD_POST;
    case METHOD_PATCH;
    case METHOD_PUT;
    case METHOD_DELETE;
    case METHOD_OPTIONS;

    public function takeMethod(): string
    {
        return match ($this) {
            self::METHOD_GET => 'GET',
            self::METHOD_POST => 'POST',
            self::METHOD_PATCH => 'PATCH',
            self::METHOD_PUT => 'PUT',
            self::METHOD_DELETE => 'DELETE',
            self::METHOD_OPTIONS => 'OPTIONS',
            default => 'GET',
        };
    }
}
