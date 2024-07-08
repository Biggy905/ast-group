<?php

namespace application\common\components;

use yii\web\Controller;
use yii\web\Response;

abstract class AbstractController extends Controller
{
    public function response(array $data): array
    {
        $this->response->format = Response::FORMAT_JSON;

        return [
            'code' => 200,
            'data' => $data,
        ];
    }
}
