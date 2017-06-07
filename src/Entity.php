<?php
namespace ykey\orm;

/**
 * Class Entity
 *
 * @package ykey\orm
 */
abstract class Entity implements EntityInterface
{
    public static function findOne()
    {
    }

    public static function findMany()
    {
    }

    public static function count()
    {
    }

    public function isDirty(): bool
    {
        return false;
    }

    public function save(): bool
    {
        return true;
    }

    public function remove(): bool
    {
        return true;
    }

    public function __destruct()
    {
    }
}
