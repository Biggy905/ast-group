<?php

namespace application\common\components;

use yii\base\UserException;
use yii\web\Response;
use Yii;
use LogicException;

final class ErrorHandler extends \yii\web\ErrorHandler
{
    protected function renderException($exception)
    {
        $response = new Response();
        $response->data = [
            'code' => 500,
            'message' => 'Unknown Error',
        ];

        if ($exception instanceof LogicException) {
            $code = $exception->getCode();

            $response->data = [
                'code' => $code ?: 400,
                'message' => $exception->getMessage(),
            ];
        } elseif ($exception instanceof \yii\web\HttpException) {
            $response->data = [
                'code' => $exception->statusCode,
                'message' => $exception->getMessage(),
            ];
        } elseif ($exception instanceof \Throwable) {
            $response->data = [
                'code' => $exception->statusCode ?? 500,
                'message' => $this->convertExceptionToArray($exception),
            ];
        }

        $useSoftErrors = Yii::$app->has('request')
            && Yii::$app->request->headers->get('X-Soft-Errors', 'true') === 'true';

        if ($useSoftErrors) {
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode($response->data['code']);
        }

        $response->format = Response::FORMAT_JSON;
        $response->send();
    }

    protected function convertExceptionToArray($exception): array
    {
        $name = 'Exception';
        if ($exception instanceof \yii\base\Exception || $exception instanceof \yii\base\ErrorException) {
            $name = $exception->getName();
        }

        $array = [
            'name' => $name,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ];

        $array['type'] = get_class($exception);
        if (!$exception instanceof UserException) {
            $array['file'] = $exception->getFile();
            $array['line'] = $exception->getLine();
            $array['stack-trace'] = explode("\n", $exception->getTraceAsString());
            if ($exception instanceof \yii\db\Exception) {
                $array['error-info'] = $exception->errorInfo;
            }
        }

        if (($prev = $exception->getPrevious()) !== null) {
            $array['previous'] = $this->convertExceptionToArray($prev);
        }

        return $array;
    }
}
