<?php

declare(strict_types=1);


use application\common\components\AbstractQuery;
use application\common\entities\User;
use yii\db\ActiveQuery;

final class UserQuery extends AbstractQuery
{
    public function byUsername(string $username): ActiveQuery
    {
        return $this->andWhere(
            [
                User::tableName() . '.username' => $username,
            ]
        );
    }
}
