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
                    <!--<li>-->
                        <!--<a href="<?php echo U('Teacher/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Teacher)): ?>current<?php endif; ?>'>教师管理</a>-->
                    <!--</li>-->
                    <li>
                        <a href="<?php echo U('Download/index');?>" class='nav-top-item no-submenu <?php if(($moduleName == Download)): ?>current<?php endif; ?>'>下载管理</a>
                    </li>
                </ul>
                <!-- End #main-nav -->
            </div>
        </div>
        <!-- End #sidebar -->
<script type="text/javascript">
    function style_show(theobj) {
        var styles, key;
        styles = new Array('move');
        for (key in styles) {
            var obj = $doc('style_' + styles[key]);
            obj.style.display = styles[key] == theobj.options[theobj.selectedIndex].value ? '': 'none';
        }
    }
	function $doc(id){
		return document.getElementById(id);
	};
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
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box "><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>下载检索</h3>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                	<form method="get" action="__URL__">
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
                        <fieldset class="column-left">
                            <p>
								<label class="left">标　　题</label><input class="text-input medium-input" type="text" name="title" id="title" />
							</p>
                            <p>
                            	<input class="button" type="submit" id="submit" name="submit" value="搜索" /> <a href="__URL__" >默认</a>
                            </p>
                        </fieldset>
                        <fieldset class="column-right">
                        	<p>
								<label class="left">所属分类</label>
                                <select name="categoryId" id="categoryId">
                              		<option value="0">--</option>
									><?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                              	</select>
							</p>
<script type="text/javascript">
/*
	设定选择值
*/
	$("#title").val('<?php echo ($_GET['title']); ?>');
	$("#categoryId").val('<?php echo ($_GET['categoryId']); ?>');
	$("#userId").val('<?php echo ($_GET['userId']); ?>');
	$("#createTime").val('<?php echo ($_GET['createTime']); ?>');
	$("#createTime1").val('<?php echo ($_GET['createTime1']); ?>');
	$("#recommend").val('<?php echo ($_GET['recommend']); ?>');
	$("#status").val('<?php echo ($_GET['status']); ?>');
	$("#istop").val('<?php echo ($_GET['istop']); ?>');
	$("#viewCount").val('<?php echo ($_GET['viewCount']); ?>');
	$("#viewCount1").val('<?php echo ($_GET['viewCount1']); ?>');
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
			<ul class="shortcut-buttons-set">
				
                <li><a class="shortcut-button" href="<?php echo U("Download/insert");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/add_48.png" alt="icon" /><br />
					添加下载
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
            <div class="clear"></div><!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>下载管理</h3>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                	<form method="post" action="<?php echo U("Download/doCommand");?>" id="mainFrom">
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<div class="clear"></div><!-- End .clear -->
                        <table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" /></th>
								   <th>ID</th>
								   <th>标题</th>
                                   <th></th>
								   <th>类别</th>
                                   <th>排序</th>
								   <th>录入时间</th>
								   <th>操作</th>
								</tr>
								
							</thead>
<?php if(isset($dataList)): ?><tfoot>
								<tr>
									<td colspan="8">
										<div class="bulk-actions align-left">
                                            <select name="operate" id="operate" onchange="style_show(this)">
                                            	<option value="update" selected="selected">更新</option>
                                            	<option value="setTop">置顶</option>
                                            	<option value="unSetTop">取消置顶</option>
                                            	<option value="recommend">推荐</option>
                                            	<option value="unRecommend">取消推荐</option>
                                             	<option value="setStatus">显示</option>
                                            	<option value="unSetStatus">隐藏</option>
                                             	<option value="delete">删除</option>
                                            	<!--<option value="move">移动栏目</option>-->
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
									<td><?php echo ($vo["id"]); ?><input name="updateid[]" type="hidden" id="updateid[]" value="<?php echo ($vo["id"]); ?>" /></td>
									<td><input class="text-input large-input" name="title[]" id="title[]" value="<?php echo ($vo["title"]); ?>" style="<?php echo ($vo["title_style"]); ?>"></td>
                                    <td><?php echo (statusicon($vo["status"],1,$frontUrl,'images/icons/cross_circle.png','隐藏')); echo (attachstatus($vo["attach"],1,$frontUrl,'images/icons/image.png','附件')); echo (statusicon($vo["istop"],1,$frontUrl,'images/icons/arrow_up_green.png','置顶')); ?></td>
									<td><?php echo ($vo["category"]); ?></td>
                                    <td><input class="text-input" name="display_order[]" id="display_order[]" value="<?php echo ($vo["display_order"]); ?>" size="5" /></td>
									<td><?php echo (date("Y-m-d",$vo["create_time"])); ?></td>
									<td>
										<!-- Icons -->
										<a href="<?php echo U('Download/modify',array('id'=>$vo['id']));?>" title="编辑"><img src="__PUBLIC__/Admin/Images/icons/pencil.png" alt="编辑" /></a>
										<a href="<?php echo U('Download/doCommand',array('operate'=>'delete','id'=>$vo['id']));?>" title="删除"><img src="__PUBLIC__/Admin/Images/icons/cross.png" alt="删除" /></a>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<?php else: ?>
							<tbody>
                                <tr>
                                	<td colspan="8"><p class="no">暂无数据</p></td>
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