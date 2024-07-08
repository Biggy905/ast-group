<?php

namespace application\common\enums;

use application\common\forms\systems\TypeInputCheckboxForm;
use application\common\forms\systems\TypeInputCheckboxListForm;
use application\common\forms\systems\TypeInputDateTimeForm;
use application\common\forms\systems\TypeInputDropdownListForm;
use application\common\forms\systems\TypeInputRadioForm;
use application\common\forms\systems\TypeInputRadioListForm;
use application\common\widgets\DateTimePickerWidget\DateTimePickerWidget;
use kartik\select2\Select2;
use yii\bootstrap5\Dropdown;
use yii\bootstrap5\Html;
use DomainException;

enum FormTypeInputEnums: string
{
    case TYPE_TEXT = 'text';
    case TYPE_PASSWORD = 'password';
    case TYPE_HIDDEN = 'hidden';
    case TYPE_FILE = 'file';
    case TYPE_IMAGE = 'image';
    case TYPE_RADIO = 'radio';
    case TYPE_RADIO_LIST = 'radio_list';
    case TYPE_CHECKBOX = 'checkbox';
    case TYPE_CHECKBOX_LIST = 'checkbox_list';
    case TYPE_SELECT = 'select';
    case TYPE_DROPDOWN_LIST = 'dropdown_list';
    case TYPE_TEXTAREA = 'textarea';
    case TYPE_DATETIME = 'datetime';

    public static function case(
        FormTypeInputEnums $enums,
        string $name,
        array $options,
        $value = null,
    ): string {
        if ($enums === self::TYPE_RADIO) {
            $formTypeRadio = new TypeInputRadioForm();
            if (!$formTypeRadio->runValidate($options)) {
                throw new DomainException('Error configuration from "options" for "radio"');
            }
        }

        if ($enums === self::TYPE_RADIO_LIST) {
            $formTypeRadioList = new TypeInputRadioListForm();
            if (!$formTypeRadioList->runValidate($options)) {
                throw new DomainException('Error configuration from "options" for "radio list"');
            }
        }

        if ($enums === self::TYPE_CHECKBOX) {
            $formTypeCheckbox = new TypeInputCheckboxForm();
            if (!$formTypeCheckbox->runValidate($options)) {
                throw new DomainException('Error configuration from "options" for "checkbox"');
            }
        }

        if ($enums === self::TYPE_CHECKBOX_LIST) {
            $formTypeCheckboxList = new TypeInputCheckboxListForm();
            if (!$formTypeCheckboxList->runValidate($options)) {
                throw new DomainException('Error configuration from "options" for "checkbox list"');
            }
        }

        if ($enums === self::TYPE_DROPDOWN_LIST) {
            $formTypeDropdownList = new TypeInputDropdownListForm();
            if (!$formTypeDropdownList->runValidate($options)) {
                throw new DomainException('Error configuration from "options" for "dropdown list"');
            }
        }

        if ($enums === self::TYPE_DATETIME) {
            $formDateTime = new TypeInputDateTimeForm();
            if (!$formDateTime) {
                throw new DomainException('Error configuration from "options" for "datetime"');
            }
        }

        return match ($enums) {
            self::TYPE_TEXT =>
                Html::textInput($name, $value, $options),
            self::TYPE_PASSWORD =>
                Html::passwordInput($name, $value, $options),
            self::TYPE_HIDDEN =>
                Html::hiddenInput($name, $value, $options),
            self::TYPE_FILE, self::TYPE_IMAGE =>
                Html::fileInput($name, $value, $options),
            self::TYPE_RADIO =>
                Html::radio($name, $options['checked'], $options['options']),
            self::TYPE_RADIO_LIST =>
                Html::radioList($name, $options['selection'], $options['items'], $options['options']),
            self::TYPE_CHECKBOX =>
                Html::checkbox($name, $options['checked'], $options['options']),
            self::TYPE_CHECKBOX_LIST =>
                Html::checkboxList($name, $options['selection'], $options['items'], $options['options']),
            self::TYPE_DROPDOWN_LIST =>
                Html::dropDownList($name, $options['selection'], $options['items'], $options['options']),
            self::TYPE_DATETIME => DateTimePickerWidget::widget(
                [
                    'name' => $name,
                    'value' => $value,
                    'target' => $options['target'],
                    'format' => $options['format'],
                    'options' => $options['options'],
                ]
            ),
            self::TYPE_SELECT => 'Not selected widget',
                //Html::renderSelectOptions($options['selection'], $options['items'], $options['options']),
            self::TYPE_TEXTAREA =>
                Html::textarea($name, $value, $options),
            default => '',
        };
    }
}
