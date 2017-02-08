<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/11
 * Time: 11:34
 */

namespace Common\Model;
use Think\Model;

class MenuModel extends Model{

    private $_db = '';
    public function __construct()
    {
        $this->_db = M('menu');
    }

    public function insert($data){
        if (!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }

    public function getMenus($where,$page,$pageCount){
        $where['status'] = array('neq',-1);
        return $this->_db->where($where)->order('listorder desc, menu_id asc')->page($page,$pageCount)->select();
    }

    public function getMenuCount($where){
        $where['status'] = array('neq',-1);
        return $this->_db->where($where)->count();
    }

    public function getMenuInfo($id){
        if (!$id || !is_numeric($id)){
            return false;
        }
        return $this->_db->where('menu_id = '.$id)->find();
    }

    public function updateMenuInfo($id ,$data){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        if (!$data || !is_array($data)){
            throw_exception('数据错误');
        }
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function setStatus($id,$status){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        if (!$status || !is_numeric($status)){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function setlistorder($id,$listorder){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['listorder']=intval($listorder);
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function getAdminMenu(){
        $where = array(
            'status'=>array('neq',-1),
            'type'=>1,
        );

        return $this->_db->where($where)->order('listorder desc,menu_id asc')->select();
    }

    public function getSiteMenu(){
        $where = array(
            'status'=>1,
            'type'=>0,
        );

        return $this->_db->where($where)->order('listorder asc,menu_id desc')->select();
    }

    public function getSiteMenubyid($id){
        return $this->_db->where('menu_id='.$id)->find();
    }
}