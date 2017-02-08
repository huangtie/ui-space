<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/10/14
 * Time: 15:21
 */

namespace Common\Model;
use Think\Model;
class ContentModel extends Model
{

    private $_db = '';

    public function __construct()
    {
        $this->_db = M('content');
    }

    public function getContents($data,$page,$pageCount=1000){
        $where = $data;
        if (!$data['status']){
            $where['status'] = array('neq',-1);
        }
        else{
            $where['status'] = $data['status'];
        }

        if (isset($data['class_id']) && $data['class_id']){
            $where['class_id']= intval($data['class_id']);
        }
        if (isset($data['content_name']) && $data['content_name']){
            $where['content_name']=array('like','%'.$data['content_name'].'%');
        }
        $res = $this->_db->where($where)->order('listorder desc, class_id asc')->page($page,$pageCount)->select();


        $i=0;
        foreach ($res as $item){

            $class3 = D('class')->getClassById($item['class_id']);
            $threeName = $class3['class_name'];

            $class2 = D('class')->getClassById($class3['parent_id']);
            $twoName = $class2['class_name'];

            $class1 = D('class')->getClassById($class2['parent_id']);
            $oneName = $class1['class_name'];



            $res[$i]['class_name']= $oneName . '/' . $twoName . '/' . $threeName;

            $i++;
        }
        return $res;
    }

    public function getContentCount($data){
        $where = $data;
        if (!$data['status']){
            $where['status'] = array('neq',-1);
        }
        else{
            $where['status'] = $data['status'];
        }

        if (isset($data['class_id']) && $data['class_id']){
            $where['class_id']= intval($data['class_id']);
        }
        if (isset($data['content_name']) && $data['content_name']){
            $where['content_name']=array('like','%'.$data['content_name'].'%');
        }
        return $this->_db->where($where)->count();
    }

    public function setlistorder($id,$listorder){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['listorder']=intval($listorder);
        return $this->_db->where('content_id='.$id)->save($data);
    }

    public function setStatus($id,$status){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['status'] = $status;
        $res = $this->_db->where('content_id='.$id)->save($data);

        return $res;
    }

    public function getContentInfo($id){
        if (!$id || !is_numeric($id)){
            return false;
        }
        $res = $this->_db->where('content_id = '.$id)->find();

        $class3 = D('class')->getClassById($res['class_id']);
        $threeName = $class3['class_name'];

        $class2 = D('class')->getClassById($class3['parent_id']);
        $twoName = $class2['class_name'];

        $class1 = D('class')->getClassById($class2['parent_id']);
        $oneName = $class1['class_name'];



        $res['class_name']= $oneName . '/' . $twoName . '/' . $threeName;
        return $res;
    }

    public function updateContentInfo($id,$data){
        if (!$id || !is_numeric($id)){
            return false;
        }
        if (!$data || !is_array($data)){
            return false;
        }
        $data['update_time']= time();
        $res = $this->_db->where('content_id='.$id)->save($data);
        return $res;
    }

    public function insertContent($data){
        if (!isset($data) || !is_array($data)){
            return 0;
        }

        $data['crate_time'] = time();
        $data['update_time']= time();
        return $this->_db->add($data);
    }

    public function updateCount($id,$count){
        if (!$id || !is_numeric($id)){
            throw_exception('id不合法');
        }

        if (!$count || !is_numeric($count)){
            throw_exception('计数不合法');
        }
        $data = array('readcount'=>$count);
        return $this->_db->where('content_id='.$id)->save($data);
    }

    public function getContentCountByClassId($class_id,$type=1){
        $s = 's1';
        if($type == 1){
            $s = 's1';
        }
        if ($type == 2){
            $s = 's2';
        }
        if ($type == 3){
            $s = 's3';
        }
        $contentCount = $this->_db->field('count(*) as total')->where($s.'='.$class_id)->find();
        return $contentCount['total'];
    }
}