<?php

namespace application\common\components;

use application\common\queries\UserQuery;
use yii\web\IdentityInterface;

/**
 *
 * @property-read void $authKey
 * @property-read void $id
 */
final class UserIdentity extends AbstractModel implements IdentityInterface
{
    public static string $tableName = '{{%users}}';
    public static string $nameClassQuery = UserQuery::class;

    public static function findIdentity($id): static
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): string
    {
        return $this->token_access;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->token_access === $authKey;
    }
}
