<?php

use application\common\widgets\DateTimePickerWidget\assets\DateTimePickerAsset;

DateTimePickerAsset::register($this);

$date = !empty($value) ? "date: '$value'" : "";

$js = <<<JS
    $(function () {
       $('#$target').datetimepicker({
            viewMode: 'years',
            locale: 'ru',
            format: '$format',
            $date
        });
    });
    
JS;

$this->registerJs($js, \yii\web\View::POS_END);
?>

<div class="input-group date" id="<?= $target ?>" data-target-input="nearest">

    <?= \yii\bootstrap5\Html::textInput($name, $value, $options);?>

    <div class="input-group-append" data-target="#<?= $target ?>" data-toggle="datetimepicker">
        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
</div>
