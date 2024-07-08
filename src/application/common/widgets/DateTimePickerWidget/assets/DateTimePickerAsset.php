<?php

namespace application\common\widgets\DateTimePickerWidget\assets;

use application\admin\assets\AdminAsset;
use application\admin\assets\jQueryUIAssets;
use application\admin\assets\MomentAssets;
use yii\web\AssetBundle;

final class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@resoursesWidget/DateTimePickerWidget/resourses/datetimepicker';

    public $css = [
        'css/tempusdominus-bootstrap-4.min.css',
    ];

    public $js = [
        'js/tempusdominus-bootstrap-4.min.js',
    ];

    public $depends = [
        MomentAssets::class,
        AdminAsset::class,
    ];

    public $jsOptions = [
        'appendTimestamp' => true
    ];
    public $cssOptions = [
        'appendTimestamp' => true
    ];
}
