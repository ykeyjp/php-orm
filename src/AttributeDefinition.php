<?php
namespace ykey\orm;

/**
 * Class AttributeDefinition
 *
 * @package ykey\orm
 */
class AttributeDefinition
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $type = 'string';
    /**
     * @var int
     */
    private $length;
    /**
     * @var bool
     */
    private $isNullable = false;
    /**
     * @var bool
     */
    private $isPrimary = false;
    /**
     * @var bool
     */
    private $isUnique = false;

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
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param bool $nullable
     */
    public function setNullable(bool $nullable): void
    {
        $this->isNullable = $nullable;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->isNullable;
    }

    /**
     * @param bool $primary
     */
    public function setPrimary(bool $primary): void
    {
        $this->isPrimary = $primary;
    }

    /**
     * @return bool
     */
    public function isPrimary(): bool
    {
        return $this->isPrimary;
    }

    /**
     * @param bool $unique
     */
    public function setUnique(bool $unique): void
    {
        $this->isUnique = $unique;
    }

    /**
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->isPrimary;
    }
}
