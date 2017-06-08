<?php
namespace ykey\orm\query;

/**
 * Class SQL
 *
 * @package ykey\orm\query
 */
class SQL
{
    /**
     * @var string
     */
    private $sql;
    /**
     * @var array
     */
    private $placeholders;

    /**
     * SQL constructor.
     *
     * @param string $sql
     * @param array  $placeholders
     */
    public function __construct(string $sql, array $placeholders = [])
    {
        $this->sql = $sql;
        $this->placeholders = $placeholders;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->sql;
    }

    /**
     * @return array
     */
    public function getPlaceholders(): array
    {
        return $this->placeholders;
    }
}
