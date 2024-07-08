<?php

namespace application\admin\forms;

use application\admin\forms\interfaces\AdminFormInterface;
use application\common\components\AbstractForm;

final class ForgotPasswordForm extends AbstractForm implements AdminFormInterface
{
    public $email;

    public function rules(): array
    {
        return [];
    }
}
