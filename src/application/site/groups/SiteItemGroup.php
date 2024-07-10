<?php

namespace application\site\groups;

use application\common\components\interfaces\AbstractModelInterface;

final class SiteItemGroup
{
    public static function toArray(AbstractModelInterface $model): array
    {
        $data = [];
        foreach ($model->attributeLabels as $attribute => $attributeLabel) {
            $data[$attribute] = $model->$attribute;
        }

        return $data;
    }
}
