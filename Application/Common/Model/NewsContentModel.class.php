<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/15
 * Time: 18:20
 */

namespace Common\Model;
use Think\Model;
class NewsContentModel extends Model{

    private $_db = '';
    public function __construct()
    {
        $this->_db = M('news_content');
    }

    public function insertNewsContent($data){
        if (!isset($data) || !is_array($data)){
            return 0;
        }
        $data['create_time']= time();
        $data['content'] = htmlspecialchars($data['content']);
        return $this->_db->add($data);
    }

    public function getContentText($id){
        if (!$id || !is_numeric($id)){
            return false;
        }
        $res = $this->_db->where('news_id = '.$id)->find();
        return $res['content'];
    }

    public function updateContent($id,$data){
        if (!$id || !is_numeric($id)){
            return false;
        }
        if (!$data || !is_array($data)){
            return false;
        }
        $data['update_time']= time();
        $data['content'] = htmlspecialchars($data['content']);
        $res = $this->_db->where('news_id='.$id)->save($data);
        return $res;
    }
}