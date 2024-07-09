<?php

namespace application\common\widgets\Select2\assets;

use application\admin\assets\BootstrapBundleAssets;
use application\admin\assets\jQueryAssets;
use kartik\select2\Select2Asset;
use yii\web\AssetBundle;

final class CustomSelect2Assets extends AssetBundle
{
    public $sourcePath = '@resoursesWidget/Select2/resourses/select2';

    public $css = [
        'css/select2.min.css',
    ];

    public $js = [
        'js/select2.full.js',
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
