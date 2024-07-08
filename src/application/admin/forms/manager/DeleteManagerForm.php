<?php

namespace application\admin\forms\manager;

use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;

final class DeleteManagerForm extends AbstractForm
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
