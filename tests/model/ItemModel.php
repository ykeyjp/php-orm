<?php
namespace ykey\orm\model;

use ykey\orm\Entity;

/**
 * Class ExampleModel
 *
 * @package ykey\orm\model
 * @Entity(name:example, connection:default)
 */
class ItemModel extends Entity
{
    /**
     * @var int
     * @Attribute(type:int, length:10, primary:true, autoincrement:true)
     */
    public $id;
    /**
     * @var string
     * @Attribute(name:nickname, type:string, length:32, index:true, unique:true)
     */
    public $name;
    /**
     * @var string
     * @Attribute(type:string, length:64, index:true, nullable:true)
     */
    public $email;
}
