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
            </div>
        </div>
        <!-- End #sidebar -->
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
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box closed-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>操作日志检索</h3>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                	<form method="get" action="__URL__">
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
                        <fieldset class="column-left">
                            <p>
								<label class="left">用户帐号</label><input class="text-input medium-input" type="text" name="username" id="username" />
							</p>
                            <p>
								<label class="left">登录IP&nbsp;&nbsp;&nbsp;</label><input class="text-input medium-input" type="text" name="ip" id="ip" />
							</p>
                        </fieldset>
                        <fieldset class="column-right">
                            <p>
								<label class="left">用户ID&nbsp;&nbsp;&nbsp;</label><input class="text-input medium-input" type="text" name="userId" id="userId" />
							</p>
                        	<p>
								<label class="left">结果排序</label>
                                <select name="orderBy" id="orderBy">
                              		<option value="id" selected="selected">默认排序</option>
                              		<option value="username">用户名</option>
                              	</select>
                            	<select name="orderType" id="orderType">
                              		<option value="DESC">递减</option>
                              		<option value="ASC">递增</option>
                              	</select>
                            	<select name="pageSize" id="pageSize">
                              		<option value="20">每页显示20个</option>
                              		<option value="50">每页显示50个</option>
                              		<option value="100">每页显示100个</option>
                              	</select>
                                <input class="button" type="submit" id="submit" name="submit" value="搜索" /> <a href="__URL__" >默认</a>
							</p>
<script type="text/javascript">
/*
	设定选择值
*/
    $("#username").val('<?php echo (formatquery($_GET['username'])); ?>');
    $("#userId").val('<?php echo ($_GET['userId']); ?>');
    $("#orderType").val('<?php echo ($_GET['orderType']); ?>');
    $("#orderBy").val('<?php echo ($_GET['orderBy']); ?>');
    $("#pageSize").val('<?php echo ($_GET['pageSize']); ?>');
</script>
						</fieldset>
						<div class="clear"></div><!-- End .clear -->
					</div> <!-- End #tab1 -->
					</form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>操作日志管理</h3>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                	<form method="post" action="<?php echo U("AdminLog/doCommand");?>" id="mainForm">
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<div class="clear"></div><!-- End .clear -->
                        <table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" /></th>
								   <th>ID</th>
								   <th>操作记录</th>
                                   <th>操作IP</th>
                                   <th>操作用户</th>
								   <th>记录时间</th>
								</tr>
								
							</thead>
<?php if(isset($dataList)): ?><tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
                                        	<input class="checkAll" type="checkbox" /> 全选&nbsp;
                                            <select name="operate" id="operate">
                                            	<option value="" selected="selected">选择操作</option>
                                             	<option value="delete">删除</option>
                                          	</select> 
											<input class="button" type="submit" name="submit" value="提交操作">
										</div>
										
										<div class="pagination">
											<?php echo ($pageBar); ?>
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						 
							<tbody>
                            <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
									<td><input type="checkbox" name="id[]" id="id[]" value="<?php echo ($vo["id"]); ?>" /></td>
									<td><?php echo ($vo["id"]); ?></td>
									<td><?php echo ($vo["action"]); ?></td>
                                    <td><?php echo ($vo["ip"]); ?></td>
									<td><?php echo ($vo["username"]); ?></td>
                                    <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<?php else: ?>
							<tbody>
                                <tr>
                                	<td colspan="6"><p class="no">暂无数据</p></td>
                                </tr><?php endif; ?>
							</tbody>
						</table>
					</div> <!-- End #tab1 -->
					</form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
			<div class="clear"></div><!-- End .clear -->
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