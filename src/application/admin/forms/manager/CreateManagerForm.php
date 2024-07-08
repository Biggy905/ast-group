<?php

namespace application\admin\forms\manager;

use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;

final class CreateManagerForm extends AbstractForm
{
    public const TYPE_METHOD = 'POST';

    public $title;
    public $description;

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
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
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
        ];
    }
}
