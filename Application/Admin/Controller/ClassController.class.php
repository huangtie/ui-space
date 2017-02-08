<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/9/19
 * Time: 15:45
 */

namespace Admin\Controller;
use Think\Controller;
class ClassController extends Controller
{
    public function index($num=1)
    {
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 6;
        $where = array(
            'type'=>$num,
        );

        if (isset($_GET['parent_id']) && $_GET['parent_id']){
            $where['parent_id'] = $_GET['parent_id'];
            $this->assign('parent_id',$_GET['parent_id']);
        }


        $classList = D('Class')->getClasslist($where,$page,$pageSize);
        $clasCount = D('Class')->getClassCount($where);
        $res = new \Think\Page($clasCount,$pageSize);
        $pageRes = $res->show();

        $this->assign('classList',$classList);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$num);

        if ($num > 1){
            $where = array(
                'type'=>$num - 1,
            );
            $parentdata = D('Class')->getClasslist($where,1,100);
            $this->assign('parentdata',$parentdata);
        }

        $this->display('index');
    }

    public function one(){
        $this->index(1);
    }

    public function two(){
        $this->index(2);
    }

    public function three(){
        $this->index(3);
    }

    public function add(){
        $type = $_GET['type'];
        $this->assign('type', $type);
        $where = array(
            'type'=>$type - 1,
        );
        $parentdata = D('Class')->getClasslist($where,1,100);
        $this->assign('parentdata',$parentdata);
        $this->display();
    }

    public function saveAdd()
    {
        $parent_id = $_POST['parent_id'];
        $class_name = $_POST['class_name'];
        $type = $_POST['type'];

        if ($type != 1){
            if (!isset($parent_id) || $parent_id==0){
                return myjson(1, '请选择上级分类');
            }
        }

        if (!isset($class_name) || !$class_name){
            return myjson(1, '请输入分类名称');
        }

        if (strlen($class_name)>24){
            return myjson(1, '名称过长');
        }

        if (isset($_POST['class_id']) && $_POST['class_id']){
            $classid = $_POST['class_id'];
            unset($_POST['class_id']);

            $res = D('class')->updateClass($classid,$_POST);
            if ($res===0){
                return myjson(1, '修改失败');
            }
            else{
                return myjson(0, '修改成功');
            }
        }
        else{
            $res = D('class')->insertClass($_POST);
            if ($res===0){
                return myjson(1, '添加失败');
            }
            else{
                return myjson(0, '添加成功');
            }
        }
    }

    public function edit(){
        $type = $_GET['type'];
        $id = $_GET['id'];
        $this->assign('type', $type);
        $where = array(
            'type'=>$type - 1,
        );
        $parentdata = D('Class')->getClasslist($where,1,100);
        $this->assign('parentdata',$parentdata);

        $classData = D('Class')->getClassById($id);
        $this->assign('classData',$classData);
        $this->assign('class_id',$id);
        $this->display();
    }

    public function setStatus(){
        try{
            $res = D('class')->setStatus($_POST['id'],$_POST['status']);
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
                    $res = D('class')->setlistorder($menuid,$v);
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