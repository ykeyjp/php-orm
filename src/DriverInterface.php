<?php
namespace ykey\orm;

use ykey\orm\exception\DriverException;

interface DriverInterface
{
    /**
     * @throws DriverException
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
     * @param array  $placeholder
     *
     * @return ResultInterface
     */
    public function query(string $sql, array $placeholder = []): ResultInterface;

    /**
     * @param string $sql
     * @param array  $placeholder
     *
     * @return int
     */
    public function execute(string $sql, array $placeholder = []): int;
}
