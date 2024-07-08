<?php

namespace application\common\widgets\DateTimePickerWidget;

use yii\bootstrap5\Html;
use yii\bootstrap5\Widget;

final class DateTimePickerWidget extends Widget
{
    public $name;
    public $format;
    public $target;
    public $value;
    public $options;

    public function run(): string
    {
        return $this->render(
            'datetime',
            [
                'name' => $this->name,
                'value' => $this->value ?? null,
                'format' => $this->format,
                'target' => $this->target,
                'options' => $this->options,
            ]
        );
    }
}
