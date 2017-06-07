<?php
namespace ykey\orm;

use ykey\annotation\adapter\Memory;

/**
 * Class EntityManager
 *
 * @package ykey\orm
 */
class EntityManager
{
    /**
     * @var EntityManager
     */
    private static $instance;
    /**
     * @var Memory
     */
    private $annotationAdapter;
    /**
     * @var EntityDefinition[]
     */
    private $caches = [];

    /**
     * EntityManager constructor.
     */
    private function __construct()
    {
        $this->annotationAdapter = new Memory;
    }

    /**
     * @return EntityManager
     */
    public static function instance(): self
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param string $entitiyClassName
     *
     * @return EntityDefinition
     */
    public function getEntityDefinition(string $entitiyClassName): EntityDefinition
    {
        if (isset($this->caches[$entitiyClassName])) {
            return $this->caches[$entitiyClassName];
        }
        $entity = new EntityDefinition;
        $reflection = $this->annotationAdapter->get($entitiyClassName);
        $info = new EntityAnnotation($reflection);
        $entity->setConnection($info->getConnection());
        $entity->setName($info->getName(substr(strrchr($entitiyClassName, '\\'), 1)));
        foreach ($info->getAttributeNames() as $name) {
            $attr = $entity->addAttribute($name);
            $attr->setName($info->getAttributeName($name));
            $attr->setType($info->getAttributeType($name));
            $attr->setLength($info->getAttributeLength($name));
            $attr->setNullable($info->isAttributeNullable($name));
            $attr->setPrimary($info->isAttributePrimary($name));
            $attr->setUnique($info->isAttributeUnique($name));
        }
        $this->caches[$entitiyClassName] = $entity;

        return $entity;
    }
}
