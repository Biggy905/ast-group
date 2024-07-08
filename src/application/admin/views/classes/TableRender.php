<?php

namespace application\admin\views\classes;

use yii\web\View;

final class TableRender
{
    public static function toArray(View $view, array $data): string
    {
        return $view->render(
            '../classes/html/table',
            [
                'tableTitles' => $data['data']['tableList']['title'],
                'tableData' => $data['data']['tableList']['data'],
                'create_form' => $data['data']['list_form']['create_form'],
                'update_form' => $data['data']['list_form']['update_form'],
                'delete_form' => $data['data']['list_form']['delete_form'],
                'create_url' => $data['data']['route']['create_urls'],
                'update_url' => $data['data']['route']['update_urls'],
                'delete_url' => $data['data']['route']['delete_urls'],
            ]
        );
    }
}
