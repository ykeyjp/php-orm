<?php
namespace ykey\orm\driver;

use ykey\orm\exception\ConnectionException;

/**
 * Interface ConnectionInterface
 *
 * @package ykey\orm\driver
 */
interface ConnectionInterface
{
    /**
     * @throws ConnectionException
     */
    public function open(): void;

    /**
     * @return bool
     */
    public function close(): bool;

    /**
     * @return bool
     */
    public function isOpened(): bool;

    /**
     * @param string $sql
     *
     * @return StatementInterface
     */
    public function query(string $sql): StatementInterface;

    /**
     * @param string $sql
     *
     * @return bool
     */
    public function execute(string $sql): bool;

    /**
     * @return bool
     */
    public function begin(): bool;

    /**
     * @return bool
     */
    public function commit(): bool;

    /**
     * @return bool
     */
    public function rollup(): bool;
}
