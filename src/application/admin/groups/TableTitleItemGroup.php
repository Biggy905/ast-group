<?php

namespace application\admin\groups;

use application\common\components\interfaces\AbstractModelInterface;

final class TableTitleItemGroup
{
    public static function toArray(AbstractModelInterface $item): array
    {
        return $item->attributeLabels;
    }
}
