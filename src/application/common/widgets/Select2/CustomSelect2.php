<?php

namespace application\common\widgets\Select2;

use application\common\widgets\Select2\assets\CustomSelect2Assets;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;
use kartik\select2\ThemeAsset;
use yii\helpers\Inflector;

final class CustomSelect2 extends Select2
{
    public function registerAssetBundle(): void
    {
        $view = $this->getView();
        CustomSelect2Assets::register($view);
        if (in_array($this->theme, self::$_inbuiltThemes)) {
            /**
             * @var ThemeAsset $bundleClass
             */
            $bundleClass = __NAMESPACE__.'\Theme'.Inflector::id2camel($this->theme).'Asset';
            $bundleClass::register($view);
        }
    }
}
