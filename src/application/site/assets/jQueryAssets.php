<?php

declare(strict_types=1);

namespace application\site\assets;

use yii\web\AssetBundle;

final class jQueryAssets extends AssetBundle
{
    public $sourcePath = '@resoursesJquery';

    public $js = [
        'dist/jquery.min.js',
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
            'src/',
            'AUTHORS.txt',
            'bower.json',
            'LICENSE.txt',
            'package.json',
            'README.md',
        ]
    ];
}
