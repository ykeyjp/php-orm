<?php
namespace ykey\orm\driver;

use ykey\orm\DriverInterface;
use ykey\orm\exception\DriverException;
use ykey\orm\ResultInterface;

class PDO implements DriverInterface
{
    /**
     * @var string
     */
    private $dsn;
    /**
     * @var null|string
     */
    private $username;
    /**
     * @var null|string
     */
    private $password;
    /**
     * @var array
     */
    private $options;
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * PDO constructor.
     *
     * @param string      $dsn
     * @param null|string $username
     * @param null|string $password
     * @param array       $options
     */
    public function __construct(
        string $dsn,
        ?string $username = null,
        ?string $password = null,
        array $options = []
    ) {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }

    /**
     * @throws DriverException
     */
    public function open(): void
    {
        if ($this->isOpened()) {
            return;
        }
        try {
            $this->connection = new \PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch (\PDOException $exception) {
            throw new DriverException('could not open connection.', 0, $exception);
        }
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        unset($this->connection);

        return true;
    }

    /**
     * @return bool
     */
    public function isOpened(): bool
    {
        return isset($this->connection) && $this->connection instanceof \PDO;
    }

    public function query(string $sql, array $placeholder = []): ResultInterface
    {
        throw new \LogicException;
    }

    public function execute(string $sql, array $placeholder = []): int
    {
        throw new \LogicException;
    }
}
