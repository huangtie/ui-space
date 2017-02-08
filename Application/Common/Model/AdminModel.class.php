<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/10
 * Time: 16:45
 */

namespace Common\Model;
use Think\Model;
class AdminModel extends Model{

    private $_db = '';
    public function __construct()
    {
        $this->_db = M('admin');
    }

    public function getUserInfo($username){
        return $this->_db->where('username="'.$username.'"')->find();
    }

}