<?php
namespace Home\Controller;
use Home\Controller\CommonController;
use Think\Exception;

class IndexController extends CommonController {
    public function index(){

        $classData = D('Class')->getAllClass();
        $this->assign('classData',$classData);

        $c1 = $_GET['c1']; //选中的一级分类
        $c2 = $_GET['c2']; //选中的二级分类
        $c3 = $_GET['c3']; //选中的三级分类
        if (!isset($_GET['c1']) || !$_GET['c1']){
            if(isset($classData[0])){
                $c1 = $classData[0]['class_id'];
            }
        }

        if (!isset($_GET['c2']) || !$_GET['c2']){
            if(isset($classData[0]['next'][0])){
                $c2 = $classData[0]['next'][0]['class_id'];
            }
        }

        $s3list = D('Class')->getClasslist(array('parent_id'=>$c2));
        $this->assign('s3list',$s3list);
        if (!isset($_GET['c3']) || !$_GET['c3']){

            if(isset($s3list[0])){
                $c3 = $s3list[0]['class_id'];
            }
        }

        $this->assign('c1',$c1);
        $this->assign('c2',$c2);
        $this->assign('c3',$c3);


        $contrs = array(
            's1'=>$c1,
            's2'=>$c2,
            's3'=>$c3,
        );
        $count = D('Content')->getContentCount($contrs);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 12;
        $res = new \Think\Page($count,$pageSize);
        $pageRes = $res->show();

        $contentdata = D('Content')->getContents($contrs,$page,$pageSize);

        $this->assign('contentdata',$contentdata);
        $this->assign('pageRes',$pageRes);

        $this->display();
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

}