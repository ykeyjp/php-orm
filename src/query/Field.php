<?php
namespace ykey\orm\query;

/**
 * Class Field
 *
 * @package ykey\orm\query
 */
class Field
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $type;
    /**
     * @var bool|int|float|float|string|\DateTime|null
     */
    private $value;

    /**
     * Field constructor.
     *
     * @param string $name
     * @param string $type
     * @param        $value
     */
    public function __construct(string $name, string $type, $value)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @param string $type
     *
     * @return Field
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param $value
     *
     * @return Field
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool|\DateTime|float|int|null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getExpressedName(): string
    {
        if (is_string($this->name)) {
            return $this->name;
        }

        return (string)$this->name;
    }

    /**
     * @return bool|int|float|string|null
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function getExpressedValue()
    {
        $value = $this->value;
        switch (strtolower($this->type)) {
            case 'string':
            case 'varchar':
                $this->setType('string');

                return strval($value);
                break;
            case 'integer':
            case 'int':
                $this->setType('int');
                if (is_string($value)) {
                    return intval($value, 0);
                }
                break;
            case 'float':
            case 'double':
                $this->setType('float');
                if (is_string($value)) {
                    return floatval($value);
                }
                break;
            case 'timestamp':
                if ($value instanceof \DateTime) {
                    return $value->format('c');
                }
                break;
            case 'datetime':
                if ($value instanceof \DateTime) {
                    return $value->format('c');
                }
                break;
            case 'bool':
            case 'boolean':
                $this->setType('bool');
                if (is_string($value)) {
                    return boolval($value);
                }
                break;
        }

        return $value;
    }
}
