<?php

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\UserQuery;

final class User extends AbstractModel
{
    public static string $tableName = '{{%users}}';
    public static string $nameClassQuery = UserQuery::class;
}
