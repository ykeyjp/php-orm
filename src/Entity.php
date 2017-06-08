<?php
namespace ykey\orm;

use ykey\orm\driver\ConnectionInterface;
use ykey\orm\query\Builder;

/**
 * Class Entity
 *
 * @package ykey\orm
 */
abstract class Entity implements EntityInterface
{
    /**
     * @var EntityDefinition
     */
    private static $definition;
    /**
     * @var bool
     */
    private $isNew = true;
    /**
     * @var array
     */
    private $dirtyState = [];

    public static function findOne()
    {
    }

    public static function findMany()
    {
    }

    public static function count()
    {
    }

    /**
     * @return EntityDefinition
     */
    private static function getDefinition()
    {
        if (is_null(self::$definition)) {
            self::$definition = EntityManager::instance()->getEntityDefinition(static::class);
        }

        return self::$definition;
    }

    /**
     * @return ConnectionInterface
     */
    private static function getConnection(): ConnectionInterface
    {
        return EntityManager::instance()->getConnection(self::getDefinition()->getConnection());
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->isNew;
    }

    /**
     * @return bool
     */
    public function isDirty(): bool
    {
        foreach (self::getDefinition()->getAttributeNames() as $propName) {
            if (($this->{$propName} ?? null) !== ($this->dirtyState[$propName] ?? null)) {
                return true;
            }
        }

        return false;
    }

    public function save(): bool
    {
        if (!$this->isDirty()) {
            return false;
        }
        if ($this->isNew) {
            $builder = Builder::insert(self::getDefinition()->getName());
            foreach ($this->toArray() as $name => $value) {
                $attr = self::getDefinition()->getAttribute($name);
                $builder->set($attr->getName(), $attr->getType(), $value);
            }
            $sql = $builder->toSQL();
            $success = self::getConnection()->execute($sql);

            return $success;
        } else {
        }

        return false;
    }

    public function remove(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $props = [];
        foreach (self::getDefinition()->getAttributeNames() as $propName) {
            $props[$propName] = $this->{$propName};
        }

        return $props;
    }

    public function __destruct()
    {
    }

    /**
     * @param array $attributes
     */
    private function restore(array $attributes = [])
    {
        $this->isNew = false;
        $props = self::getDefinition()->getAttributeNames();
        foreach ($attributes as $prop => $attribute) {
            if (in_array($prop, $props)) {
                $this->{$prop} = $attribute;
                $this->dirtyState[$prop] = $attribute;
            }
        }
    }
}
