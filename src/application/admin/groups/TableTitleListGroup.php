<?php

namespace application\admin\groups;

final class TableTitleListGroup
{
    public static function toArray(array $list): array
    {
        $data = [];

        foreach ($list as $item) {
            $data[] = TableTitleItemGroup::toArray($item);
        }

        return $data;
    }
}
