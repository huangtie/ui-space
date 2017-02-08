<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/23
 * Time: 15:36
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class PositioncontentController extends CommonController
{
    function index()
    {
        $positions = D('Position')->getPositions(1,1000);

        $where = array();
        $position_id = $_GET['positionid'];
        $title = $_GET['title'];
        if ($position_id && $position_id != -1){

            $this->assign('position_id',$position_id);
            $where['position_id'] = array('eq',$position_id);
        }
        else{
            $this->assign('position_id',-1);
        }

        if ($title){
            $this->assign('title',$title);
            $where['title'] = array('like','%'.$title.'%');
        }

        $count = D('Positioncontent')->getContentCount($where);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
        $res = new \Think\Page($count,$pageSize);
        $pageRes = $res->show();
        $contents = D('Positioncontent')->getContent($where,$page,$pageSize);






        $this->assign('positions',$positions);
        $this->assign('pageRes',$pageRes);
        $this->assign('contents',$contents);
        $this->display();
    }

    function setStatus(){
        try{
            $res = D('Positioncontent')->setStatus($_POST['id'],intval($_POST['status']));
            if ($res===false){
                return myjson(1,$res);
            }
            else{
                return myjson(0,'操作成功');
            }
        }catch (Exception $e){
            return myjson(1,$e->getMessage());
        }
    }

    public function listorder(){

        if ($_POST['listorder']){
            try{
                $errors = array();
                foreach ($_POST['listorder'] as $news_id =>$v){
                    $res = D('Positioncontent')->setlistorder($news_id,$v);
                    if ($res===false){
                        $errors[] = $news_id;
                    }
                }
                if ($errors){
                    return myjson(1,'更新失败'.implode(',',$errors));
                }
                else{
                    return myjson(0,'更新成功');
                }
            }catch (Exception $e){
                return myjson(1,'更新失败');
            }
        }
        else{
            return myjson(1,'更新失败');
        }
    }

    public function add(){
        $positions = D('Position')->getPositions(1,1000);
        $this->assign('positions',$positions);
        $this->display();
    }

    public function edit(){
        $positions = D('Position')->getPositions(1,1000);
        $this->assign('positions',$positions);
        $this->display();
    }

    public function save(){
        if (!isset($_POST['title']) || !$_POST['title']){
            return myjson(1,'请输入标题');
        }

        if (!isset($_POST['position_id']) || !$_POST['position_id']){
            return myjson(1,'请选择推荐位');
        }

        if (!isset($_POST['thumb']) || !$_POST['thumb']){
            return myjson(1,'请输上传缩图');
        }

        if (!isset($_POST['url']) || !$_POST['url']){
            if (!isset($_POST['news_id']) || !$_POST['news_id']){
                return myjson(1,'"url"和"文章id"二选一');
            }
        }

        try{
            $_POST['create_time'] = time();
            $res = D('Positioncontent')->insertSingle($_POST);
            if ($res === false){
                return myjson(1,'添加失败');
            }else{
                return myjson(0,'添加成功');
            }
        }catch (Exception $e){
            return myjson(1,$e->getMessage());
        }


    }
}