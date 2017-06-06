<?php
namespace ykey\orm\query;

class Table
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     *
     * @return Table
     */
    public static function new(string $name)
    {
        $table = new self();
        $table->name = $name;

        return $table;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function addColumn($name, array $options = [])
    {
        $column = Column::new($name, $options);
    }
}
