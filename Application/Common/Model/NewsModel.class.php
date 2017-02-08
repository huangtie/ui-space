<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/15
 * Time: 18:20
 */

namespace Common\Model;
use Think\Model;
class NewsModel extends Model{

    private $_db = '';
    public function __construct()
    {
        $this->_db = M('news');
    }

    public function insertNews($data){
        if (!isset($data) || !is_array($data)){
            return 0;
        }

        $data['create_time'] = time();
        $data['username'] = getAdminUsername();
        return $this->_db->add($data);
    }

    public function getNewslist($data,$page,$pageCount){
        $where = array();
        if (!$data['status']){
            $where['status'] = array('neq',-1);
        }
        else{
            $where['status'] = $data['status'];
        }

        if (isset($data['catid']) && $data['catid']){
            $where['catid']= intval($data['catid']);
        }
        if (isset($data['title']) && $data['title']){
            $where['title']=array('like','%'.$data['title'].'%');
        }
        return $this->_db->where($where)->order('listorder asc, news_id desc')->page($page,$pageCount)->select();
    }

    public function getNewsCount($data){
        $where = array();
        if (!$data['status']){
            $where['status'] = array('neq',-1);
        }
        else{
            $where['status'] = $data['status'];
        }

        if (isset($data['catid']) && $data['catid']){
            $where['catid']= intval($data['catid']);
        }
        if (isset($data['title']) && $data['title']){
            $where['title']=array('like','%'.$data['title'].'%');
        }
        return $this->_db->where($where)->count();
    }

    public function setlistorder($id,$listorder){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['listorder']=intval($listorder);
        return $this->_db->where('news_id='.$id)->save($data);
    }

    public function setStatus($id,$status){
        if (!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data['status'] = $status;
        $res = $this->_db->where('news_id='.$id)->save($data);

        return $res;
    }

    public function getNewsInfo($id){
        if (!$id || !is_numeric($id)){
            return false;
        }
        $res = $this->_db->where('news_id = '.$id)->find();
        return $res;
    }

    public function getNewsInfoInids($ids){
        if (!$ids || !is_array($ids)){
            throw_exception('参数不合法');
        }

        $where = array(
            'news_id'=>array('in',implode(',',$ids)),
        );

        $res = $this->_db->where($where)->select();
        return $res;
    }

    public function updateNewsInfo($id,$data){
        if (!$id || !is_numeric($id)){
            return false;
        }
        if (!$data || !is_array($data)){
            return false;
        }
        $data['update_time']= time();
        $res = $this->_db->where('news_id='.$id)->save($data);
        return $res;
    }

    public function getRankNews(){
        return $this->_db->where('status=1')->order('count desc,news_id desc')->select();
    }

    public function updateCount($id,$count){
        if (!$id || !is_numeric($id)){
            throw_exception('id不合法');
        }

        if (!$count || !is_numeric($count)){
            throw_exception('计数不合法');
        }
        $data = array('count'=>$count);
        return $this->_db->where('news_id='.$id)->save($data);
    }
}