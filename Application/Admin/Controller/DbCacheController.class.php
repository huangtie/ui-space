<?php
/**
 * Created by PhpStorm.
 * User: huangtie
 * Date: 16/8/31
 * Time: 11:17
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class DbCacheController extends CommonController{

    public function dumpmysql(){
        $shell = "mysqldump -u".C("DB_USER")." ".C("DB_NAME")." > /tmp/cms";
        exec($shell);
    }
}