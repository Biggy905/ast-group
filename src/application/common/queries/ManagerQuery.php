<?php

declare(strict_types=1);

namespace application\common\queries;

use application\common\components\AbstractQuery;
use application\common\entities\Manager;
use yii\db\ActiveQuery;

final class ManagerQuery extends AbstractQuery
{
    public function byId(int $id): ActiveQuery
    {
        return $this->andWhere(
            [
                Manager::tableName() . '.id' => $id,
            ]
        );
    }
}
