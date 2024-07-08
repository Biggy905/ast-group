<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\EventQuery;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
final class Event extends AbstractModel
{
    public static string $tableName = '{{%event}}';
    public static string $nameClassQuery = EventQuery::class;

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'date' => 'Дата мероприятия',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'deleted_at' => 'Дата удаления',
        ];
    }
}
