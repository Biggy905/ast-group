<?php

declare(strict_types=1);

namespace application\admin\assets;

use yii\web\AssetBundle;

final class ToastrAssets extends AssetBundle
{
    public $sourcePath = '@resoursesAdminLTE';

    public $css = [
        'plugins/toastr/toastr.min.css',
    ];

    public $js = [
        'plugins/toastr/toastr.min.js',
    ];

    public $depends = [
        AdminAsset::class,
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
