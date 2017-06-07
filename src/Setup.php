<?php
namespace ykey\orm;

use ykey\orm\driver\ConnectionInterface;

/**
 * Class Setup
 *
 * @package ykey\orm
 */
class Setup
{
    /**
     * @var ConnectionInterface[]
     */
    private static $connections = [];

    /**
     * @param string              $name
     * @param ConnectionInterface $connection
     */
    public static function register(string $name, ConnectionInterface $connection): void
    {
        self::$connections[$name] = $connection;
    }

    /**
     * @param ConnectionInterface $connection
     *
     * @internal param ConnectionInterface $driver
     */
    public static function registerDefault(ConnectionInterface $connection): void
    {
        self::register('default', $connection);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public static function has(string $name): bool
    {
        return isset(self::$connections[$name]);
    }

    /**
     * @return bool
     */
    public static function hasDefault(): bool
    {
        return self::has('default');
    }

    /**
     * @param string $name
     *
     * @return null|ConnectionInterface
     */
    public static function get(string $name): ?ConnectionInterface
    {
        return self::$connections[$name] ?? null;
    }

    /**
     * @return null|ConnectionInterface
     */
    public static function getDefault(): ?ConnectionInterface
    {
        return self::get('default');
    }
}
