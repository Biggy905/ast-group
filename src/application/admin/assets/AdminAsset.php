<?php

declare(strict_types=1);

namespace application\admin\assets;

use yii\web\AssetBundle;

final class AdminAsset extends AssetBundle
{
    public $sourcePath = '@resoursesAdminLTE';

    public $css = [
        'css/fonts.css',
        'css/fontawesome.min.css',
        'css/adminlte.min.css',
    ];

    public $js = [
        'js/adminlte.min.js',
    ];

    public $depends = [
        jQueryAssets::class,
        BootstrapBundleAssets::class,
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
