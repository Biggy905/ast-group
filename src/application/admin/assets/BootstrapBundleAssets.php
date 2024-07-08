<?php

declare(strict_types=1);

namespace application\admin\assets;

use yii\web\AssetBundle;

final class BootstrapBundleAssets extends AssetBundle
{
    public $sourcePath = '@resoursesBootstrap';

    public $css = [];

    public $js = [
        'dist/js/bootstrap.bundle.js',
    ];

    public $depends = [
        jQueryAssets::class,
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
            '.github/',
            'build/',
            'nuget/',
            'site/',
            '.babelrc.js',
            '.browserslistrc',
            '.bundlewatch.config.json',
            '.cspell.json',
            '.editorconfig',
            '.eslintignore',
            '.eslintrc.json',
            '.gitattributes',
            '.gitignore',
            '.npmrc',
            '.stylelintignore',
            '.stylelintrc.json',
            '.CODE_OF_CONDUCT.md',
            '.composer.json',
            '.hugo.yml',
            'LICENSE',
            'package.js',
            'package.json',
            'package-lock.json',
            'README.md',
            'SECURITY.md',
        ]
    ];
}
