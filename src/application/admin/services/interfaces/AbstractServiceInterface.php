<?php

namespace application\admin\services\interfaces;

use application\admin\forms\IdForm;
use application\common\components\AbstractForm;

interface AbstractServiceInterface
{
    public function item(IdForm $form);

    public function list(int $page);

    public function create(AbstractForm $form);

    public function update(AbstractForm $form);

    public function delete(IdForm $form);
}
