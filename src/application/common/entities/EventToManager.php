<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\EventToManagerQuery;


/**
 * @property integer $id
 * @property string $event_id
 * @property string $manager_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
final class EventToManager extends AbstractModel
{
    public static string $tableName = '{{%event_to_manager}}';
    public static string $nameClassQuery = EventToManagerQuery::class;

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'event_id' => 'Связь с мероприятией',
            'manager_id' => 'Связь с организаторами',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'deleted_at' => 'Дата удаления',
        ];
    }
}
