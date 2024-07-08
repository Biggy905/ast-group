<?php

declare(strict_types=1);

namespace application\common\repositories;

use application\common\components\repository\AbstractRepository;
use application\common\components\UserIdentity;
use application\common\entities\User;
use application\common\repositories\interfaces\UserRepositoryInterface;
use DomainException;
use Yii;
use yii\web\NotFoundHttpException;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function findByUsername(string $username)
    {
        return User::find()
            ->byUsername($username)
            ->one();
    }

    public function findIdentityByUsername(string $username)
    {
        return UserIdentity::find()
            ->byUsername($username)
            ->one();
    }

    public function existsByUsername(string $username): bool
    {
        return User::find()
            ->byUsername($username)
            ->exists();
    }

    public function existsByUsernameAndPassword(string $username, string $password): bool
    {
        $data = false;
        $user = $this->findByUsername($username);
        if (!empty($user)) {
            $data = Yii::$app->security->validatePassword($password, $user->password);
        }

        return $data;
    }
}
