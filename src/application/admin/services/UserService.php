<?php

namespace application\admin\services;

use application\admin\forms\LoginForm;
use application\common\repositories\UserRepository;
use yii\helpers\Url;
use Yii;

final class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {

    }

    public function login(LoginForm $form): array
    {
        $user = $this->userRepository->findIdentityByUsername($form->login);
        $login = Yii::$app->user->login($user, (int) $form->rememberMe);

        return match ($login) {
            true => ['status' => 'success', 'url' => Url::to(['index/index'], true)],
            false => ['status' => 'error', 'password' => 'Неверный логин / пароль'],
        };
    }
}
