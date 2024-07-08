<?php

namespace application\common\forms\systems;

use application\common\components\AbstractForm;

final class TypeInputDropdownListForm extends AbstractForm
{
    public $selection;
    public $items;
    public $options;

    public function rules(): array
    {
        return [
            [
                [
                    'items',
                ],
                'safe',
            ],
            [
                [
                    'options',
                ],
                'required',
            ],
            [
                [
                    'selection',
                ],
                'required',
                'when' => static function ($model) {
                    if (!empty($model->selection)) {
                        return true;
                    }

                    return false;
                }
            ],
        ];
    }
}
