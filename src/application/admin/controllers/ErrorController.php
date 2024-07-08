<?php

declare(strict_types=1);

namespace application\admin\controllers;

use application\common\components\AbstractController;
use Yii;
use yii\helpers\Url;

final class ErrorController extends AbstractController
{
    public function actionIndex(): string
    {
        $exception = Yii::$app->getErrorHandler()->exception;

        $statusCode = $exception->statusCode ?? 500;

        $title = 'Ошибка: ' . $statusCode . ', ' . $exception->getMessage();
        $this->view->title = $title;
        $this->view->params['breadcrumbs'] = [
            [
                'url' => Url::to(['index/index'], true),
                'title' => 'Домашняя страница',
            ],
            [
                'url' => Url::to(['error/index'], true),
                'title' => $title,
            ],
        ];

        if ($statusCode >= 500 && $statusCode <= 599) {
            $response = $this->render(
                'server_error',
                [
                    'data' => [
                        'codeStatus' => $statusCode,
                        'message' => $exception->getMessage(),
                        'line' => $exception->getLine(),
                        'stacktrace' => $exception->getTrace(),
                    ],
                ],
            );
        } else {
            $response = $this->render(
                'client_error',
                [
                    'data' => [
                        'codeStatus' => $statusCode,
                        'message' => $exception->getMessage(),
                    ],
                ],
            );
        }

        return $response;
    }
}
