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

<link href="__PUBLIC__/Js/video-js/css/video-js.css" rel="stylesheet">
<script src="__PUBLIC__/Js/video-js/js/videojs-ie8.min.js"></script>
<script src="__PUBLIC__/Js/video-js/js/video.js"></script>
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/webuploader/webuploader.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/webuploader/bootstrap-theme.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $("#mainFrom").validate({
            rules: {
                title: "required",
            },
            messages: {
                title: "视频名称必须填写",
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
				
                <li><a class="shortcut-button" href="<?php echo U("Video/index");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/arrow_left_48.png" alt="icon" /><br />
					返回视频列表
				</span></a></li>
                <li><a class="shortcut-button" href="<?php echo U("Video/insert");?>"><span>
					<img src="__PUBLIC__/Admin/Images/icons/add_48.png" alt="icon" /><br />
					添加视频
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>视频管理</h3>
                    <!--<ul class="content-box-tabs">-->
                        <!--<li><a href="#tab1" class="default-tab">必填信息</a></li> &lt;!&ndash; href must be unique and match the id of target div &ndash;&gt;-->
                        <!--<li><a href="#tab2">选填内容</a></li>-->
                    <!--</ul>-->
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                    <p>
                        <label style="font-weight: bold;padding: 0 0 5px 0">上传文件</label>
                    </p>
                    <p>
                    <div id="uploader" class="wu-example">
                        <div id="thelist" class="uploader-list"></div>
                        <div class="btns">
                            <div id="picker" class="webuploader-container">
                                <div class="webuploader-pick">选择文件</div>
                                <div id="rt_rt_1bislfn1213jd12ig15s8e1ha2h1" style="position: absolute; top: 0px; left: 0px; width: 88px; height: 34px; overflow: hidden; bottom: auto; right: auto;">
                                    <input type="file" name="videoUrl" class="webuploader-element-invisible" multiple="multiple">
                                    <label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
                                </div>
                            </div>
                            <button id="ctlBtn" class="btn btn-default" >开始上传</button>
                        </div>
                    <br /><small style="color:#f00">已经上传视频文件，若不更换则不必重新选择</small></neq>
                    </div>
                    </p>
                    <p></p>
                    <div id="videobox" style="display: none">
                        <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" poster="" data-setup="{}" width="500px" height="300px">
                            <source src='' type="video/mp4" id="sourse">
                        </video>
                    </div>
                    <form method="post" action="<?php echo U("Video/doModify");?>" id="mainForm" enctype="multipart/form-data">
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<fieldset class="column-left"> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<p>
								<label>视频名称</label>
								<input class="text-input large-input" type="text" name="title" id="title" value="<?php echo ($vo["title"]); ?>" />
							</p>
                            <p>
                                <label>视频截图</label>
                                <input class="medium-input" type="file" name="attach_file" id="attach_file" /><?php if(($vo['attach_file']) != ""): ?><a href="../../../../../<?php echo ($UPLOADS); echo ($vo["attach_file"]); ?>" target="_blank" title="查看附件"><img src="__PUBLIC__/Admin/Images/icons/image.png" align="absmiddle" alt="查看附件" /></a>　
                                <br /><small style="color:#f00">已经上传视频封面截图，若不更换则不必重新选择</small><?php endif; ?>
                            </p>
                            <p>
                                <label>其它参数</label>
                                <select name="status" id="status">
                                    <option value="0" <?php echo (selected($vo["status"],0)); ?>>默认显示</option>
                                    <option value="1" <?php echo (selected($vo["status"],1)); ?>>隐藏</option>
                                </select>
                                <select name="istop" id="istop">
                                    <option value="0" <?php echo (selected($vo["istop"],0)); ?>>默认不置顶</option>
                                    <option value="1" <?php echo (selected($vo["istop"],1)); ?>>置顶</option>
                                </select>
                                浏览 <input name="view_count" type="text" id="view_count" value="<?php echo (($vo["view_count"])?($vo["view_count"]):0); ?>" size="5" maxlength="12"  />
                                排序 <input name="display_order" type="text" id="display_order" value="<?php echo (($vo["display_order"])?($vo["display_order"]):0); ?>" size="5" maxlength="12"  />
                                <br /><small>置顶以修改时间倒序排列，即后修改的排在先修改的前面；排序以排列序数倒序排列，默认为0，数字越大，则越靠前</small>
                            </p>
                            <p>
                                <label>更新时间</label>
                                <input class="text-input Wdate" type="text" name="update_time" id="create_time" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',isShowClear:false,readOnly:true,isShowToday:true})" value="<?php echo (date("Y-m-d",$vo["create_time"])); ?>"/>
                            </p>
                            <p>
                                <input type="hidden" value="<?php echo U('Video/VideoUpload');?>" id="action">
                                <input type="hidden" value="./Public" id="froot">
                                <input type="hidden" value="../../../../../Uploads/" id="Uroot">
                                <input class="button" type="submit" name="submit" value="提交更新"/>
                                <input class="button" type="reset" name="button" id="button" value="还原重填"/>
                                <input name="id" type="hidden" id="id" value="<?php echo ($vo["id"]); ?>" />
                                <input name="videourl" type="hidden" id="videourl" value="" />
                                <input name="old_file" type="hidden" id="old_file" value="<?php echo ($vo["videoUrl"]); ?>" />
                                <input name="old_image" type="hidden" id="old_image" value="<?php echo ($vo["attach_file"]); ?>" />
                            </p>
                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->

					</div> <!-- End #tab1 -->
                    </form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
			<div class="clear"></div>

            <!--引入JS-->
            <script type="text/javascript" src="__PUBLIC__/Admin/webuploader/jquery-1.10.2.min.js"></script>
            <script type="text/javascript" src="__PUBLIC__/Admin/webuploader/webuploader.js"></script>
            <script type="text/javascript" src="__PUBLIC__/Admin/webuploader/getting-started.js"></script>
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