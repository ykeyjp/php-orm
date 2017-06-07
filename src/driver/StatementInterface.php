<?php
namespace ykey\orm\driver;

/**
 * Interface ResultInterface
 *
 * @package ykey\orm\driver
 */
interface StatementInterface
{
    /**
     * @return bool
     */
    public function execute(): bool;

    /**
     * @return null|array
     */
    public function fetch(): ?array;

    /**
     * @return array
     */
    public function fetchAll(): array;

    public function close(): void;
}
