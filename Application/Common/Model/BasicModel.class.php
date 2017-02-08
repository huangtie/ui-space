<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/29
 * Time: 16:18
 */

namespace Common\Model;
use Think\Model;
class BasicModel extends Model
{
    public function __construct()
    {

    }

    public function insert($data=array()){
        if (!$data || !is_array($data)){
            throw_exception('数据错误');
        }
        else{
            return F(C('basic_savename_key'),$data);
        }
    }

    public function load(){
        return F(C('basic_savename_key'));
    }
}