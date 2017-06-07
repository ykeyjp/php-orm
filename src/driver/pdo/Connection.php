<?php
namespace ykey\orm\driver\pdo;

use ykey\orm\driver\ConnectionInterface;
use ykey\orm\driver\exception\ConnectionException;
use ykey\orm\driver\StatementInterface;

/**
 * Class Connection
 *
 * @package ykey\orm\driver\pdo
 */
class Connection implements ConnectionInterface
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
     * @throws ConnectionException
     */
    public function open(): void
    {
        if ($this->isOpened()) {
            return;
        }
        try {
            $connection = new \PDO($this->dsn, $this->username, $this->password, $this->options);
            $driver = $connection->getAttribute(\PDO::ATTR_DRIVER_NAME);
            if ($driver === 'mysql') {
                $connection->setAttribute(\PDO::ATTR_AUTOCOMMIT, false);
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $connection->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $connection->setAttribute(\PDO::ATTR_STRINGIFY_FETCHES, false);
            $this->connection = $connection;
        } catch (\PDOException $exception) {
            throw new ConnectionException('could not open connection.', 0, $exception);
        }
    }

    /**
     * @return bool
     */
    public function isOpened(): bool
    {
        return isset($this->connection) && $this->connection instanceof \PDO;
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
     * @param string $sql
     *
     * @return StatementInterface
     *
     * @throws ConnectionException
     */
    public function query(string $sql): StatementInterface
    {
        if (!$this->isOpened()) {
            throw new ConnectionException('connection is not open.', 1);
        }
        $statement = $this->connection->prepare($sql);

        return new Statement($statement);
    }

    /**
     * @param string $sql
     *
     * @return bool
     *
     * @throws ConnectionException
     */
    public function execute(string $sql): bool
    {
        if (!$this->isOpened()) {
            throw new ConnectionException('connection is not open.', 1);
        }
        $statement = $this->connection->prepare($sql);
        $result = $statement->execute();
        $statement->closeCursor();

        return $result;
    }

    /**
     * @return bool
     */
    public function begin(): bool
    {
        return $this->connection->beginTransaction();
    }

    /**
     * @return bool
     */
    public function commit(): bool
    {
        return $this->connection->commit();
    }

    /**
     * @return bool
     */
    public function rollup(): bool
    {
        return $this->connection->rollBack();
    }
}
