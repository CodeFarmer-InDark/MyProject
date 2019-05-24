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
        <script type="text/javascript" src="__PUBLIC__/Js/My97DatePicker/WdatePicker.js"/></script>
        <!-- ColorPicker -->
        <script type="text/javascript" src="__PUBLIC__/Js/colorpicker/colorpicker.js"/></script>
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
                        <a href="#" class='nav-top-item <?php if(($moduleName == Config) OR ($moduleName == Category) OR ($moduleName == User) OR ($moduleName == Role) OR ($moduleName == Link) OR ($moduleName == Adv)): ?>current<?php endif; ?>'>基本设置</a>
                        <ul>
                            <li class="Config"><a href="<?php echo U("Config/index");?>" <?php if(($moduleName == 'Config')): ?>class="current"<?php endif; ?>>系统配置</a></li>
                            <li class="User"><a href="<?php echo U("User/index");?>" <?php if(($moduleName == 'User') OR ($moduleName == 'Role')): ?>class="current"<?php endif; ?>>管理员管理</a></li>
                            <li class="Link"><a href="<?php echo U("Link/index");?>" <?php if(($moduleName == 'Link')): ?>class="current"<?php endif; ?>>友情链接管理</a></li>
                            <!--li class="Category"><a href="<?php echo U("Category/index");?>" <?php if(($moduleName == 'Category')): ?>class="current"<?php endif; ?>>分类管理</a></li>
                            <!-- li class="Role"><a href="<?php echo U("Role/index");?>" <?php if(($moduleName == 'Role')): ?>class="current"<?php endif; ?>>角色管理</a></li -->
                          <li class="adv"><a href="<?php echo U('Adv/index');?>" <?php if(($moduleName == Adv)): ?>class="current"<?php endif; ?>'>首页幻灯</a></li>
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
                        <a href="<?php echo U('News/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == News) ): ?>current<?php endif; ?>'>内容管理</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Download/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Download)): ?>current<?php endif; ?>'>下载管理</a>
                    </li>
                </ul>
                <!-- End #main-nav -->

                <!--<ul id="main-nav">  &lt;!&ndash; Accordion Menu &ndash;&gt;-->
                    <!--&lt;!&ndash;<?php if($prower == 'all'): ?>&ndash;&gt;-->
                    <!--<li>-->
                        <!--<a href='<?php echo U("Index/index");?>' class='nav-top-item no-submenu <?php if($moduleName == Index ): ?>current<?php endif; ?>'>&lt;!&ndash; Add the class "no-submenu" to menu items with no sub menu &ndash;&gt;系统首页</a>-->
                    <!--</li>-->
                    <!--&lt;!&ndash;<li>-->
                        <!--<a href="#" class="nav-top-item current">&ndash;&gt;&lt;!&ndash; Add the class "current" to current menu item &ndash;&gt;&lt;!&ndash;Articles</a>-->
                        <!--<ul>-->
                            <!--<li><a href="#">Write a new Article</a></li>-->
                            <!--<li><a class="current" href="#">Manage Articles</a></li>&ndash;&gt; &lt;!&ndash; Add class "current" to sub menu items also &ndash;&gt;-->
                            <!--&lt;!&ndash;<li><a href="#">Manage Comments</a></li>-->
                            <!--<li><a href="#">Manage Categories</a></li>-->
                        <!--</ul>-->
                    <!--</li>&ndash;&gt;-->
                    <!--<li>-->
                        <!--<a href="#" class='nav-top-item <?php if(($moduleName == Config) OR ($moduleName == Category) OR ($moduleName == User) OR ($moduleName == Role) OR ($moduleName == Link)): ?>current<?php endif; ?>'>基本设置</a>-->
                        <!--<ul>-->
                            <!--<li class="Config"><a href="<?php echo U("Config/index");?>" <?php if(($moduleName == 'Config')): ?>class="current"<?php endif; ?>>系统配置</a></li>-->
                            <!--<li class="User"><a href="<?php echo U("User/index");?>" <?php if(($moduleName == 'User') OR ($moduleName == 'Role')): ?>class="current"<?php endif; ?>>管理员管理</a></li>-->
                            <!--<li class="Link"><a href="<?php echo U("Link/index");?>" <?php if(($moduleName == 'Link')): ?>class="current"<?php endif; ?>>友情链接管理</a></li>-->
                            <!--&lt;!&ndash;li class="Category"><a href="<?php echo U("Category/index");?>" <?php if(($moduleName == 'Category')): ?>class="current"<?php endif; ?>>分类管理</a></li>-->
                            <!--&lt;!&ndash; li class="Role"><a href="<?php echo U("Role/index");?>" <?php if(($moduleName == 'Role')): ?>class="current"<?php endif; ?>>角色管理</a></li &ndash;&gt;-->
                        <!--</ul>-->
                    <!--</li>-->
                    <!--<li>-->
                        <!--<a href="<?php echo U("AdminLog/index");?>"class='nav-top-item no-submenu <?php if(($moduleName == AdminLog) ): ?>current<?php endif; ?>'>操作日志  </a>-->
