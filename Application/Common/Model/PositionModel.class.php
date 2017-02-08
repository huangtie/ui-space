<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/23
 * Time: 15:45
 */

namespace Common\Model;
use Think\Model;
class PositionModel extends Model
{

    private $_db = '';

    public function __construct()
    {
        $this->_db = M('position');
    }

    public function getPositions($page,$pageCount){

        $where['status'] = array('neq',-1);
        return $this->_db->where($where)->order('id desc')->page($page,$pageCount)->select();
    }

    public function getPositionCount(){
        $where['status'] = array('neq',-1);
        return $this->_db->where($where)->count();
    }

    public function getPositionInfo($id){
        if (!isset($id) || !is_numeric($id)){
            return false;
        }
        return $this->_db->where('id='.$id)->find();
    }

    public function insertPosition($data){
        if (!isset($data) || !is_array($data)){
            return false;
        }
        $data['create_time']=time();
        $data['update_time']=time();
        return $this->_db->add($data);
    }

    public function updatePosition($id,$data){
        if (!isset($id) || !is_numeric($id)){
            return false;
        }
        if (!isset($data) || !is_array($data)){
            return false;
        }
        $data['update_time']=time();
        return $this->_db->where('id='.$id)->save($data);
    }

    function setStatus($id,$status){
        if (!isset($id) || !is_numeric($id)){
            return false;
        }
        $data['status']=$status;
        return $this->_db->where('id='.$id)->save($data);
    }
}