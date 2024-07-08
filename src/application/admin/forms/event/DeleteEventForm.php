<?php

namespace application\admin\forms\event;

use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;

final class DeleteEventForm extends AbstractForm
{
    public const TYPE_METHOD = 'DELETE';

    public $id;

    public function setAttributesTypeInput(): void
    {
        $this->attributeTypeInput = [
            'id' => [
                'title' => 'ID',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-id',
                    'disabled' => true,
                ],
                'value' => $this->id,
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
                    'id',
                ],
                'required',
            ],
            [
                'id',
                'integer',
            ],
        ];
    }
}
