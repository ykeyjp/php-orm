<?php
namespace ykey\orm;

use PHPUnit\Framework\TestCase;

/**
 * Class DriverTest
 *
 * @package  ykey\orm
 * @requires extension pdo
 */
class DriverTest extends TestCase
{
    public function testConnect()
    {
        $connection = new driver\pdo\Connection('sqlite::memory:');
        $this->assertFalse($connection->isOpened());
        $connection->open();
        $this->assertTrue($connection->isOpened());
        $connection->close();
        $this->assertFalse($connection->isOpened());
        $connection->open();

        return $connection;
    }

    /**
     * @param driver\pdo\Connection $connection
     *
     * @return driver\pdo\Connection
     *
     * @depends testConnect
     */
    public function testCreateTable(driver\pdo\Connection $connection)
    {
        $sql = <<<_
CREATE TABLE items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fld1 TEXT,
    fld2 INTEGER(8) NOT NULL
)
_;
        $this->assertTrue($connection->execute($sql));

        return $connection;
    }

    /**
     * @param driver\pdo\Connection $connection
     *
     * @depends testCreateTable
     */
    public function testQuery(driver\pdo\Connection $connection)
    {
        $statement = $connection->query('SELECT * FROM sqlite_master WHERE name = "items"');
        $this->assertTrue($statement->execute());
        $row = $statement->fetch();
        $this->assertNotNull($row);
        $this->assertArrayHasKey('type', $row);
        $this->assertEquals('table', $row['type']);
    }
}
