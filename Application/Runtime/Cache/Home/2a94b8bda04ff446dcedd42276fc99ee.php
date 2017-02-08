<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UI空间</title>
    <link rel="stylesheet" href="/Public/css/MainCss/main.css" type="text/css" />
    <link rel="stylesheet" href="/Public/css/MainCss/reset.css" type="text/css" />
    <link rel="stylesheet" href="/Public/css/MainCss/header.css" type="text/css" />
    <link href="../../../../Public/css/MainCss/reset.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="header">
	<div class="div_left">
    	<span class="header_logo fl"></span>
        <h3 class="header_title fl">UI设计</h3>
        <h3 class="header_title_red fl">空间</h3>
    </div>
    <div class="div_right">
    	<a class="heder_button fr">登录</a><p class="fr">|</p><a class="heder_button fr">注册</a>
    </div>
</div><!--header结束-->

<div class="nav fl">
	<div class="nav_top">
    	<ul>
        	<li class="nav_top_item_down nav_top_item_size"><a href="javascript:void(0)" id="item_down">资源下载</a></li>
            <li class="nav_top_item_web nav_top_item_size"><a  href="javascript:void(0)" id="item_web">灵感酷站</a></li>
            <li class="nav_top_item_collction nav_top_item_size"><a  href="javascript:void(0)" id="item_collction">我的收藏</a></li>
        </ul>
    </div>
	<div class="nav_bottom">
        <?php if(is_array($classData)): $i = 0; $__LIST__ = $classData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class_one): $mod = ($i % 2 );++$i;?><div class="nav_bottom_item ">
                <dt class="nav_bottom_item_dt">
                <h3><?php echo ($class_one["class_name"]); ?></h3>
                </dt>
                <?php if(is_array($class_one['next'])): $i = 0; $__LIST__ = $class_one['next'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class_two): $mod = ($i % 2 );++$i;?><dd class="nav_bottom_item_dd <?php echo (homeshowActive($c1,$c2,$class_one['class_id'],$class_two['class_id'])); ?>">
                        <a href="<?php echo (gethomeMenuUrl($class_one['class_id'],$class_two['class_id'])); ?>"><?php echo ($class_two["class_name"]); ?></a><span><?php echo ($class_two["content_count"]); ?></span>
                    </dd><?php endforeach; endif; else: echo "" ;endif; ?>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    
</div><!--nav结束-->

<div class="content">
	<div class="content_nav">
    	<dd>
            <?php if(is_array($s3list)): $i = 0; $__LIST__ = $s3list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s3): $mod = ($i % 2 );++$i;?><a href="<?php echo (gethomeMenuUrl($c1,$c2,$s3['class_id'])); ?>" class="content_nav_a <?php echo (homes3Active($s3['class_id'],$c3)); ?>"><?php echo ($s3["class_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </div>
	<div class="content_list">
    	<dd>
            <?php if(is_array($contentdata)): $i = 0; $__LIST__ = $contentdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="content_list_item">
                    <input style="display: none" value="<?php echo ($data["content_url"]); ?>">
                    <img src="<?php echo ($data["content_image"]); ?>" alt="">
                    <div class="content_title">
                        <div class="content_title_left fl">
                            <h4><?php echo ($data["content_name"]); ?></h4>
                        </div>
                        <div class="content_title_right fr">
                            <span class="content_title_num fr"><?php echo ($data["readcount"]); ?></span>
                            <span class="content_title_icon fr"></span>
                        </div>
                    </div>
                    <p class="content_text"><?php echo ($data["content_text"]); ?></p>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </div>
    <div class="content_page">
        <?php echo ($pageRes); ?>
    </div>
</div><!--content结束-->



<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/main/main.js"></script>

<script>
    $(".content_list_item").hover(function (e) {
        $(this).addClass("content_list_item_active");
    },function () {
        $(this).removeClass("content_list_item_active");
    });

    $(".content_list_item").click(function () {
        var url = $(this).children("input").val();
        window.open(url);
    });
</script>
<br><br><br><br><br><br>
</body>



</html>