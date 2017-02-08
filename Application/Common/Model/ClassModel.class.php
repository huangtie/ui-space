<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/9/19
 * Time: 18:53
 */

namespace Common\Model;
use Think\Model;
class ClassModel extends Model
{

    private $_db = '';

    public function __construct()
    {
        $this->_db = M('Class');
    }

    public function getClasslist($data,$page=1,$pageSize=1000){
        $where = $data;
        if (!$data['status']){
            $where['status'] = array('neq',-1);
        }
        else{
            $where['status'] = $data['status'];
        }

        $res = $this->_db->where($where)->order('listorder desc, class_id asc')->page($page,$pageSize)->select();

        $i=0;
        foreach ($res as $item){
            $w = array(
                'class_id'=>$item['parent_id'],
            );
            $name = $this->_db->where($w)->find();
            $res[$i]['class_parent_name']=$name['class_name'];

            $i++;
        }
        return $res;
    }

    public function getClassCount($data){
        $where = $data;
        if (!$data['status']){
            $where['status'] = array('neq',-1);
        }
        else{
            $where['status'] = $data['status'];
        }
        return $this->_db->where($where)->count();
    }

    public function getClassById($id){
        if (!$id || !is_numeric($id)){
            return false;
        }
        $where = array(
            'class_id'=>$id,
        );
        return $this->_db->where($where)->find();
    }

    public function insertClass($data){

        if (!isset($data) || !is_array($data)){
            return 0;
        }

        return $this->_db->add($data);
    }

    public function updateClass($id,$data){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        if (!$data || !is_array($data)){
            throw_exception('数据错误');
        }

        return $this->_db->where('class_id='.$id)->save($data);
    }

    public function getAllClass(){

        $where = array(
            'parent_id'=>0,
            'status'=>1,
        );
        $one = $this->_db->where($where)->order('listorder desc, class_id asc')->select();

        $i=0;
        foreach ($one as $son){
            $twoWhere=array(
                'parent_id'=>$son['class_id'],
                'status'=>1,
            );
            $two = $this->_db->where($twoWhere)->order('listorder desc, class_id asc')->select();
            $j = 0;
            foreach ($two as $t){
                $two[$j]['content_count'] = D('content')->getContentCountByClassId($t['class_id'],2);
                $j++;
            }

            $item = array(
                'class_id'=>$son['class_id'],
                'class_name'=>$son['class_name'],
                'parent_id'=>$son['parent_id'],
                'next'=>$two,
            );
            $one[$i]=$item;
            $i++;
        }
        return $one;
    }

    public function setStatus($id,$status){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        if (!is_numeric($status)){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('class_id='.$id)->save($data);
    }

    public function setlistorder($id,$listorder){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['listorder']=intval($listorder);
        return $this->_db->where('class_id='.$id)->save($data);
    }
}