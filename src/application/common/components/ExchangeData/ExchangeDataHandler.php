<?php

namespace application\common\components\ExchangeData;

final class ExchangeDataHandler
{
    public int $code;
    public mixed $message;

    public function __construct(
        array $response
    ) {
        $this->code = $response['code'] ?? 500;

        $message = 'Ошибка обработки ответа';
        if (!empty($response['body'])) {
            $message = json_decode(
                $response['body'],
                true,
                512,
                JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE
            );
        }

        $this->message = $message;
    }

    public function hasError(): bool
    {
        $data = false;
        if ($this->code !== 200) {
            $data = true;
        }

        return $data;
    }
}
