<?php
namespace ykey\orm;

use PHPUnit\Framework\TestCase;

/**
 * Class DriverTest
 *
 * @package  ykey\orm
 * @requires extension pdo
 * @requires extension pdo_mysql
 */
class DriverTest extends TestCase
{
    protected function setUp()
    {
        $this->markTestIncomplete();
    }

    public function testConnect()
    {
        $pdo = new driver\PDO('sqlite::memory:');
        $this->assertFalse($pdo->isOpened());
        $pdo->open();
        $this->assertTrue($pdo->isOpened());
        $pdo->close();
        $this->assertFalse($pdo->isOpened());
        $pdo->open();

        return $pdo;
    }
}
