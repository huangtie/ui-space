<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/12
 * Time: 18:37
 */

namespace Admin\Controller;
use Think\Controller;

class ImageController extends Controller{
    function Index(){

    }

    function ajaxuploadimage(){
        $res = D('UploadImage')->imageUpload();
        if ($res===false){
            return myjson(0,'上传失败','');
        }
        else{
            return myjson(1,'上传成功',$res);
        }
    }

    function kindupload(){
        $res = D('UploadImage')->upload();
        if ($res===false){
            return kinduploadJson(1);
        }
        return kinduploadJson(0,$res);
    }
}