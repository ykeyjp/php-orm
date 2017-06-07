<?php
namespace ykey\orm;

/**
 * Interface EntityInterface
 *
 * @package ykey\orm
 */
interface EntityInterface
{
    public static function findOne();

    public static function findMany();

    public static function count();

    public function isDirty(): bool;

    public function save(): bool;

    public function remove(): bool;
}
