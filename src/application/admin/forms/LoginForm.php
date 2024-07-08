<?php

namespace application\admin\forms;

use application\admin\forms\interfaces\AdminFormInterface;
use application\common\components\AbstractForm;
use application\common\repositories\UserRepository;

final class LoginForm extends AbstractForm implements AdminFormInterface
{
    public $login;
    public $password;
    public $rememberMe = 86400;

    public function rules(): array
    {
        return [
            [
                [
                    'login',
                    'password',
                ],
                'required'
            ],
            [
                [
                    'login',
                    'password',
                ],
                'string'
            ],
            [
                [
                    'login',
                    'password',
                ],
                'trim'
            ],
            [
                [
                    'login',
                    'password',
                ],
                'validateUser'
            ],
            [
                'rememberMe',
                'integer',
            ],
            [
                'rememberMe',
                'in',
                'range' => [
                    86400,
                    1209600,
                ],
            ],
        ];
    }

    public function validateUser(): void
    {
        $userRepository = new UserRepository();
        $validate = true;
        if (!$userRepository->existsByUsername($this->login)) {
            $validate = false;
            $this->addError('login', 'Пользователь не найден');
        }

        if ($validate && !empty($this->password)) {
            if (!$userRepository->existsByUsernameAndPassword($this->login, $this->password ?? 'not_password_examples_not_password_12345_not_password')) {
                $this->addError('login', 'Неверный логин / пароль');
            }
        }
    }
}
