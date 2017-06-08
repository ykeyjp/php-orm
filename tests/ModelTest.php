<?php
namespace ykey\orm;

use PHPUnit\Framework\TestCase;
use ykey\orm\model\ItemModel;
use ykey\orm\query\SQL;

class ModelTest extends TestCase
{
    /**
     * @var driver\pdo\Connection
     */
    private $connection;

    protected function setUp()
    {
        $connection = new driver\pdo\Connection('sqlite::memory:');
        $connection->open();
        $sql = <<<_
CREATE TABLE items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nickname VARCHAR(32) NOT NULL UNIQUE,
    email VARCHAR(64),
    age INTEGER(3),
    modified_at TIMESTAMP NOT NULL
)
_;
        $connection->execute(new SQL($sql));
        $this->connection = $connection;
    }

    public function testSetup()
    {
        Setup::registerDefault($this->connection);
        $this->assertTrue(Setup::hasDefault());
        $connection = Setup::getDefault();
        $this->assertInstanceOf(driver\pdo\Connection::class, $connection);

        return $connection;
    }

    /**
     * @depends testSetup
     */
    public function testSave()
    {
        $item = new ItemModel;
        $item->name = 'username';
        $item->email = 'user@example.com';
        $item->age = 20;
        $item->modifiedAt = new \DateTime();
        $this->assertNull($item->id);
        $success = $item->save();
        $this->assertTrue($success);
    }
}
