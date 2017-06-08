<?php
namespace ykey\orm\query;

/**
 * Class Builder
 *
 * @package ykey\orm\query
 */
class Builder
{
    /**
     * @param string $tableName
     *
     * @return Insert
     */
    public static function insert(string $tableName): Insert
    {
        return new Insert($tableName);
    }
}
