<?php

namespace application\admin\forms\manager;

use application\admin\services\EventService;
use application\common\components\AbstractForm;
use application\common\enums\FormTypeInputEnums;
use application\common\repositories\EventRepository;
use libphonenumber\PhoneNumberUtil;

final class UpdateManagerForm extends AbstractForm
{
    public const TYPE_METHOD = 'PATCH';

    public $id;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $events;

    public function setAttributesTypeInput(): void
    {
        $this->attributeTypeInput = [
            'id' => [
                'title' => 'ID',
                'enum' => FormTypeInputEnums::TYPE_HIDDEN,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-id',
                ],
                'value' => $this->id,
            ],
            'name' => [
                'title' => 'Имя',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-name',
                ],
                'value' => $this->name,
            ],
            'surname' => [
                'title' => 'Фамилия',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-surname',
                ],
                'value' => $this->surname,
            ],
            'email' => [
                'title' => 'Электронная почта',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-email',
                ],
                'value' => $this->email,
            ],
            'phone' => [
                'title' => 'Телефон',
                'enum' => FormTypeInputEnums::TYPE_TEXT,
                'options' => [
                    'class' => 'form-control',
                    'id' => 'field-phone',
                    'placeholder' => 'Пример ввода: 79001234567'
                ],
                'value' => $this->phone,
            ],
            'events' => [
                'title' => 'Мероприятия',
                'enum' => FormTypeInputEnums::TYPE_DROPDOWN_LIST_MULTIPLE,
                'options' => [
                    'options' => [
                        'class' => 'form-control',
                        'id' => 'field-events',
                        'multiple' => true,
                    ],
                    'selection' => EventService::toItems($this->events ?? []),
                    'items' => EventService::toList(),
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [
                [
                    'id',
                    'name',
                    'surname',
                    'email',
                    'phone',
                ],
                'required',
            ],
            [
                [
                    'name',
                    'surname',
                    'email',
                    'phone',
                ],
                'string',
            ],
            [
                [
                    'name',
                    'surname',
                    'email',
                    'phone',
                ],
                'trim',
            ],
            [
                'email',
                'email',
            ],
            [
                'phone',
                'validatePhone',
            ],
            [
                'events',
                'validateEvents',
            ]
        ];
    }

    public function validatePhone(): void
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        $parsePhone = $phoneNumberUtil->parse($this->phone, "RU");
        $isValid = $phoneNumberUtil->isValidNumber($parsePhone);
        if (!$isValid) {
            $this->addError('phone', 'Не валидный номер телефона');
        }

        if (!$this->hasErrors()) {
            $stringPhone = (string) $parsePhone->getCountryCode();
            $this->phone = $stringPhone . (string) $parsePhone->getNationalNumber();
        }
    }

    public function validateEvents(): void
    {
        $repository = new EventRepository();

        $events = $this->events;
        foreach ($events as $event) {
            $existsEvent = $repository->existsById($event);
            if (!$existsEvent) {
                $this->addError('events', 'Запись мероприятия не найдена');
            }
        }
    }
}
