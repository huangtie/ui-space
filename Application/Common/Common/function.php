<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/10
 * Time: 10:35
 */

function myjson($status=0 , $message , $data=array())
{
    $result = array(
        'status'=>$status,
        'message'=>$message,
        'data'=>$data,
    );
    exit(json_encode($result));
}

function passwordMD5($password){
    return md5(C('md5_prex').$password);
}

function getMenuType($type){
    return $type == 1 ? '后台菜单' : '前端导航';
}

function getMenuStatus($status){
    if ($status == 0){
        return '<span style="color: #d43f3a">关闭</span>';
    }
    else if ($status == 1){
        return '<span style="color: #4cae4c">正常</span>';
    }
    else if($status == -1){
        return '删除';
    }
}

function getMenuUrl($nav){
    $url = '/admin.php?c='.$nav['c'].'&a='.$nav['f'];
    if ($nav['f']=='index'){
        $url = '/admin.php?c='.$nav['c'];
    }
    return $url;
}

function getActive($navc , $navf){
    $c = strtolower(CONTROLLER_NAME);
    if (strtolower($navc) == $c){
        if (strtolower($navc) == 'class')
        {
            $f = strtolower(ACTION_NAME);

            if (strtolower($navf) == $f)
            {
                return 'class="active"';
            }
            return '';
        }
        else
        {
            return 'class="active"';
        }
    }
    return '';
}

function kinduploadJson($status,$data){
    header('Content-type:application/json;charset=UTF-8');
    if ($status==0){
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
    exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}

function getAdminUsername(){
    return $_SESSION[C('session_key')]['username'] ? $_SESSION[C('session_key')]['username'] : ' ';
}

function getMenuName($data,$id){
    $res = array();
    foreach ($data as $item){
        $res[$item['menu_id']] = $item['name'];
    }
    return isset($res[$id]) ? $res[$id] : '';
}

function getCopyFrom($id){
    $copyfrom = C('COPY_FROM');
    return isset($copyfrom[$id]) ? $copyfrom[$id] : '';
}

function isThumb($path){
    return $path ? '<span style="color: #4cae4c">有</span>' : '无';

}

function isHideParent($type){
    if ($type == 1){
        return 'hide';
    }
    return '';
}


function homeshowActive($f , $s , $f2 , $s2){
    //return $f.','.$s.','.$f2.','.$s2;
    if ($f == $f2 && $s == $s2){
        return 'item_dd_active';
    }
    else{
        return '';
    }
}

function homes3Active($c3 , $s3){
    if ($s3 == $c3){
        return 'content_nav_a_active';
    }
    else{
        return '';
    }
}

function gethomeMenuUrl($c1,$c2,$c3){
    return '?c=index&c1='.$c1.'&c2='.$c2.'&c3='.$c3;
}