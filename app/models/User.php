<?php
/**
 * Created by PhpStorm.
 * User: 马兴文
 * Date: 2016/7/2 0002
 * Time: 10:21
 */
use Phalcon\Mvc\Model;
class User extends Model {
    //我们可以建立一些类的公共变量,变量对应表的字段
    public $id;
    public $name;
    public $phone;
    public $passwd;
}