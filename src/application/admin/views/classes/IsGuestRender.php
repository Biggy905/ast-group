<?php

namespace application\admin\views\classes;

use yii\helpers\Url;
use yii\web\View;

final class IsGuestRender
{
    public static function toRenderBody(View $view, string $content, $isGuest): string
    {
        return match ($isGuest) {
            true => IsGuestRender::defineGuest($view),
            false => IsGuestRender::defineNotGuest($view, $content),
        };
    }

    private static function defineGuest(View $view): string
    {
        $url = Url::to(['user/login'], true);

        return $view->render('../classes/html/guest.php', ['url' => $url]);
    }

    private static function defineNotGuest(View $view, string $content): string
    {
        return $view->render('../classes/html/user.php', ['content' => $content]);
    }
}
