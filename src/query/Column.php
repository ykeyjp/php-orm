<?php
namespace ykey\orm\query;

class Column
{
    /**
     * @var string
     */
    private $name;
    private $type;
    private $length;
    private $primary;
    private $unique;
    private $index;

    public static function new(string $name, array $options = [])
    {
        $column = new self();
        $column->name = $name;
        $options = array_merge([
            'type'    => 'string',
            'length'  => -1,
            'primary' => false,
            'unique'  => false,
            'index'   => false,
        ], $options);
        $column->type = $options['type'];
        $column->length = $options['length'];
        $column->primary = $options['primary'];
        $column->unique = $options['unique'];
        $column->index = $options['index'];

        return $column;
    }
}
