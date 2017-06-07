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
}
