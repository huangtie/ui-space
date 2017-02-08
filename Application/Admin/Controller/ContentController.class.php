<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/12
 * Time: 17:45
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;
use Think\Db;
use Think\Exception;

class ContentController extends CommonController{
    function index(){
//        $menu = D('Menu')->getSiteMenu();
//
//        $where = array();
//        if (isset($_REQUEST['class_id']) && $_REQUEST['class_id']){
//            $where['class_id'] = intval($_REQUEST['class_id']);
//            $this->assign('class_id',$where['class_id']);
//        }


        $contrs = array();
        if ($_GET['content_name']){
            $contrs['content_name']=$_GET['content_name'];
            $this->assign('content_name',$contrs['content_name']);
        }
        else{
            $this->assign('content_name','');
        }

        if ($_GET['class_id']){
            $contrs['class_id']=intval($_GET['class_id']);
            $this->assign('class_id',$contrs['class_id']);
        }
        else{
            $this->assign('class_id','');
        }
        $count = D('content')->getContentCount($contrs);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
        $res = new \Think\Page($count,$pageSize);
        $pageRes = $res->show();

        $contentdata = D('content')->getContents($contrs,$page,$pageSize);

//        $positionData = D('Position')->getPositions();

//        $this->assign('menus',$menu);
        $this->assign('contentdata',$contentdata);
        $this->assign('pageRes',$pageRes);
//        $this->assign('positionData',$positionData);
        $this->display();
    }

    function add(){
        $colors = C('COLOR_TITLES');
        $copyfrom = C('COPY_FROM');
        $menus = D('Menu')->getSiteMenu();

        $this->assign('colors',$colors);
        $this->assign('copyfrom',$copyfrom);
        $this->assign('menus',$menus);
        $this->display('add');
    }

    function saveAdd(){
        if (!isset($_POST['content_name']) || !$_POST['content_name']){
            return myjson(1,'请输入标题');
        }

        if (!isset($_POST['s1']) || !$_POST['s1']){
            return myjson(1,'请选择分类一');
        }

        if (!isset($_POST['s2']) || !$_POST['s2']){
            return myjson(1,'请选择分类二');
        }

        if (!isset($_POST['s3']) || !$_POST['s3']){
            return myjson(1,'请选择分类三');
        }

        if (!isset($_POST['content_image']) || !$_POST['content_image']){
            return myjson(1,'请上传图片');
        }

        if (!isset($_POST['content_url']) || !$_POST['content_url']){
            return myjson(1,'请输入链接地址');
        }

        if (!isset($_POST['content_text']) || !$_POST['content_text']){
            return myjson(1,'请输入描述');
        }


        if (isset($_POST['content_id']) && $_POST['content_id']){
            return $this->update($_POST);
        }else{
            $res = D('content')->insertContent($_POST);
            if ($res === false){

                return myjson(1,'添加失败');
            }
            else{
                return myjson(0,'添加成功');
            }
        }
    }

    public function setStatus(){
        try{
            $res = D('content')->setStatus($_POST['id'],intval($_POST['status']));
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
                    $res = D('content')->setlistorder($news_id,$v);
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

    public function edit(){


        $contentData = D('content')->getContentInfo($_GET['id']);
        $this->assign('contentData',$contentData);

        $this->display();
    }

    public function update($data){
        $content_id = $data['content_id'];
        unset($data['content_id']);
        try{
            $res = D('content')->updateContentInfo($content_id,$data);
            if ($res === false){
                return myjson(1,'更新失败');
            }else{
                return myjson(0,'更新成功');
            }
        }
        catch (Exception $e){
            myjson(1,$e->getMessage());
        }
    }

    public function push(){

        $position_id = intval($_POST['position_id']);
        $newsIds = $_POST['push'];

        if (!$newsIds){
            return myjson(1,'推荐内容不存在');
        }

        if (!$position_id){
            return myjson(1, '未选择推荐位');
        }

        try{
            $news = D('News')->getNewsInfoInids($newsIds);
            if (!$news){
                return myjson(1, '没有相关数据');
            }else{
                $datas = array();
                $i = 0;
                foreach ($news as $new){
                    $content['news_id'] = $new['news_id'];
                    $content['title'] = $new['title'];
                    $content['thumb'] = $new['thumb'];
                    $content['status'] = 1;
                    $content['create_time'] = $new['create_time'];
                    $content['position_id'] = $position_id;

                    $datas[$i] = $content;
                    $i+=1;
                }
                $res = D("Positioncontent")->insertAll($datas);
                if ($res === false){
                    return myjson(1,'推送失败');
                }
                else{
                    $jump_url = $_SERVER['HTTP_REFERER'];
                    return myjson(0,'推送成功',array('jump_url'=>$jump_url));
                }
            }
        }catch (Exception $e){
            return myjson(1, $e->getMessage());
        }
    }

    function getClass(){
        $type = $_POST['type'];
        $parent_id = $_POST['parent_id'];
        if (!$parent_id){
            $parent_id = 0;
        }
        $where = array(
            'type'=>$type,
            'parent_id'=>$parent_id,
        );

        $res = D('class')->getClasslist($where,1,1000);
        return myjson(1,'',$res);
    }



}