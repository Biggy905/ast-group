<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\EventQuery;
use yii\db\ActiveQuery;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property array $managers
 */
final class Event extends AbstractModel
{
    public $managers_clone;

    public static string $tableName = '{{%event}}';
    public static string $nameClassQuery = EventQuery::class;

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'date' => 'Дата мероприятия',
            'managers' => [
                'relation' => 'managers',
                'title' => 'Организаторы',
            ],
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'deleted_at' => 'Дата удаления',
        ];
    }

    public function setRelated(): array
    {
        return [
            'managers',
        ];
    }

    public function getEventToManagers(): ActiveQuery
    {
        return $this->hasMany(
            EventToManager::class,
            [
                'event_id' => 'id',
            ]
        );
    }

    public function getManagers(): ActiveQuery
    {
        return $this->hasMany(
            Manager::class,
            [
                'id' => 'manager_id',
            ]
        )->via(
            'eventToManagers'
        );
    }
}
