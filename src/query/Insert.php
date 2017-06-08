<?php
namespace ykey\orm\query;

/**
 * Class Insert
 *
 * @package ykey\orm\query
 */
class Insert
{
    /**
     * @var string
     */
    private $tableName;
    /**
     * @var Field[]
     */
    private $fields = [];

    /**
     * Insert constructor.
     *
     * @param string $tableName
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @param string $name
     * @param string $type
     * @param        $value
     *
     * @return Insert
     */
    public function set(string $name, string $type, $value): self
    {
        $this->fields[$name] = new Field($name, $type, $value);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return null|Field
     */
    public function get(string $name): ?Field
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @param string $name
     *
     * @return Insert
     */
    public function remove(string $name): self
    {
        if (isset($this->fields[$name])) {
            unset($this->fields[$name]);
        }

        return $this;
    }

    /**
     * @return SQL
     */
    public function toSQL(): SQL
    {
        $placeholder = [];
        foreach ($this->fields as $field) {
            $type = $field->getType();
            $name = $field->getExpressedName();
            $value = $field->getExpressedValue();
            $placeholder[":{$name}"] = [$value, $type];
        }
        $sql = 'INSERT INTO "' . $this->tableName . '" ('
            . implode(', ', array_map(function ($name) {
                return "\"$name\"";
            }, array_keys($this->fields)))
            . ') VALUES ('
            . implode(', ', array_keys($placeholder))
            . ')';

        return new SQL($sql, $placeholder);
    }
}
