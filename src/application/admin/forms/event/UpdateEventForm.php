<?php

namespace application\admin\forms\event;

use application\admin\services\ManagerService;
use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;

final class UpdateEventForm extends AbstractForm
{
    public const TYPE_METHOD = 'PATCH';

    public $id;
    public $title;
    public $description;
    public $date;
    public $managers;

    public function setAttributesTypeInput(): void
    {
        $this->attributeTypeInput = [
            'id' => [
                'title' => 'ID',
                'enum' => FormTypeInputEnums::TYPE_HIDDEN,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-id',
                ],
                'value' => $this->id,
            ],
            'title' => [
                'title' => 'Заголовок',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-title',
                ],
                'value' => $this->title,
            ],
            'description' => [
                'title' => 'Описание',
                'enum' => FormTypeInputEnums::TYPE_TEXTAREA,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-description',
                ],
                'value' => $this->description,
            ],
            'date' => [
                'title' => 'Дата проведения',
                'enum' => FormTypeInputEnums::TYPE_DATETIME,
                'options' => [
                    'format' => 'YYYY m d',
                    'target' => 'field-date',
                    'options' => [
                        'id' => 'field-date',
                        'class' => 'form-control datetimepicker-input',
                        'data-target' => '#field-date',
                        'value' => null,
                    ],
                ],
                'value' => $this->date ?? 'Нет данных',
            ],
            'managers' => [
                'title' => 'Организаторы',
                'enum' => FormTypeInputEnums::TYPE_DROPDOWN_LIST,
                'options' => [
                    'options' => [
                        'class' => 'form-control',
                        'id' => 'field-discount_id',
                    ],
                    'selection' => null,
                    'items' => ManagerService::toList(),
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
                    'id',
                    'title',
                    'description',
                    'date',
                    'managers',
                ],
                'required',
            ],
            [
                [
                    'title',
                    'description',
                    'date',
                ],
                'string',
            ],
            [
                [
                    'title',
                    'description',
                    'date',
                ],
                'trim',
            ],
            [
                'id',
                'integer',
            ],
            [
                'managers',
                'validateManagers'
            ],
        ];
    }

    public function validateManagers(): void
    {

    }
}
