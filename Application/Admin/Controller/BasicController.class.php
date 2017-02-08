<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/29
 * Time: 15:03
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class BasicController extends CommonController
{
    function index()
    {
        $data = D('Basic')->load();
        $this->assign('data',$data);
        $this->display();
    }

    function save(){

        if (!$_POST){
            print_r($_POST);exit();
            return myjson(1,'没有数据');
        }
        else{
            if (!isset($_POST['title']) || !$_POST['title']){
                return myjson(1,'请输入站点标题');
            }

            if (!isset($_POST['keywords']) || !$_POST['keywords']){
                return myjson(1,'请输入关键字');
            }

            if (!isset($_POST['description']) || !$_POST['description']){
                return myjson(1,'请输入站点标题');
            }

            $res = D('Basic')->insert($_POST);
            if ($res === false){
                return myjson(1,'保存失败');
            }else{
                return myjson(0,'保存成功');
            }
        }
    }

    function cache(){
        $this->display('Basic/cache');
    }
}