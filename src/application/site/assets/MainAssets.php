<?php

declare(strict_types=1);

namespace application\site\assets;

use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;

final class MainAssets extends AssetBundle
{
    public $sourcePath = '@resoursesMain';

    public $css = [
        'css/main.css',
        'css/fonts.css',
        'css/fontawesome.min.css',
    ];

    public $js = [
        'js/main.js',
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];

    public $depends = [
        jQueryAssets::class,
        BootstrapAssets::class,
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
