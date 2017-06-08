<?php
namespace ykey\orm\driver;

use ykey\orm\exception\ConnectionException;
use ykey\orm\query\SQL;

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
     * @param SQL $sql
     *
     * @return StatementInterface
     */
    public function query(SQL $sql): StatementInterface;

    /**
     * @param SQL $sql
     *
     * @return bool
     */
    public function execute(SQL $sql): bool;

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
