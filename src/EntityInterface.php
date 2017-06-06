<?php
namespace ykey\orm;

interface EntityInterface
{
    public static function findOne();

    public static function findMany();

    public static function count();
}
