<?php

declare(strict_types=1);

namespace application\admin\assets;

use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;

final class MainAssets extends AssetBundle
{
    public $sourcePath = '@resoursesMain';

    public $css = [];

    public $js = [
        'js/main.js',
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];

    public $publishOptions = [
        'only' => [
            '*',
        ],
        'except' => [
            'html/',
        ]
    ];
}
