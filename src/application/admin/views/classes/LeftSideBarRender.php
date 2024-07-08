<?php

namespace application\admin\views\classes;

use yii\web\View;

final class LeftSideBarRender
{
    public static function toRender(View $view): string
    {
        return $view->render('leftsidebar.php');
    }
}