<?php

namespace application\admin\groups;

use application\common\components\interfaces\AbstractModelInterface;

final class TableDataItemGroup
{
    public static function toArray(AbstractModelInterface $entity): array
    {
        $data = [];
        foreach ($entity->attributeLabels as $attribute => $attributeLabel) {
            $data[$attribute] = $entity->$attribute;
        }

        return $data;
    }
}
