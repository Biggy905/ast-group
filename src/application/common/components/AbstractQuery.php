<?php

namespace application\common\components;

use application\common\components\interfaces\AbstractModelInterface;
use application\common\components\interfaces\AbstractQueryInterface;
use yii\db\ActiveQuery;

abstract class AbstractQuery extends ActiveQuery implements AbstractQueryInterface
{
    public function byDeletedNull(AbstractModelInterface $abstractModel): ActiveQuery
    {
        return $this->andWhere(
            [
                $abstractModel::tableName() . '.deleted_at' => null,
            ]
        );
    }

    public function page(int $page, int $limit): ActiveQuery
    {
        if ($page < 1){
            $page = 1;
        }

        return $this
            ->limit($limit)
            ->offset($page * $limit - $limit);
    }
}
