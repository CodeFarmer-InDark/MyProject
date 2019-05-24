<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>新城网络企业网站管理平台</title>
		<!--                       CSS                       -->
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/reset.css" type="text/css" media="screen" />
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/style.css" type="text/css" media="screen" />
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/invalid.css" type="text/css" media="screen" />
        <!-- Colorpicker Stylesheet -->
        <link rel="stylesheet" href="__PUBLIC__/Admin/scripts/colorpicker/colorpicker.css" type="text/css" media="screen" />
        <!-- UEditor Stylesheet -->
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Js/ueditor/themes/default/css/ueditor.css" media="screen" />
		<!-- Colour Schemes
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/blue.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/red.css" type="text/css" media="screen" />  
		-->
		<!-- Internet Explorer Fixes Stylesheet -->
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="__PUBLIC__/Admin/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		<!--                       Javascripts                       -->
        <!-- UEditor -->
        <script type="text/javascript" src="__PUBLIC__/Js/ueditor/ueditor.config.js"></script>
    	<script type="text/javascript" src="__PUBLIC__/Js/ueditor/ueditor.all.js"></script>
        <!-- WdatePicker -->
        <script type="text/javascript" src="__PUBLIC__/Js/My97DatePicker/WdatePicker.js"></script>
        <!-- ColorPicker -->
        <script type="text/javascript" src="__PUBLIC__/Js/colorpicker/colorpicker.js"></script>
		<!-- jQuery -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery-1.3.2.min.js"></script>
        <!-- jQuery Validation -->
        <script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.validate.js"></script>
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/simpla.jquery.configuration.js"></script>
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/facebox.js"></script>
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.wysiwyg.js"></script>
		<!-- jQuery Datepicker Plugin -->
		<!-- script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.datePicker.js"></script -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.date.js"></script>
		<!--[if IE]><script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.bgiframe.js"></script><![endif]-->
		<!-- Internet Explorer .png-fix -->
		<!--[if IE 6]>
			<script type="text/javascript" src="__PUBLIC__/Admin/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>

		<![endif]-->
	</head>
<body>
	<div id="body-wrapper">
