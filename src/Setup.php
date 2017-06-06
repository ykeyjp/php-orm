<?php
namespace ykey\orm;

class Setup
{
    private static $manager = [];

    public static function register(string $name, DriverInterface $driver)
    {
        self::$manager[$name] = new ModelManager($driver);
    }

    public static function registerDefault(DriverInterface $driver)
    {
        self::register('default', $driver);
    }

    public static function hasManager(string $name): bool
    {
        return isset(self::$manager[$name]);
    }

    public static function getManager(string $name): ?ModelManager
    {
        return self::$manager[$name] ?? null;
    }
}
