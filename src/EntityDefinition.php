<?php
namespace ykey\orm;

/**
 * Class EntityDefinition
 *
 * @package ykey\orm
 */
class EntityDefinition
{
    /**
     * @var string
     */
    private $connectionName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var AttributeDefinition[]
     */
    private $attributes = [];

    /**
     * @param string $connectionName
     */
    public function setConnection(string $connectionName): void
    {
        $this->connectionName = $connectionName;
    }

    /**
     * @return string
     */
    public function getConnection(): string
    {
        return $this->connectionName;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return AttributeDefinition
     */
    public function addAttribute($name): AttributeDefinition
    {
        $attribute = new AttributeDefinition;
        $this->attributes[$name] = $attribute;

        return $attribute;
    }

    /**
     * @return string[]
     */
    public function getAttributeNames(): array
    {
        return array_keys($this->attributes);
    }

    /**
     * @return AttributeDefinition[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     *
     * @return null|AttributeDefinition
     */
    public function getAttribute(string $name): ?AttributeDefinition
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * @return AttributeDefinition[]
     */
    public function getPrimaryAttributes(): array
    {
        return array_filter($this->attributes, function (AttributeDefinition $attribute) {
            return $attribute->isPrimary();
        });
    }

    /**
     * @return AttributeDefinition[]
     */
    public function getUniqueAttributes(): array
    {
        return array_filter($this->attributes, function (AttributeDefinition $attribute) {
            return $attribute->isUnique();
        });
    }
}
