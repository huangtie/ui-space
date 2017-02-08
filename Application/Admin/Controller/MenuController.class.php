<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/10
 * Time: 18:23
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class MenuController extends Controller
{
    public function index()
    {
        $where = array();
        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1))){
            $where['type'] = intval($_REQUEST['type']);
            $this->assign('type',$where['type']);
        }
        else{
            $this->assign('type',-1);
        }

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10;
        $menuList = D('Menu')->getMenus($where,$page,$pageSize);
        $menuCount = D('Menu')->getMenuCount($where);

        $res = new \Think\Page($menuCount,$pageSize);
        $pageRes = $res->show();

        $this->assign('menuList',$menuList);
        $this->assign('pageRes',$pageRes);
        $this->display();
    }

    public function add(){
        $this->display('add');
    }

    public function edit(){

        $id = $_GET['id'];
        $res = D('Menu')->getMenuInfo($id);
        if ($res != false){
            $this->assign('menuInfo',$res);
        }
        $this->display('edit');
    }

    public function saveAdd()
    {
        if (!isset($_POST['name']) || !$_POST['name']){
            return myjson(1,'菜单名不能为空');
        }
        if (!isset($_POST['m']) || !$_POST['m']){
            return myjson(1,'模块不能为空');
        }
        if (!isset($_POST['c']) || !$_POST['c']){
            return myjson(1,'控制器不能为空');
        }
        if (!isset($_POST['f']) || !$_POST['f']){
            return myjson(1,'方法不能为空');
        }

        if (isset($_POST['menu_id']) && $_POST['menu_id']){

            return $this->update($_POST);
        }
        else{
            $menuid = D('Menu')->insert($_POST);
            if (!$menuid){
                return myjson(1,'添加失败');
            }
            else{
                return myjson(0,'添加成功');
            }
        }
    }


    public function update($data){
        $menuid = $data['menu_id'];
        unset($data['menu_id']);
        try{
            $id = D('Menu')->updateMenuInfo($menuid,$data);
            if ($id === false){
                myjson(1,'修改失败');
            }else{
                myjson(0,'修改成功');
            }
        }
        catch (Exception $e){
            myjson(1,$e->getMessage());
        }
    }

    public function setStatus(){
        try{
            $res = D('Menu')->setStatus($_POST['id'],$_POST['status']);
            if ($res===false){
                myjson(1,$res);
            }
            else{
                myjson(0,'操作成功');
            }
        }catch (Exception $e){
            myjson(1,$e->getMessage());
        }
    }

    public function listorder(){

        if ($_POST['listorder']){
            try{
                $errors = array();
                foreach ($_POST['listorder'] as $menuid =>$v){
                    $res = D('Menu')->setlistorder($menuid,$v);
                    if ($res===false){
                        $errors[] = $menuid;
                    }
                }
                if ($errors){
                    myjson(1,'更新失败'.implode(',',$errors));
                }
                else{
                    myjson(0,'更新成功');
                }
            }catch (Exception $e){
                myjson(1,'更新失败');
            }
        }
        else{
            myjson(1,'更新失败');
        }
    }






}