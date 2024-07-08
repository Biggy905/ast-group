<?php

namespace application\admin\views\classes;

use yii\web\View;

final class NavRender
{
    public static function toRender(View $view): string
    {
        return $view->render('nav.php');
    }
}