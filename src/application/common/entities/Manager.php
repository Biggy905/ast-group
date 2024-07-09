<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\enums\CarCards\TypeMileageEnum;
use application\common\enums\CarCharacteristic\TypeFuelEnum;
use application\common\queries\EventQuery;
use application\common\queries\ManagerQuery;
use yii\db\ActiveQuery;

/**
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property array $events
 */
final class Manager extends AbstractModel
{
    public $events_clone;

    public static string $tableName = '{{%manager}}';
    public static string $nameClassQuery = ManagerQuery::class;

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Эл. почта',
            'phone' => 'Телефон',
            'events' => [
                'relation' => 'events',
                'title' => 'Мероприятия',
            ],
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'deleted_at' => 'Дата удаления',
        ];
    }

    public function setRelated(): array
    {
        return [
            'events',
        ];
    }

    public function getEventToManagers(): ActiveQuery
    {
        return $this->hasMany(
            EventToManager::class,
            [
                'manager_id' => 'id',
            ]
        );
    }

    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(
            Event::class,
            [
                'id' => 'event_id',
            ]
        )->via(
            'eventToManagers'
        );
    }
}