<!--&lt;!&ndash;                        <ul>-->
                        	<!--&lt;!&ndash;<li class="Core"><a href="<?php echo U("Core/index");?>"<?php if(($moduleName == 'Core')): ?>class="current"<?php endif; ?>>内核配置 </a></li>&ndash;&gt;-->
                            <!--<li class="AdminLog"><a href="<?php echo U("AdminLog/index");?>"<?php if(($moduleName == 'AdminLog')): ?>class="current"<?php endif; ?>>操作日志  </a></li>-->
						<!--</ul>&ndash;&gt;-->
                    <!--</li>-->
                    <!--<li>-->
                        <!--<a href="<?php echo U('Page/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Page) ): ?>current<?php endif; ?>'>机构设置管理</a>-->
                    <!--</li>-->

                    <!--<li>-->
                        <!--<a href="<?php echo U('News/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == News) ): ?>current<?php endif; ?>'>内容管理</a>-->
                    <!--</li>-->
                    <!--<li>-->
                        <!--<a href="<?php echo U('Download/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Download)): ?>current<?php endif; ?>'>下载管理</a>-->
                    <!--</li>-->

                    <!--&lt;!&ndash;<li>&ndash;&gt;-->
                        <!--&lt;!&ndash;<a href="<?php echo U('Course/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Course)): ?>current<?php endif; ?>'>优秀课程管理</a>&ndash;&gt;-->
                    <!--&lt;!&ndash;</li>&ndash;&gt;-->
<!--&lt;!&ndash;                    <li>-->
                        <!--<a href="<?php echo U('Download/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Download)): ?>current<?php endif; ?>'>下载管理</a>-->
                    <!--</li>&ndash;&gt;-->
                    <!--<li>-->
                        <!--<a href="<?php echo U('Adv/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Adv)): ?>current<?php endif; ?>'>首页幻灯</a>-->
                    <!--</li>-->
                    <!--&lt;!&ndash;<?php else: ?>&ndash;&gt;-->
                    <!--&lt;!&ndash;<?php if(strstr($prower,'新闻管理') or strstr($prower,'学生工作') or strstr($prower,'师资队伍') or strstr($prower,'研究生培养') or strstr($prower,'科学研究') or strstr($prower,'本科教学') or strstr($prower,'机构设置')): ?>&ndash;&gt;-->
                        <!--&lt;!&ndash;<li>&ndash;&gt;-->
                            <!--&lt;!&ndash;<a href="<?php echo U('News/index');?>" class='nav-top-item no-submenu <if condition="($moduleName eq News)">current<?php endif; ?>'>内容管理</a>&ndash;&gt;-->
                        <!--&lt;!&ndash;</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<?php endif; ?>&ndash;&gt;-->

                    <!--&lt;!&ndash;<?php if(strstr($prower,'优秀课程管理')): ?>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li>&ndash;&gt;-->
                        <!--&lt;!&ndash;<a href="<?php echo U('Course/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Course)): ?>current<?php endif; ?>'>优秀课程管理</a>&ndash;&gt;-->
                    <!--&lt;!&ndash;</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<?php endif; ?>&ndash;&gt;-->

                    <!--&lt;!&ndash;<?php if(strstr($prower,'首页幻灯')): ?>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li>&ndash;&gt;-->
                        <!--&lt;!&ndash;<a href="<?php echo U('Adv/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Adv)): ?>current<?php endif; ?>'>首页幻灯</a>&ndash;&gt;-->
                    <!--&lt;!&ndash;</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<?php endif; ?>&ndash;&gt;-->

                    <!--&lt;!&ndash;<?php if(strstr($prower,'学院介绍管理')): ?>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li>&ndash;&gt;-->
                        <!--&lt;!&ndash;<a href="<?php echo U('Page/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Page) ): ?>current<?php endif; ?>'>学院介绍管理</a>&ndash;&gt;-->
                    <!--&lt;!&ndash;</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<?php endif; ?>&ndash;&gt;-->

                    <!--&lt;!&ndash;</if>&ndash;&gt;-->
                <!--</ul>-->
            </div>
        </div>
        <!-- End #sidebar -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#mainFrom").validate({
            rules: {
                title: "required",
                content: "required",
            },
            messages: {
                title: "标题必须填写",
                content: "内容必须填写",
            }
        });
        colorPicker();
    });
