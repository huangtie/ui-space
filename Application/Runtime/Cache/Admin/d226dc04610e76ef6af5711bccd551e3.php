<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/Public/css/sing/common.css" />
    <link rel="stylesheet" href="/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/dialog/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/Public/js/uploadify/jquery.uploadify.js"></script>

</head>

    



<body>

<div id="wrapper">

    <?php
 $navs = D('Menu')->getAdminMenu(); $index = 'index'; ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getActive($index)); ?>>
        <a href="/admin.php?c=index"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($nav['c'],$nav["f"])); ?>>
          <a href="<?php echo (getMenuUrl($nav)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($nav["name"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>


    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>

    <div id="page-wrapper">

        <div class="container-fluid" >

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=menu">菜单管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i><?php echo ($nav); ?>
                        </li>
                    </ol>
                </div>
            </div>
            <div>

                <button  id="button-add-class" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
                <input type="hidden" id="type" value="<?php echo ($type); ?>"/>
            </div>
            <div class="row <?php echo (isHideParent($type)); ?>">
                <br>
                <form id="screenfrom">

                    <div class="input-group" style="width: 50%; float: left; margin-left: 15px;">
                        <select class="" id="parentselect" name="parent_id" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;border-radius: 1px;background-image: none;">
                            <option value='' >全部</option>
                            <?php if(is_array($parentdata)): foreach($parentdata as $key=>$data): ?><option value="<?php echo ($data["class_id"]); ?>" <?php if($data['class_id'] == $parent_id): ?>selected="selected"<?php endif; ?>><?php echo ($data["class_name"]); ?></option><?php endforeach; endif; ?>

                        </select>
                    </div>

                  <button id="class_screen_btn" type="button" class="btn btn-primary" style="margin-left: 10px; width: 100px;"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3></h3>
                    <div class="table-responsive">
                        <form id="singcms-listorder">
                            <table class="table table-bordered table-hover singcms-table">
                                <thead>
                                <tr>
                                    <th width="14">排序</th>
                                    <th>id</th>
                                    <th>分类名</th>
                                    <th>上级分类</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($classList)): $i = 0; $__LIST__ = $classList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?><tr>
                                        <td><input size="4" type="text" name="listorder[<?php echo ($class["class_id"]); ?>]" value="<?php echo ($class["listorder"]); ?>"/></td>
                                        <td><?php echo ($class["class_id"]); ?></td>
                                        <td><?php echo ($class["class_name"]); ?></td>
                                        <td><?php echo ($class["class_parent_name"]); ?></td>
                                        <td><span  attr-status="<?php if($class['status'] == 1): ?>0<?php else: ?>1<?php endif; ?>"  attr-id="<?php echo ($class["class_id"]); ?>" class="sing_cursor singcms-on-off" id="singcms-on-off-class" ><?php echo (getMenuStatus($class["status"])); ?></span></td>
                                        <td><span class="glyphicon glyphicon-edit" aria-hidden="true" id="singcms-class-edit" attr-id="<?php echo ($class["class_id"]); ?>"></span>    <a href="javascript:void(0)" attr-id="<?php echo ($class["class_id"]); ?>" id="singcms-class-delete"  attr-a="class" attr-message="删除"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                </tbody>
                            </table>
                        </form>
                        <nav>
                            <ul class="pagination">
                                <?php echo ($pageRes); ?>
                            </ul>
                        </nav>
                        <div>
                            <button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus glyphicon-refresh" aria-hidden="true"></span>更新排序 </button>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script src="/Public/js/admin/common.js"></script>
<script src="/Public/js/admin/extend.js"></script>
<script>

    var SCOPE = {
        'add_url' : '/admin.php?c=class&a=add',
        'edit_url' : '/admin.php?c=class&a=edit',
        'set_status_url' : '/admin.php?c=class&a=setStatus',
        'listorder_url' : '/admin.php?c=class&a=listorder',
        'jump_url' : '/admin.php?c=class',
    }
</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>