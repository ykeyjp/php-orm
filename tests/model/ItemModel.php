<?php
namespace ykey\orm\model;

use ykey\orm\Entity;

/**
 * Class ExampleModel
 *
 * @package ykey\orm\model
 * @entity(name:example, connection:default)
 */
class ItemModel extends Entity
{
    /**
     * @var int
     * @attribute(type:int, length:10, primary:true)
     */
    public $id;
    /**
     * @var string
     * @attribute(name:nickname, type:string, length:32, unique:true)
     */
    public $name;
    /**
     * @var string
     * @attribute(type:string, length:64, nullable:true)
     */
    public $email;
}
