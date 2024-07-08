<?php

namespace application\admin\views\classes;

use application\common\components\AbstractForm;
use application\common\components\interfaces\AbstractFormInterface;
use yii\web\View;

final class FormRender
{
    public static function toRenderForModal(
        View $view,
        AbstractFormInterface $data,
        string $url,
        string $idForm,
        string $idButton,
    ): string {
        return $view->render(
            'form_for_modal',
            [
                'form' => $data,
                'id' => $idForm,
                'button' => $idButton,
                'url' => $url,
            ]
        );
    }
}
