<?php

declare(strict_types=1);

namespace application\admin\assets;

use yii\web\AssetBundle;

final class MomentAssets extends AssetBundle
{
    public $sourcePath = '@resoursesAdminLTE';

    public $js = [
        'plugins/moment/moment.min.js',
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
