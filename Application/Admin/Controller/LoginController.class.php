<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){

        $this->display();

        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function login(){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!trim($username))
        {
            return myjson(1,'用户名不能为空');
        }
        if (!trim($password))
        {
            return myjson(1,'密码不能为空');
        }

        $res = D('Admin')->getUserInfo($username);
        if (!$res){
            return myjson(1,'用户不存在');
        }
        if ($res['password'] != passwordMD5($password)){
            return myjson(1,'密码错误');
        }
        session(C('session_key'),$res);
        return myjson(0,'登录成功');
    }
}

