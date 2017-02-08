<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/30
 * Time: 15:17
 */

namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{

    public function __construct()
    {
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }

    public function error($message=''){
        $msg = $message=='' ? '系统发生错误':$message ;
        $this->assign('msg',$msg);
        $this->display("Index/error");
    }
}