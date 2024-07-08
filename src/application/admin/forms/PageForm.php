<?php

namespace application\admin\forms;

use application\common\components\AbstractForm;

final class PageForm extends AbstractForm
{
    public $page;

    public function rules(): array
    {
        return [
            [
                'page',
                'integer',
            ],
        ];
    }
}
