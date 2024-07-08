<?php

declare(strict_types=1);

namespace application\common\queries;

use application\common\components\AbstractQuery;
use application\common\entities\Event;
use yii\db\ActiveQuery;

final class EventQuery extends AbstractQuery
{
    public function byId(int $id): ActiveQuery
    {
        return $this->andWhere(
            [
                Event::tableName() . '.id' => $id,
            ]
        );
    }
}
