<?php
namespace ykey\orm\driver\pdo;

use ykey\orm\driver\StatementInterface;

/**
 * Class Result
 *
 * @package ykey\orm\driver\pdo
 */
class Statement implements StatementInterface
{
    /**
     * @var \PDOStatement
     */
    private $stmt;

    /**
     * Result constructor.
     *
     * @param \PDOStatement $stmt
     */
    public function __construct(\PDOStatement $stmt)
    {
        $this->stmt = $stmt;
    }

    /**
     * @return null|array
     */
    public function fetch(): ?array
    {
        return $this->stmt->fetch();
    }

    /**
     * @return array
     */
    public function fetchAll(): array
    {
        return $this->stmt->fetchAll();
    }

    public function close(): void
    {
        $this->stmt->closeCursor();
    }

    public function __destruct()
    {
        $this->close();
    }
}
