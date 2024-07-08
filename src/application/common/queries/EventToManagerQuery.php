<?php

declare(strict_types=1);

namespace application\common\queries;

use application\common\components\AbstractQuery;
use application\common\entities\EventToManager;
use yii\db\ActiveQuery;

final class EventToManagerQuery extends AbstractQuery
{
    public function byId(int $id): ActiveQuery
    {
        return $this->andWhere(
            [
                EventToManager::tableName() . '.id' => $id,
            ]
        );
    }
}
