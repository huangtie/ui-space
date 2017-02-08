<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/23
 * Time: 15:40
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class PositionController extends CommonController
{
    function index()
    {
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        $positions = D('Position')->getPositions($page,$pageSize);
        $count = D('Position')->getPositionCount();

        $res = new \Think\Page($count,$pageSize);
        $pageRes = $res->show();

        $this->assign('positions',$positions);
        $this->assign('pageRes',$pageRes);
        $this->display();
    }

    function add(){

        $this->display();
    }

    function edit(){
        $positionData = D('Position')->getPositionInfo($_GET['id']);
        $this->assign('positionData',$positionData);
        $this->display();
    }

    function save(){

        if (!isset($_POST['name']) || !$_POST['name']){
            return myjson(1,'请输入名称');
        }

        if (!isset($_POST['description']) || !$_POST['description']){
            return myjson(1,'请输入简介');
        }

        if (isset($_POST['id']) && $_POST['id']){

            $res = D('Position')->updatePosition($_POST['id'],$_POST);
            if ($res === false){
                return myjson(1,'修改失败');
            }
            else{
                return myjson(0,'修改成功');
            }
        }
        else{
            $res = D('Position')->insertPosition($_POST);
            if ($res === false){
                return myjson(1,'添加失败');
            }
            else{
                return myjson(0,'添加成功');
            }
        }
    }

    function setStatus(){

        $res = D('Position')->setStatus($_POST['id'],$_POST['status']);
        if ($res === false){
            return myjson(1,'删除失败');
        }
        else{
            return myjson(0,'删除成功');
        }
    }
}