</script>
		<div id="main-content">
        <!-- Main Content Section with everything -->
			<noscript>
            <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
					<div>
						您的浏览器不支持Javascript或者已经禁用了Javascript。请升级您的浏览器或者<a href="http://www.google.com/support/bin/answer.py?answer=23852" title="如何启用 JavaScript">启用</a>Javascript支持才能正确浏览页面.
					</div>
				</div>
			</noscript>
			<!-- Page Head -->
			<ul class="shortcut-buttons-set">
				
                <li><a class="shortcut-button" href="<?php echo U("News/index");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/arrow_left_48.png" alt="icon" /><br />
					返回列表
				</span></a></li>
                <li><a class="shortcut-button" href="<?php echo U("News/insert");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/add_48.png" alt="icon" /><br />
					添加
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>内容管理</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">基本信息</a></li> <!-- href must be unique and match the id of target div -->
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                    <form method="post" action="<?php echo U("News/doModify");?>" id="mainFrom" enctype="multipart/form-data">
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<fieldset class="column-left"> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<p>
								<label>标题</label>
								<input class="text-input large-input" type="text" name="title" id="title" value="<?php echo ($vo["title"]); ?>" />
							</p>
                            <p>
								<label>新闻类别</label>
								<select name="category_id" id="select">
                         			<option value="<?php echo ($type['id']); ?>" selected="selected"><?php echo ($type['title']); ?></option>
                                    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["description"]); ?>-<?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            	</select>
							</p>
                            <p>
                                <label>链接</label>
                                <input class="text-input large-input" type="text" name="link_url" id="link_url" value="<?php echo ($vo["link_url"]); ?>" />
                            </p>
                            <p>
                                    <label>附件</label>
                                    <input class="medium-input" type="file" name="attach_file" id="attach_file" /><?php if(($vo['attach_file']) != ""): ?><a href="__ROOT__/<?php echo ($UPLOADS); echo ($vo["attach_file"]); ?>" target="_blank"><img src="__PUBLIC__/Admin/Images/icons/image.png" align="absmiddle" /></a>　<input name="deleteFile" type="checkbox" value="1" />删除附件
                                    <br /><small style="color:#f00">已经上传附件，若不更换则不必重新选择附件</small><?php endif; ?>
                            </p>
                            </if>
                            <p>
                                <label>录入时间</label>
                                <input class="text-input Wdate" type="text" name="create_time" id="create_time" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',isShowClear:false,readOnly:true,isShowToday:true})"  value="<?php echo (date("Y-m-d",$vo["create_time"])); ?>"/>
                            </p>
                        </fieldset>

                        <div class="clear"></div><!-- End .clear -->
                        <fieldset>
                            <p>
                                <label>基本内容</label>
                                <!-- <textarea class="text-input textarea" name="content" id="content" cols="79" rows="4"><?php echo ($vo["content"]); ?></textarea> -->
                                <script type="text/javascript">
									// var editor = new baidu.editor.ui.Editor({
									// 	UEDITOR_HOME_URL:'__PUBLIC__/Js/ueditor/',
									// 	iframeCssUrl :'__PUBLIC__/Js/ueditor/themes/default/iframe.css',
									// 	textarea:'content',
									// 	initialContent:''
									// });
									// editor.render('content');
								</script>
                                <script type="text/plain" id="content" name="content" style="height:400px;">
                                    <?php echo ($vo["content"]); ?>
                                </script>
                                <script type="text/javascript">
                                    var ue = UE.getEditor('content');
                                </script>
                            </p>
							<p>
                                <input name="id" type="hidden" id="id" value="<?php echo ($vo["id"]); ?>" />
                                <input name="old_file" type="hidden" id="old_file" value="<?php echo ($vo["attach_file"]); ?>" />
                                <input class="button" type="submit" name="submit" value="提交更新"/>
                                <input class="button" type="reset" name="button" id="button" value="还原重填"/>
							</p>
                        </fieldset>
                    </div> <!-- End #tab1 --><!-- End #tab2 -->
                    </form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
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