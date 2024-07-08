<?php

namespace application\admin\controllers;

use application\admin\forms\LoginForm;
use application\admin\services\UserService;
use application\common\components\AbstractController;
use Yii;
use yii\helpers\Url;

final class UserController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        private readonly UserService $userService,
        private readonly LoginForm $loginForm,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionViewLogin(): string
    {
        return $this->render('login', ['url' => Url::to(['user/login'], true)]);
    }

    public function actionLogin(): array
    {
        $postPayload = json_decode(Yii::$app->request->getRawBody(), true) ?? [];
        $form = $this->loginForm;

        $data = match ($form->runValidate($postPayload)) {
            true => $this->userService->login($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }

    public function actionForgotPassword(): string
    {
        return $this->render('forgot_password');
    }

    public function beforeAction($action): bool
    {
        if (
            ($this->action->id == 'login')
        ) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
}