<!-- Wrapper for the radial gradient background -->
<div id="sidebar">
        <div id="sidebar-wrapper">
            <!-- Sidebar with logo and menu -->
            <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="__PUBLIC__/Admin/Images/logo.png" alt="logo" /></a>
            <!-- Sidebar Profile links -->
            <div id="profile-links" style="color: #fff">你好，<?php echo ($username); ?><br /><br /><a href="<?php echo ($frontUrl); ?>" target="_blank" title="浏览网站">浏览网站</a> | <a href="<?php echo U('Public/logout');?>" title="退出系统">退出系统</a></div>

            <ul id="main-nav">  <!-- Accordion Menu -->
                <li>
                    <a href='<?php echo U("Index/index");?>' class='nav-top-item no-submenu <?php if($moduleName == Index ): ?>current<?php endif; ?>'><!-- Add the class "no-submenu" to menu items with no sub menu -->系统首页</a>
                </li>
                <!--<li>
                    <a href="#" class="nav-top-item current">--><!-- Add the class "current" to current menu item --><!--Articles</a>
                    <ul>
                        <li><a href="#">Write a new Article</a></li>
                        <li><a class="current" href="#">Manage Articles</a></li>--> <!-- Add class "current" to sub menu items also -->
                <!--<li><a href="#">Manage Comments</a></li>
                <li><a href="#">Manage Categories</a></li>
            </ul>
        </li>-->
                <li>
                    <a href="#" class='nav-top-item <?php if(($moduleName == Config) OR ($moduleName == Category) OR ($moduleName == Type) OR ($moduleName == User) OR ($moduleName == Role) OR ($moduleName == Link) OR ($moduleName == Batch) OR ($moduleName == Adv) OR ($moduleName == Picture)): ?>current<?php endif; ?>'>基本设置</a>
                    <ul>
                        <li class="Config"><a href="<?php echo U("Config/index");?>" <?php if(($moduleName == 'Config')): ?>class="current"<?php endif; ?>>系统配置</a></li>
                        <li class="User"><a href="<?php echo U("User/index");?>" <?php if(($moduleName == 'User') OR ($moduleName == 'Role')): ?>class="current"<?php endif; ?>>管理员管理</a></li>
                        <!--<li class="Link"><a href="<?php echo U("Link/index");?>" <?php if(($moduleName == 'Link')): ?>class="current"<?php endif; ?>>友情链接管理</a></li>-->
                        <!--<li class="Category"><a href="<?php echo U("Category/index");?>" <?php if(($moduleName == 'Category')): ?>class="current"<?php endif; ?>>分类管理</a></li>-->
                        <!-- li class="Role"><a href="<?php echo U("Role/index");?>" <?php if(($moduleName == 'Role')): ?>class="current"<?php endif; ?>>角色管理</a></li -->
                        <li class="Type"><a href="<?php echo U('Type/index');?>" <?php if(($moduleName == Type)): ?>class="current"<?php endif; ?>'>招生类型管理</a></li>
                        <li class="adv"><a href="<?php echo U('Adv/index');?>" <?php if(($moduleName == Adv)): ?>class="current"<?php endif; ?>'>首页上部幻灯</a></li>
                        <li class="Picture"><a href="<?php echo U('Picture/index');?>" <?php if(($moduleName == Picture)): ?>class="current"<?php endif; ?>'>首页下部幻灯</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo U("AdminLog/index");?>"class='nav-top-item no-submenu <?php if(($moduleName == AdminLog) ): ?>current<?php endif; ?>'>操作日志  </a>
                    <!-- <ul>
                         &lt;!&ndash;<li class="Core"><a href="<?php echo U("Core/index");?>"<?php if(($moduleName == 'Core')): ?>class="current"<?php endif; ?>>内核配置 </a></li>&ndash;&gt;
                            <li class="AdminLog"><a href="<?php echo U("AdminLog/index");?>"<?php if(($moduleName == 'AdminLog')): ?>class="current"<?php endif; ?>>操作日志  </a></li>
                         </ul>-->
                </li>
                <li>
                    <a href="<?php echo U('Page/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Page) ): ?>current<?php endif; ?>'>单网页综合管理</a>
                </li>
                <li>
                    <a href="<?php echo U('News/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == News) ): ?>current<?php endif; ?>'>文章管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Consult/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Consult) ): ?>current<?php endif; ?>'>考生问答管理</a>
                </li>
                <li>
                    <a href="#" class='nav-top-item no-submenu <?php if(($moduleName == College) OR ($moduleName == Major)): ?>current<?php endif; ?>'>院系管理</a>
                    <ul>
                        <li class="College"><a href="<?php echo U("College/index");?>" <?php if(($moduleName == 'College')): ?>class="current"<?php endif; ?>>院系设置管理</a></li>
                        <li class="Major"><a href="<?php echo U("Major/index");?>" <?php if(($moduleName == 'Major')): ?>class="current"<?php endif; ?>>专业一览管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo U('Video/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Video)): ?>current<?php endif; ?>'>视频管理</a>
                </li>
                <li>
                    <a href="#" class='nav-top-item no-submenu <?php if(($moduleName == Score) OR ($moduleName == Subject)): ?>current<?php endif; ?>'>查询管理</a>
                    <ul>
                       <li class="Plan"><a href="<?php echo U("Plan/index");?>" <?php if(($moduleName == 'Plan')): ?>class="current"<?php endif; ?>>招生计划管理</a></li>
                        <li class="Subject"><a href="<?php echo U("Subject/index");?>" <?php if(($moduleName == 'Subject')): ?>class="current"<?php endif; ?>>选考科目管理</a></li>
                        <!-- <li class="Score"><a href="<?php echo U("Score/index");?>" <?php if(($moduleName == 'Score')): ?>class="current"<?php endif; ?>>历年分数管理</a></li> -->
                        <li class="Score"><a href="http://localhost/job/cauc_zs3/lqgl/sun/admin.php/Score/index.html">历年分数管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo U('Life/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Life)): ?>current<?php endif; ?>'>美丽校园图集管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Remark/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Remark)): ?>current<?php endif; ?>'>录取备注管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Register/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Register)): ?>current<?php endif; ?>'>中欧报名管理</a>
                </li>
            </ul>
            <!-- End #main-nav -->
        </div>
    </div>
    <!-- End #sidebar -->
		<div id="main-content" class="index">
        <!-- Main Content Section with everything -->
			<noscript>
            <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
					<div>
						您的浏览器不支持Javascript或者已经禁用了Javascript。请升级您的浏览器或者启用Javascript支持才能正确浏览页面。在您升级您的浏览器或启用Javascript之前，您仍可正常地对您的系统进行管理，但某些高级功能将失效。<a href="http://www.google.com/support/bin/answer.py?answer=23852" title="如何启用 JavaScript" target="_blank">如何启用？</a>
					</div>
				</div>
			</noscript>
			<!-- Page Head -->
			<h2>欢迎回来 <?php echo ($realName); ?></h2>
			<!--<p id="page-intro">您可以进行如下快捷操作：</p>-->
			<ul class="shortcut-buttons-set">
				<li>
                	<!--<a class="shortcut-button" href="<?php echo U("News/index");?>"><span><img src="__PUBLIC__/Admin/Images/icons/paper_content_pencil_48.png" alt="icon" /><br />天津城建大学<br/>材料科学与工程学院动态管理</span></a>-->
                </li>

			</ul>
            <!-- End .shortcut-buttons-set -->
			<div class="clear"></div>
            <!-- End .clear -->
            <div class="content-box column-left">
				<div class="content-box-header">
                <!-- Add the class "closed" to the Content box header to have it closed by default -->
					<h3>个人信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
                    	<p>用户名：<?php echo ($username); ?></p>
                        <p>所属用户组：<?php echo ($roleName); ?></p>
                        <p>最后登录时间：<?php echo (date("Y.m.d H:i:s",$user['last_login_time'])); ?></p>
                        <p>登录次数：<?php echo ($user['login_count']); ?></p>
					</div>
                    <!-- End #tab3 -->
				</div>
                <!-- End .content-box-content -->
			</div>
            <!-- End .content-box -->
			<div class="content-box column-right">
				<div class="content-box-header">
					<h3>系统信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
						<p>系统版本：<?php echo C('SYS_VERSION');?> build<?php echo C('SYS_UPDATETIME');?></p>
                        <p>程序开发：sffy，mchunt，yel_hb</p>
                        <p>页面设计：晓风残月</p>
                        <p>官方网站：<a href="http://www.y-city.net.cn" target="_blank">http://www.y-city.net.cn</a></p>
					</div>
                    <!-- End #tab3 -->        
				</div>
                <!-- End .content-box-content -->
			</div>
            <!-- End .content-box -->
            <div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box">
				<div class="content-box-header">
                <!-- Add the class "closed" to the Content box header to have it closed by default -->
					<h3>服务器信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
                        <p>主机域名: <?php echo ($serverUri); ?></p>
                        <p>运行环境: <?php echo ($serverSoft); ?></p>
                        <p>MySQL版本: <?php echo ($mysqlVersion); ?></p>
                        <p>PHP版本: <?php echo ($phpVersion); ?></p>
                        <!-- p>全局变量: <?php echo ($phpGpc); ?></p -->
                        <p>附件上传限制: <?php echo ($phpUploadSize); ?></p>
                        <!-- p>最大执行时间: <?php echo ($maxExcuteTime); ?></p>
                        <p>最大使用内存: <?php echo ($maxExcuteMemory); ?></p>
                        <p>当前使用内存: <?php echo ($excuteUseMemory); ?></p -->
					</div>
                    <!-- End #tab3 -->        
				</div>
                <!-- End .content-box-content -->			</div>
            <!-- End .content-box -->
			<div class="clear"></div>
		</div>
        <!-- End #main-content -->
	</div>
	<div id="footer">
		<small> <!-- Remove this notice or replace it with whatever you want -->
				&#169;&nbsp;Copyright&nbsp;<?php echo(date('Y'));?>&nbsp;<a href="http://www.qeeyang.com" target="_blank">Qeeyang Technology Co.,Ltd.</a> | Powered by <a href="http://www.y-city.net.cn" target="_blank">Y-city</a>
		</small>
	</div>
    <!-- End #footer -->
</body>
</html>