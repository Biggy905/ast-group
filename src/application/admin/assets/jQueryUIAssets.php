<?php

declare(strict_types=1);

namespace application\admin\assets;

use yii\web\AssetBundle;

final class jQueryUIAssets extends AssetBundle
{
    public $sourcePath = '@resoursesAdminLTE';

    public $css = [
        'plugins/jquery-ui/jquery-ui.css',
    ];

    public $js = [
        'plugins/jquery-ui/jquery-ui.js',
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
