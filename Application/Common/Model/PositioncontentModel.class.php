<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/23
 * Time: 18:16
 */

namespace Common\Model;
use Think\Model;
class PositioncontentModel extends Model
{

    private $_db = '';

    public function __construct()
    {
        $this->_db = M('position_content');
    }

    public function insertSingle($data){

        if (!$data || !is_array($data)){
            return false;
        }

        return $this->_db->add($data);
    }

    public function insertAll($datas){

        if (!$datas || !is_array($datas)){
            return false;
        }
        return $this->_db->addAll($datas);
    }

    public function getContent($where,$page,$pageSize){
        if (!$where['status']){
            $where['status'] = array('neq',-1);
        }
        return $this->_db->where($where)->page($page,$pageSize)->order('listorder desc,id desc')->select();
    }

    public function getContentCount($where){
        if (!$where['status']){
            $where['status'] = array('neq',-1);
        }
        return $this->_db->where($where)->count();
    }

    public function setStatus($id,$status){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['status'] = $status;
        $res = $this->_db->where('id='.$id)->save($data);

        return $res;
    }

    public function setlistorder($id,$listorder){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['listorder']=intval($listorder);
        return $this->_db->where('id='.$id)->save($data);
    }
}