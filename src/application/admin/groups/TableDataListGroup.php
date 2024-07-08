<?php

namespace application\admin\groups;

use application\common\components\interfaces\AbstractModelInterface;

final class TableDataListGroup
{
    public static function toArray(array $entities, array $attributesLabel = []): array
    {
        return match (empty($attributesLabel)) {
            true => TableDataListGroup::hasNotAttributesLabel($entities),
            false => TableDataListGroup::hasAttributesLabel($entities, $attributesLabel),
        };
    }

    private static function hasNotAttributesLabel(array $entities): array
    {
        $data = [];

        foreach ($entities as $entity) {
            $data[] = TableDataItemGroup::toArray($entity);
        }

        return $data;
    }

    private static function hasAttributesLabel(array $entities, array $attributesLabel): array
    {
        $data = [];

        foreach ($entities as $key => $entity) {
            $data[$key] = TableDataItemGroup::toArray($entity);

            foreach ($attributesLabel as $attribute => $label) {
                if (is_array($label) && !empty($label['relation'])) {
                    $relatedRecords = $entity->getRelatedRecords();
                    $relation = $label['relation'];
                    if (!empty($relatedRecords)) {
                        foreach ($relatedRecords as $related => $relatedRecord) {
                            if (method_exists($entity, 'get' . $related) && $related === $relation) {

                                if ($relatedRecord instanceof AbstractModelInterface) {
                                    $data[$key][$attribute] = [
                                        'relation_type' => 'one',
                                        'relation_data' => TableDataItemGroup::toArray($relatedRecord),
                                    ];
                                }

                                if (is_array($relatedRecord)) {
                                    $relateData = [];
                                    foreach ($relatedRecord as $relatedEntity) {
                                        $relateData[] = TableDataItemGroup::toArray($relatedEntity);
                                    }

                                    $data[$key][$attribute] = [
                                        'relation_type' => 'many',
                                        'relation_data' => $relateData,
                                    ];

                                    unset($relateData);
                                }

                                if (!empty($type)) {
                                    $data[$key][$attribute]['type'] = 'many';
                                }
                            }
                        }
                    }
                }
            }
        }

        return $data;
    }
}
