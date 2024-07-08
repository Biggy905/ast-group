<?php

namespace application\admin\views\classes;

use yii\data\Pagination;
use yii\web\View;

final class PaginationRender
{
    public static function toArray(View $view, Pagination $pagination): string
    {
        return $view->render('../classes/html/pagination', ['pagination' => $pagination]);
    }
}
