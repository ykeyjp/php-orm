<?php
namespace ykey\orm\query;

use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    public function testCreateTable()
    {
        $table = Table::new('items');
        $this->assertEquals('items', $table->getName());
    }
}
