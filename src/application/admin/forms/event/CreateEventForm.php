<?php

namespace application\admin\forms\event;

use application\admin\services\ManagerService;
use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;

final class CreateEventForm extends AbstractForm
{
    public const TYPE_METHOD = 'POST';

    public $title;
    public $description;
    public $date;
    public $managers;

    public function setAttributesTypeInput(): void
    {
        $this->attributeTypeInput = [
            'title' => [
                'title' => 'Заголовок',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-title',
                ],
            ],
            'description' => [
                'title' => 'Описание',
                'enum' => FormTypeInputEnums::TYPE_TEXTAREA,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-description',
                ],
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
                'managers',
                'validateManagers'
            ],
        ];
    }

    public function validateManagers(): void
    {

    }
}
