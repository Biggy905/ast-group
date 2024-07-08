<?php

namespace application\common\components;

use application\common\components\interfaces\AbstractModelInterface;
use yii\db\ActiveRecord;

abstract class AbstractModel extends ActiveRecord implements AbstractModelInterface
{
    public array $attributeLabels;
    protected array $_convertProperties;

    public function setConvertProperties(): array
    {
        return [];
    }

    public static function tableName(): string
    {
        return static::$tableName;
    }

    public static function find(): AbstractQuery
    {
        return (new static::$nameClassQuery(get_called_class()))
            ->andWhere(
                [
                    static::tableName() . '.deleted_at' => null,
                ]
            );
    }

    public function afterFind(): void
    {
        $this->attributeLabels =  $this->attributeLabels();
        $this->convertValue();
    }

    private function convertValue(): void
    {
        $properties = $this->setConvertProperties();
        foreach ($properties as $key => $property) {
            $class = $property['enum'];
            $value = $this->$key;
            $cloneAttributeName = $key . '_clone';
            $this->$cloneAttributeName = $value;
            $cleanValue = $class::toTranslate($value ?? 'Нет данных');
            $this->{$key} = $cleanValue;
        }
    }
}
