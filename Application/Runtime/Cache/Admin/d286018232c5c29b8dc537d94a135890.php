<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=menu">菜单管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> 添加
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-6">

                    <form class="form-horizontal" id="singcms-form">
                        <div class="form-group <?php echo (isHideParent($type)); ?>">
                            <label for="inputname" class="col-sm-2 control-label">上级分类:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="parent_id">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($parentdata)): foreach($parentdata as $key=>$data): ?><option value="<?php echo ($data["class_id"]); ?>"><?php echo ($data["class_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputname" class="col-sm-2 control-label">分类名:</label>
                            <div class="col-sm-5">
                                <input type="text" name="class_name" class="form-control" id="inputname" placeholder="请填写分类名">
                            </div>
                        </div>
                        <input type="hidden" name="type" id="type_id" value="<?php echo ($type); ?>">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default" id="button-addclass-submit">提交</button>
                            </div>
                        </div>
                    </form>


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
<script src="public/js/admin/common.js"></script>
<script src="public/js/admin/extend.js"></script>
<script src="public/css/MainCss/main.css"></script>
<script>

    var SCOPE = {
        'save_url' : '/admin.php?c=class&a=saveAdd',
        'jump_url' : '/admin.php?c=class',
    }
</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>