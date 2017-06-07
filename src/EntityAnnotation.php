<?php
namespace ykey\orm;

use ykey\annotation\Reflection;

/**
 * Class EntityAnnotation
 *
 * @package ykey\orm
 */
class EntityAnnotation
{
    /**
     * @var Reflection
     */
    private $reflection;
    /**
     * @var array
     */
    private $entity;
    /**
     * @var array
     */
    private $attributes;

    /**
     * EntityAnnotation constructor.
     *
     * @param Reflection $reflection
     */
    public function __construct(Reflection $reflection)
    {
        $this->reflection = $reflection;
        $this->entity = $this->getEntityInfo();
        $this->attributes = $this->getAttributeInfo();
    }

    /**
     * @return array
     */
    private function getEntityInfo(): array
    {
        $annotations = $this->reflection->getClassAnnotation();
        if (!$annotations->has('entity')) {
            return [];
        }
        $annotation = $annotations->get('entity');

        return $annotation->getArguments();
    }

    /**
     * @return array
     */
    private function getAttributeInfo(): array
    {
        $info = [];
        foreach ($this->reflection->getPropertyAnnotations() as $name => $annotations) {
            if (!$annotations->has('attribute')) {
                continue;
            }
            $info[$name] = $annotations->get('attribute')->getArguments();
        }

        return $info;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function getName(string $default = ''): string
    {
        return $this->entity['name'] ?? $default;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function getConnection(string $default = 'default'): string
    {
        return $this->entity['connection'] ?? $default;
    }

    /**
     * @return string[]
     */
    public function getAttributeNames(): array
    {
        return array_keys($this->attributes);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getAttributeName(string $name): ?string
    {
        if (!isset($this->attributes[$name])) {
            return $name;
        }

        return $this->attributes[$name]['name'] ?? $name;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getAttributeType(string $name): string
    {
        if (!isset($this->attributes[$name])) {
            return 'string';
        }

        return $this->attributes[$name]['type'] ?? 'string';
    }

    /**
     * @param string $name
     *
     * @return int
     */
    public function getAttributeLength(string $name): int
    {
        if (!isset($this->attributes[$name])) {
            return -1;
        }

        return $this->attributes[$name]['length'] ?? -1;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isAttributeNullable(string $name): bool
    {
        if (!isset($this->attributes[$name])) {
            return false;
        }

        return $this->attributes[$name]['nullable'] ?? false;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isAttributePrimary(string $name): bool
    {
        if (!isset($this->attributes[$name])) {
            return false;
        }

        return $this->attributes[$name]['primary'] ?? false;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isAttributeUnique(string $name): bool
    {
        if (!isset($this->attributes[$name])) {
            return false;
        }

        return $this->attributes[$name]['unique'] ?? false;
    }
}
