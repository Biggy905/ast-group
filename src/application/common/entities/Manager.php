<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\EventQuery;

/**
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
final class Manager extends AbstractModel
{
    public static string $tableName = '{{%manager}}';
    public static string $nameClassQuery = EventQuery::class;

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'deleted_at' => 'Дата удаления',
        ];
    }
}
