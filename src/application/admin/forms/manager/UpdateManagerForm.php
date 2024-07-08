<?php

namespace application\admin\forms\manager;

use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;

final class UpdateManagerForm extends AbstractForm
{
    public const TYPE_METHOD = 'PATCH';

    public $id;
    public $title;
    public $description;

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
                ],
                'required',
            ],
            [
                [
                    'title',
                    'description',
                ],
                'string',
            ],
            [
                [
                    'title',
                    'description',
                ],
                'trim',
            ],
            [
                'id',
                'integer',
            ],
        ];
    }
}
