<?php

namespace application\admin\groups;

final class TableListGroup
{
    public static function toArray(array $data): array
    {
        $attributesLabel = !empty($data[0]) ? TableTitleItemGroup::toArray($data[0]) : [];

        return [
            'title' => $attributesLabel,
            'data' => TableDataListGroup::toArray($data, $attributesLabel),
        ];
    }
}
