<?php

namespace application\admin\views\classes;

use yii\web\View;

final class BreadcrumbRender
{
    public static function toRender(View $view): string
    {
        $breadcrumbs = $view->params['breadcrumbs'] ?? [];

        return match (!empty($breadcrumbs)) {
            true => $view->render('breadcrumb.php', ['data' => $breadcrumbs]),
            false => '',
        };
    }
}
