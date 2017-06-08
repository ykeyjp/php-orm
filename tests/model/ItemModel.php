<?php
namespace ykey\orm\model;

use ykey\orm\Entity;

/**
 * Class ItemModel
 *
 * @package ykey\orm\model
 * @entity(name:items, connection:default)
 */
class ItemModel extends Entity
{
    /**
     * @var int
     * @attribute(type:int, primary:true, autoincrement:true)
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
    /**
     * @var int
     * @attribute(type:int, length:3)
     */
    public $age;
    /**
     * @var \DateTime
     * @attribute(name: modified_at, type:timestamp)
     */
    public $modifiedAt;
}
