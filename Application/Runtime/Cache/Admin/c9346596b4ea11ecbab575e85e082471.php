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
  <script src="/Public/js/kindeditor/kindeditor-all.js"></script>

  <link href="Public/distpicker/css/city-picker.css" rel="stylesheet">
  <link href="Public/distpicker/css/main.css" rel="stylesheet">
  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">

          <ol class="breadcrumb">
            <li>
              <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=content">内容管理</a>
            </li>
            <li class="active">
              <i class="fa fa-edit"></i> 编辑内容
            </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-lg-6">

          <form class="form-horizontal" id="singcms-form">
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">标题:</label>
              <div class="col-sm-5">
                <input type="text" name="content_name" class="form-control" id="inputname" placeholder="请填写标题" value="<?php echo ($contentData["content_name"]); ?>">
              </div>
            </div>



            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">分类:</label>
              <div id="distpicker" style="width: 35%; float: left;margin-left: 30px">
                <div class="form-group">
                  <div style="position: relative;">
                    <input id="class_id_old" value="<?php echo ($contentData["class_id"]); ?>" style="display: none">
                    <input id="s1" name="s1" style="display: none" value="<?php echo ($contentData["s1"]); ?>">
                    <input id="s2" name="s2" style="display: none" value="<?php echo ($contentData["s2"]); ?>">
                    <input id="s3" name="s3" style="display: none" value="<?php echo ($contentData["s3"]); ?>">
                    <input id="city-picker3" class="form-control" readonly type="text" value="" data-toggle="city-picker" name="class_id">
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-warning" id="reset" type="button">重选</button>
                  <button class="btn btn-danger" id="destroy" type="button">确认</button>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">图片:</label>
              <div class="col-sm-5">
                <input id="file_upload"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img" src="<?php echo ($contentData["content_image"]); ?>" width="150" height="150">
                <input id="file_upload_image" name="content_image" type="hidden" multiple="true" value="<?php echo ($contentData["content_image"]); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">链接地址:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="content_url" id="content_url" placeholder="请输入链接地址" value="<?php echo ($contentData["content_url"]); ?>">
              </div>
            </div>


            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">描述:</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="" id="" name="content_text" rows="5" ><?php echo ($contentData["content_text"]); ?></textarea>
              </div>
            </div>
            <input style="display: none" name="content_id" value="<?php echo ($contentData["content_id"]); ?>">

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" id="editcontent-button-submit">保存</button>
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
<script>
  var SCOPE = {
    'save_url' : '/admin.php?c=content&a=saveAdd',
    'jump_url' : '/admin.php?c=content',
    'ajax_upload_image_url' : '/admin.php?c=image&a=ajaxuploadimage',
    'ajax_upload_swf' : 'Public/js/uploadify/uploadify.swf',
  };

</script>
<!-- /#wrapper -->
<script src="Public/js/admin/image.js"></script>
<script src="Public/js/admin/extend.js"></script>
<!--<script src="Public/distpicker/js/jquery.js"></script>-->
<script src="Public/distpicker/js/bootstrap.js"></script>
<script src="Public/distpicker/js/city-picker.data.js"></script>
<script src="Public/distpicker/js/city-picker.js"></script>
<script src="Public/distpicker/js/main.js"></script>

<script>
  // 6.2
  KindEditor.ready(function(K) {
    window.editor = K.create('#editor_singcms',{
      uploadJson : '/admin.php?c=image&a=kindupload',
      afterBlur : function(){this.sync();}, //
    });
  });
</script>

<script>
  var thumb = "<?php echo ($contentData["content_image"]); ?>";
  if(thumb){
    $("#upload_org_code_img").show();
  }
</script>


<script src="/Public/js/admin/common.js"></script>



</body>

</html>