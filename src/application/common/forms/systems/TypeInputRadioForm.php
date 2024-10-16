<?php

namespace application\common\forms\systems;

use application\common\components\AbstractForm;

final class TypeInputRadioForm extends AbstractForm
{
    public $checked;
    public $options;

    public function rules(): array
    {
        return [
            [
                [
                    'checked',
                    'options',
                ],
                'required',
            ],
            [
                'checked',
                'boolean',
            ],
        ];
    }
}
