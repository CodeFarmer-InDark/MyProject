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
			<div class="content-box "><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>会员检索</h3>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
					<form method="get" action="__URL__">
						<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
							<fieldset class="column-left">
								<p>
									<label class="left">用户名</label><input class="text-input medium-input" type="text" name="username" id="username" />
								</p>
								<p>
									<label class="left">用户组</label>
									<select name="roleId" id="roleId">
										<option value="0">--</option>
										<!--<option value="1">超级管理</option>-->
										<!--<option value="2">禁止访问</option>-->
										<!--<option value="3">普通管理</option>-->
										<!--<option value="10">学生用户</option>-->
										<!--<option value="11">企业用户</option>-->
										<?php if(is_array($roleList)): $i = 0; $__LIST__ = $roleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$roleVo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($roleVo["id"]); ?>" <?php echo (selected($roleVo["id"],$vo['role_id'])); ?>><?php echo ($roleVo["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</p>
							</fieldset>
							<fieldset class="column-right">
								<p>
									<label class="left">注册日期</label><input class="text-input small-input Wdate" type="text" name="createTime" id="createTime"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',isShowClear:false,readOnly:true,isShowToday:false})" value="" /> - <input class="text-input small-input Wdate" type="text" name="createTime1" id="createTime1"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',isShowClear:false,readOnly:true,isShowToday:true})" value="" />
								</p>
								<p>
									<label class="left">审核状态</label>
									<select name="status" id="status">
										<option value="0" selected>全部</option>
										<option value="1">待审核</option>
										<option value="2">已审核</option>
									</select>
									<input class="button" type="submit" id="submit" name="submit" value="搜索" /> <a href="__URL__" >默认</a>
								</p>
								<script type="text/javascript">
									/*
									 设定选择值
									 */
									$("#username").val('<?php echo ($_GET['username']); ?>');
									$("#roleId").val('<?php echo ($_GET['roleId']); ?>');
									$("#createTime").val('<?php echo ($_GET['createTime']); ?>');
									$("#createTime1").val('<?php echo ($_GET['createTime1']); ?>');
									$("#status").val('<?php echo ($_GET['status']); ?>');
								</script>
							</fieldset>
							<div class="clear"></div><!-- End .clear -->
						</div> <!-- End #tab1 -->
					</form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
			<!-- Page Head -->
			<ul class="shortcut-buttons-set">
				
                <li><a class="shortcut-button" href="<?php echo U("User/insert");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/user_add_48.png" alt="icon" /><br />
					添加会员
				</span></a></li>
                <li><a class="shortcut-button" href="<?php echo U("Role/index");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/users_two_48.png" alt="icon" /><br />
					会员组管理
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>会员管理</h3>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
                    <form method="post" action="<?php echo U("User/doCommand");?>">
						<table>
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" id="chkall" name="chkall" value="<?php echo ($vo["id"]); ?>"></th>
                                   <th>ID</th>
								   <th>用户名</th>
								   <th>真实姓名</th>
								   <th>类型</th>
								   <th>录入时间</th>
                                   <th>操作</th>
								</tr>
							</thead>
<?php if(isset($dataList)): ?><tfoot>
								<tr>
									<td colspan="7">
										<div class="bulk-actions align-left">
											<select name="operate" id="operate">
												<option value="update" selected="selected">更新</option>
											</select>
                                            <input class="button" type="submit" name="submit" value="应用">
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
									<td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"></td>
									<td><?php echo ($vo["id"]); ?><input name="updateid[]" type="hidden" id="updateid[]" value="<?php echo ($vo["id"]); ?>" /></td>
									<td><strong><?php echo ($vo["username"]); ?></strong></td>
									<td><input name="realname[]" type="text" id="title[]" title="<?php echo ($vo["realname"]); ?>" value="<?php echo ($vo["realname"]); ?>" size="25"/></td>
                                    <td><?php echo ($vo["role_name"]); ?></td>
                                    <td><?php echo (date("Y-m-d",$vo["create_time"])); ?></td>
									<td>
										<!-- Icons -->
										 <a href="<?php echo U("User/modify",array('id'=>$vo['id']));?>" title="编辑"><img src="__PUBLIC__/Admin/Images/icons/pencil.png" alt="编辑" /></a>
									<?php if(($vo['id']) != "1"): ?><a href="<?php echo U("User/doCommand",array('operate'=>'delete','id'=>$vo['id']));?>" title="删除"><img src="__PUBLIC__/Admin/Images/icons/cross.png" alt="删除" /></a><?php endif; ?>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<?php else: ?>
							<tbody>
                                <tr>
                                	<td colspan="7"><p class="no">暂无数据</p></td>
                                </tr><?php endif; ?>

							</tbody>
							
						</table>
                    </form>
					</div> <!-- End #tab1 -->
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