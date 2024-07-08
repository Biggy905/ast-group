<?php

namespace application\common\components;

use application\common\components\interfaces\AbstractFormInterface;
use yii\base\Model;
use yii\validators\Validator;
use DomainException;

abstract class AbstractForm extends Model implements AbstractFormInterface
{
    public const TYPE_METHOD = 'GET';
    public array $attributeTypeInput = [];
    protected string $formName = '';

    public function __construct(
        $config = []
    ) {
        parent::__construct($config);
        $this->setAttributesTypeInput();
    }

    public function reloadAttributesTypeInput(): void
    {
        $this->setAttributesTypeInput();
    }

    public function formName(): string
    {
        return $this->formName;
    }

    public function setAttributesTypeInput(): void
    {
        $this->attributeTypeInput = [];
    }

    public function getAttributeTypeInput(string $key)
    {
        if (empty($this->attributeTypeInput[$key])) {
            throw new DomainException('Error load attribute "$key" or see method setAttributesTypeInput().');
        }

        return $this->attributeTypeInput[$key];
    }

    public function addRule($attributes, $validator, $options = []): self
    {
        $validators = $this->getValidators();

        if ($validator instanceof Validator) {
            $validator->attributes = (array)$attributes;
        } else {
            $validator = Validator::createValidator($validator, $this, (array)$attributes, $options);
        }

        $validators->append($validator);
        $this->defineAttributesByValidator($validator);

        return $this;
    }

    public function runValidate(
        array $request,
              $attributes = null,
              $validator = null,
        ?array $options = null,
    ): bool {
        $this->load($request);

        if (
            !empty($attributes)
            && $validator instanceof Validator
            && isset($options)
        ) {
            $this->addRule($attributes, $validator, $options);
        }

        return $this->validate();
    }

    private function defineAttributesByValidator($validator): void
    {
        foreach ($validator->getAttributeNames() as $attribute) {
            if (!$this->hasAttribute($attribute)) {
                $this->defineAttribute($attribute);
            }
        }
    }
}
