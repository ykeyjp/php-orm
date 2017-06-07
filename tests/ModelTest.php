<?php
namespace ykey\orm;

use PHPUnit\Framework\TestCase;
use ykey\orm\model\ItemModel;

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
    fld1 TEXT,
    fld2 INTEGER(8) NOT NULL
)
_;
        $connection->execute($sql);
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
        $item->name = 'name';
        $item->email = 'user@example.com';
        $this->assertNull($item->id);
        $success = $item->save();
        $this->assertTrue($success);
    }
}
