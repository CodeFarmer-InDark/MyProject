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
<script type="text/javascript">
    $(document).ready(function() {
        $("#mainFrom").validate({
            rules: {
                title: "required",
                content: "fckeditor",
                view_count: {
                    required: true,
                    number: true
                },
                display_order: {
                    required: true,
                    number: true
                }
            },
            messages: {
                title: "标题必须填写",
                content: "内容必须填写",
                view_count: {
                    required: "浏览次数必须填写",
                    number: '浏览次数必须为数字'
                },
                display_order: {
                    required: "排序必须填写",
                    number: '排序必须为数字'
                }
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
				
			</ul><!-- End .shortcut-buttons-set -->
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>添加</h3>
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">必填信息</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">选填内容</a></li>
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                    <form method="post" action="<?php echo U("News/doInsert");?>" id="mainFrom" enctype="multipart/form-data">
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						<fieldset class="column-left"> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<p>
								<label>标题</label>
								<input class="text-input medium-input" type="text" name="title" id="title" />
							</p>
                            <p>
								<label>文章类别<a href="javascript:void(0);" style="color: #00b7ee;margin-left: 20px;font-size: 12px" id="moreCate">增加类别</a></label>
								<select name="category_id[]"  id="selectc" onchange="style_show(this)" class="small-input cate-sel">
                                    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>">
                                            <?php if($vo["parent_id"] == '27'): ?>招生类型 > <?php echo ($vo["title"]); ?> <?php elseif($vo["parent_id"] == 33): ?>招生咨询 > <?php echo ($vo["title"]); ?> 
                                                <?php else: echo ($vo["title"]); endif; ?>
                                        </option><?php endforeach; endif; else: echo "" ;endif; ?>
                            	</select>
							</p>
                            <p>
                                <label>添加至</label>
                                <input type="checkbox" name="flash" id="flash" />招生快讯
                                <input type="checkbox" name="open" id="open" />信息公开
                            </p>
                        </fieldset>
                        <fieldset class="column-right">
                            <p>
                                <label>新闻附件<a href="javascript:void(0);" style="color: #00b7ee;margin-left: 20px;font-size: 12px" id="moreFile">增加附件</a></label>
                                <input class="medium-input file-item" type="file" name="attach_file[]" id="attach_file"/>
                            </p>
                            <p>
                                <label>内容摘要</label>
                                <textarea class="text-input textarea" name="description" id="description" cols="79" rows="4"></textarea>
                            </p>
                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                        <p></p>
                        <fieldset>
                                <label>基本内容</label>
                                <!-- <textarea class="text-input textarea" name="content" id="content" cols="79" rows="4"></textarea> -->
                                <script type="text/javascript">
									// var editor = new baidu.editor.ui.Editor({
									// 	UEDITOR_HOME_URL:'__PUBLIC__/Js/ueditor/',
									// 	iframeCssUrl :'__PUBLIC__/Js/ueditor/themes/default/iframe.css',
									// 	textarea:'content',
									// 	initialContent:''
									// });
									// editor.render('content');
								</script>
                                <script type="text/plain" id="content" name="content" style="height:400px;"></script>
                                <script type="text/javascript">
                                    var ue = UE.getEditor('content');
                                </script>
							<p>
                                <input class="button" type="submit" name="submit" value="提交更新"/>
                                <input class="button" type="reset" name="button" id="button" value="还原重填"/>
							</p>
                        </fieldset>
                    </div> <!-- End #tab1 -->
                    <div class="tab-content" id="tab2"> <!-- This is the target div. id must match the href of this div's tab -->
                        <fieldset class="column-left">
                            <p>
                                <label>模板</label>
                                <input class="text-input medium-input" type="text" name="template" id="template" />
                                <br /><small>若本模块拥有多个模板文件供调用，可在此填入相应的模板名（无需填写.html），保持默认则留空即可。</small>
                            </p>
                            <p>
                                <label>标签</label>
                                <input class="text-input medium-input" type="text" name="tags" id="tags" />
                                <br /><small>各个标签之间请用","隔开（注：此处为英文半角符号）</small>
                            </p>
                            <p>
                                <label>关键词</label>
                                <input class="text-input medium-input" type="text" name="keyword" id="keyword" />
                                <br /><small>各个关键词之间请用","或者"|"隔开（注：此处为英文半角符号）</small>
                            </p>
                            <p>
                                <label>外链地址</label>
                                <input class="text-input medium-input" type="text" name="link_url" id="link_url" />
                                <br /><small>填写外链地址后，本条目链接将自动转向所填写的网址，以上填写的信息将不会显示。</small>
                            </p>
                        </fieldset>
                        <fieldset class="column-right">
                            <p>
                                <label>来源</label>
                                <input class="text-input medium-input" type="text" name="copy_from" id="copy_from" />
                            </p>
                            <p>
                                <label>来源链接</label>
                                <input class="text-input medium-input" type="text" name="from_link" id="from_link" />
                            </p>
                            <p>
                                <label>其它参数</label>
                                <select name="status" id="status">
                                    <option value="0" selected="selected">默认显示</option>
                                    <option value="1">隐藏</option>
                                </select>
                                <select name="istop" id="istop">
                                    <option value="0" selected="selected">默认不置顶</option>
                                    <option value="1">置顶</option>
                                </select>
                                浏览 <input name="view_count" type="text" id="view_count" value="0" size="5" maxlength="12"  />
                                排序 <input name="display_order" type="text" id="display_order" value="0" size="5" maxlength="12"  />
                                <br /><small>置顶以修改时间倒序排列，即后修改的排在先修改的前面；排序以排列序数倒序排列，默认为0，数字越大，则越靠前</small>
                            </p>
                            <p>
                                <label>录入时间</label>
                                <input class="text-input Wdate" type="text" name="create_time" id="create_time" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',isShowClear:false,readOnly:true,isShowToday:true})" value="<?php echo date('Y-m-d ')?>" />
                            </p>
                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                        <p>
                            <input class="button" type="submit" name="submit" value="提交更新"/>
                            <input class="button" type="reset" name="button" id="button" value="还原重填"/>
                        </p>
                    </div> <!-- End #tab2 -->
                    </form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
			<div class="clear"></div>

            <style type="text/css">
                .cate-sel,.file-item {
                    display: block;
                    margin-bottom: 10px;
                }
                .add-cate-div,.add-file-div {
                    position: relative;
                }
                .add-file-div {
                    background: #eee;
                }
                .add-cate-div span,.add-file-div span{
                    position: absolute;
                    top: 25%;
                    left: 27%;
                    width: 14px;
                    height: 14px;
                    border: 1px solid #f00;
                    line-height: 14px;
                    text-align: center;
                    border-radius: 50%;
                    color: #f00;
                    font-weight: bold;
                    cursor: pointer;
                }
                .add-file-div span {
                    top: 20%;
                    left: 95%;
                }
            </style>
            <script type="text/javascript">
                
                /**
                 * 多类别选择
                 */
                $('#moreCate').click(function () {
                    var category = $('#selectc').clone();
                    $('#selectc').after('<div class="add-cate-div">'+(category[0].outerHTML)+'<span class="cate-del">&times;</span></div>');
                });
                //删除增加的文章类别
                $('.cate-del').live('click',function () {
                    $(this).parent().remove();
                });

                /**
                 * 多附件上传
                 */
                $('#moreFile').click(function () {
                    var file = $('#attach_file').clone();
                    $('#attach_file').after('<div class="add-file-div">'+(file[0].outerHTML)+'<span class="file-del">&times;</span></div>');
                });
                //删除增加的附件选项
                $('.file-del').live('click',function () {
                    $(this).parent().remove();
                });
            </script>
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