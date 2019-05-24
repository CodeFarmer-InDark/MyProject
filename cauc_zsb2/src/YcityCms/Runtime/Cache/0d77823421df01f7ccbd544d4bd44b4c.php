<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="renderer" content="webkit">
    <!--加载meta IE兼容文件-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if(isset($contenttitle)): echo ($contenttitle); ?>-<?php endif; if(isset($moduleTitle)): echo ($moduleTitle); ?>-<?php endif; echo ($sysConfig["site_name"]); ?>-<?php echo ($sysConfig["seo_title"]); ?>-Powered by Y-city</title>
    <meta name="keywords" content="<?php echo (($contentDetail["keyword"])?($contentDetail["keyword"]):$sysConfig['seo_keyword']); ?>" />
    <meta name="description" content="<?php echo (($contentDetail["description"])?($contentDetail["description"]):$sysConfig['seo_description']); ?>" />
    <link href="./Public/Style/style.css" rel="stylesheet" type="text/css">
    <link href="./Public/Style/style-responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./Public/Style/flexslider3.css" type="text/css">
    <script src="./Public/Js/echarts.js"></script>
    <link rel="stylesheet" href="./Public/assets/css/bootstrap.min.css">
    <script src="./Public/Js/respond.min.js"></script>
    <script src="./Public/assets/scripts/jquery.min.js"></script>

    <script type="text/javascript">
        function menuFix() {
            var sfEls = document.getElementById("nav").getElementsByTagName("li");
            for (var i=0; i<sfEls.length; i++) {
                sfEls[i].onmouseover=function() {
                    this.className+=(this.className.length>0? " ": "") + "sfhover";
                }
                sfEls[i].onMouseDown=function() {
                    this.className+=(this.className.length>0? " ": "") + "sfhover";
                }
                sfEls[i].onMouseUp=function() {
                    this.className+=(this.className.length>0? " ": "") + "sfhover";
                }
                sfEls[i].onmouseout=function() {
                    this.className=this.className.replace(new RegExp("( ?|^)sfhover\\b"),"");
                }
            }
        }
        window.onload=menuFix;
    </script>

    <script type="text/javascript">
        function moreshow() {
            if (navibox.style.display != 'block') {
                navibox.style.display = 'block';
            } else {
                navibox.style.display = 'none';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var navOffset=$("#nav").offset().top;
            $(window).scroll(function(){
                var scrollPos=$(window).scrollTop();
                if(scrollPos >=navOffset){
                    $("#nav").addClass("fixed");
                    $("#navi").addClass("full");
                    $("#nav-angle").hide();
                }else{
                    $("#nav").removeClass("fixed");
                    $("#navi").removeClass("full");
                }
            });

        });
    </script>
</head>
<body>
<div id="wrap" >
    <div class="body" >
        <div class="header">
            <div class="top"><div class="colorbox"></div></div>
            <div class="topbox">
                <div class="headerlogo"><div class="logo"></div></div>
                <div class="headericon"><div class="logo_icon"></div></div>
                <ul>
                    <li></li>
                </ul>
                <div id="navi">
                    <ul id="nav">
                        <li id="top" > <img src="./Public/Images/nav-angle1.png" alt="" id="nav-angle"></li>
                        <li id="home"><a href="__ROOT__/" >&nbsp; 首 页</a></li>
                        <li id="colorfff">|</li>
                        <li><a href="<?php echo U('Brief/index/');?>">走进航大</a></li>
                        <li id="colorfff">|</li>
                        <li><a href="<?php echo U('List/index/',array('id'=>'13'));?>">报考指南</a>
                        </li> <li id="colorfff">|</li>
                        <li><a href="<?php echo U('College/index/',array('id'=>'44'));?>">学院介绍</a>
                        </li> <li id="colorfff">|</li>
                        <li><a href="<?php echo U('List/index/',array('id'=>'19'));?>" >招生类型</a>
                        </li> <li id="colorfff">|</li>
                        <li><a href="<?php echo U('Page/detail',array('link_label'=>'telephone'));?>" >招生咨询</a>
                        </li> <li id="colorfff">|</li>
                        <li><a href="<?php echo U('List/open/',array('id'=>'34'));?>" >信息公开</a></li> <li id="colorfff">|</li>
                        <li><a href="<?php echo U('Contact/index/');?>" >联系我们</a></li>
                    </ul>
                </div>
            </div>
            <div class="navimenu">
                <div class="menubox">
                    <a id="menu" href="#" onclick="moreshow()"></a>
                </div>
            </div>
            <div class="navibox" id="navibox">
                <div id="re-menu-box">
                    <a href="__ROOT__/" id="re_menu">首&nbsp;&nbsp;页</a>
                    <a href="<?php echo U('Brief/index/');?>" id="re_menu">走进航大</a>
                    <a href="<?php echo U('List/index/',array('id'=>'13'));?>" id="re_menu">报考指南</a>
                    <a href="<?php echo U('College/index/',array('id'=>'44'));?>" id="re_menu">学院介绍</a>
                    <a href="<?php echo U('List/index/',array('id'=>'19'));?>"  id="re_menu">招生类型</a>
                    <a href="<?php echo U('Page/detail',array('link_label'=>'telephone'));?>" id="re_menu" >招生咨询</a>
                    <a href="<?php echo U('List/open/',array('id'=>'34'));?>"  id="re_menu">信息公开</a>
                    <a href="<?php echo U('Contact/index/');?>"  id="re_menu1">联系我们</a>
                    <div class="re-search-top-box">
                    </div>
                </div>
            </div>

        </div>
        <div class="banner-img">
            <?php switch($plist): case "录取结果": ?><img src="./Public/Images/banner/register-banner.jpg"/><?php break;?>
                <?php case "招生计划": ?><img src="./Public/Images/banner/plan-banner.jpg"/><?php break;?>
                <?php case "历年分数": ?><img src="./Public/Images/banner/score-banner.jpg"/><?php break;?>
                <?php case "网上报名": ?><img src="./Public/Images/banner/register-banner.jpg"/><?php break;?>
                <?php case "中欧学院招生选拔报名": ?><img src="./Public/Images/banner/register-banner.jpg"/><?php break;?>
                <?php case "选考科目": ?><img src="./Public/Images/banner/subject-banner.jpg"/><?php break;?>
                <?php case "招生类型": ?><img src="./Public/Images/banner/type-banner.jpg"/><?php break;?>
                <?php case "报考指南": ?><img src="./Public/Images/banner/college-banner.jpg"/><?php break;?>
                <?php case "招生章程": ?><img src="./Public/Images/banner/regular-banner.jpg"/><?php break;?>
                <?php case "走进航大": ?><img src="./Public/Images/banner/brief-banner.jpg"/><?php break;?>
                <?php case "信息公开": ?><img src="./Public/Images/banner/open-banner.jpg"/><?php break;?>
                <?php case "学院介绍": ?><img src="./Public/Images/banner/college1-banner.jpg"/><?php break;?>
                <?php case "联系我们": ?><img src="./Public/Images/banner/contact-banner.jpg"/><?php break;?>
                <?php case "招生咨询": ?><img src="./Public/Images/banner/consult-banner.jpg"/><?php break;?>
                <?php case "招生视频": ?><img src="./Public/Images/banner/video-banner.jpg"/><?php break;?>
                <?php case "美丽校园": ?><img src="./Public/Images/banner/page-banner.jpg"/><?php break;?>
                <?php case "搜索结果": ?><img src="./Public/Images/banner/jieguo-banner.jpg"/><?php break;?>
                <?php case "热点资讯": ?><img src="./Public/Images/banner/hot-banner.jpg"/><?php break;?>
                <?php case "录取进度": ?><img src="./Public/Images/banner/open-banner.jpg"/><?php break;?>
                <?php case "新生大数据统计": ?><img src="./Public/Images/banner/open-banner.jpg"/><?php break; endswitch;?>
        </div>

<div class="breadcrumbs">
    <div class="bfont">当前位置：<a href="__ROOT__/">首页</a>><a href="<?php echo U('College/index',array('id'=>44));?>"><?php echo ($moduleTitle); ?></a>><a href="<?php echo U('College/index',array('id'=>44));?>">院系设置</a></div>
</div>
<div class="re-breadcrumbs">
    <div class="bfont"><a href="__ROOT__/">首页 </a>> <a href="<?php echo U('College/index',array('id'=>44));?>"><?php echo ($moduleTitle); ?></a> > <a href="<?php echo U('College/index',array('id'=>44));?>">院系设置</a></div>
</div>
<div class="listmain">
    <div class="cont">
        <div class="title" >
                <div >
                    <ul class="collegeList">
                        <?php if(isset($collegeList)): if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="college">
                                    <div class="c-l">

                                        <a class="collegebox" href="<?php echo U('College/detail/',array('id'=>$vo['id']));?>" >
                                            <span class="cName"><img src="__PUBLIC__/Images/college_ico.png" ><?php echo (msubstr($vo["title"],0,40)); ?></span>
                                        </a>
                                    </div>
                                    <div class="c-r">
                                        <?php if(is_array($vo["field"])): $i = 0; $__LIST__ = $vo["field"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><a class="majorbox" href="<?php echo U('College/detail/',array('id'=>$field['id']));?>" >
                                                <?php echo ($field["title"]); if(empty($field['zyfx']) != true): ?>(<?php echo ($field["zyfx"]); ?>)<?php endif; ?>
                                            </a><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php else: ?>
                            <div class="nullData">暂无数据</div><?php endif; ?>
                    </ul>
                </div>
        </div>
    </div>
    <div class="backclo f_l side hid"  >
    <div class="muns">
        <div id="id" class="ntcontent" style="overflow: hidden;">
            <div>
                <ul >
                    <?php switch($plist): case "招生类型": ?><li class="type-title">招生类型<img src="__PUBLIC__/Images/more_ico2.png" class="icon1"></li>
                            <?php if(is_array($typelist)): $i = 0; $__LIST__ = $typelist;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i; if($row['id'] == $id): ?><li class="type-selected" id="kuan">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>" onclick="showSelect()"><?php echo (msubstr($row["title"],0,18)); ?></a>
                                        <?php if(isset($row["topNews"])): ?><span class="erji_ul" style="display:block;"><a href="<?php echo U('List/detail/',array('id'=>$row['topId']));?>" class="descrip"><?php echo (msubstr($row["topNews"],0,18)); ?></a></span><?php endif; ?>
                                    </li>
                                    <li class="type-selected" id="jiaokuan">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>" onclick="showSelect()"><?php echo (msubstr($row["title"],0,36)); ?></a>
                                    </li>
                                    <li class="type-selected" id="zhai">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>" onclick="showSelect()"><?php echo (msubstr($row["title"],0,24)); ?></a>
                                    </li>
                                    <li class="type-selected" id="zuizhai">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>" onclick="showSelect()"><?php echo (msubstr($row["title"],0,16)); ?></a>
                                    </li>
                                    <?php else: ?>
                                    <li class="type" id="kuan">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,18)); ?></a>
                                        <?php if(isset($row["topNews"])): ?><span class="erji_ul"><a href="<?php echo U('List/detail/',array('id'=>$row['topId']));?>" class="descrip"><?php echo (msubstr($row["topNews"],0,18)); ?></a></span><?php endif; ?>
                                    </li>
                                    <li class="type" id="jiaokuan">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,36)); ?></a>
                                    </li>
                                    <li class="type" id="zhai">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,24)); ?></a>
                                    </li>
                                    <li class="type" id="zuizhai">
                                        <a href="<?php echo U('List/index/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,16)); ?></a>
                                    </li><?php endif; endforeach; endif; else: echo "暂无数据" ;endif; break;?>
                        <?php case "学院介绍": ?><div class="dir-title">学院介绍</div>
                            <?php if($id == 44): ?><li><a class="dirS" href="<?php echo U('College/index/',array('id'=>44));?>">院系设置</a></li>
                                <li><a class="dir" href="<?php echo U('College/major/',array('id'=>45));?>">专业一览</a></li>
                                <?php else: ?>
                                <li><a class="dir" href="<?php echo U('College/index/',array('id'=>44));?>">院系设置</a></li>
                                <li><a class="dirS" href="<?php echo U('College/major/',array('id'=>45));?>">专业一览</a></li><?php endif; break;?>
                        <?php default: ?>
                            <div class="dir-title">报考指南</div>
                            <?php if(is_array($museList)): $i = 0; $__LIST__ = $museList;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i; switch($row["module"]): case "List": if($row['id'] == $id): ?><li>
                                                <a class="dirS" href="<?php echo U('List/index/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,30)); ?></a>
                                            </li>
                                            <?php else: ?>
                                            <li>
                                                <a class="dir" href="<?php echo U('List/index/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,30)); ?></a>
                                            </li><?php endif; break;?>
                                    <?php default: ?>
                                        <?php if($row['id'] == $id): ?><li><a class="dirS" href="<?php echo U('College/major/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,30)); ?></a></li>
                                        <?php else: ?>
                                            <li><a class="dir" href="<?php echo U('College/major/',array('id'=>$row['id']));?>"><?php echo (msubstr($row["title"],0,30)); ?></a></li><?php endif; endswitch; endforeach; endif; else: echo "暂无数据" ;endif; endswitch;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="cate-left-l">
        <a href="<?php echo U('List/index/',array('id'=>40));?>" class="cart-left-box2"><img src="__PUBLIC__/Images/sixbtn/zhangcheng_k_ico.png" class="ico1" /><span class="btnTitle1">招生章程</span></a>
        <a href="<?php echo U('Search/index/',array('id'=>37));?>" class="cart-left-box1"><img src="__PUBLIC__/Images/sixbtn/plan_k_ico.png" class="ico2"><span class="btnTitle2">招生计划</span></a>
        <a href="<?php echo U('Search/apply/',array('id'=>38));?>" class="cart-left-box3"><img src="__PUBLIC__/Images/sixbtn/register_k_ico.png" class="ico3"><span class="btnTitle2">网上报名</span></a>
        <a href="<?php echo U('Search/score/',array('id'=>42));?>" class="cart-left-box4"><img src="__PUBLIC__/Images/sixbtn/score_k_ico.png" class="ico4"><span class="btnTitle2">历年分数</span></a>
        <a href="<?php echo U('Search/subject/',array('id'=>39));?>" class="cart-left-box5"><img src="__PUBLIC__/Images/sixbtn/subject_k_ico.png" class="ico5"><span class="btnTitle4">选考科目</span></a>
        <a href="<?php echo U('Search/admission/',array('id'=>55));?>" class="cart-left-box6" target="_blank"><img src="__PUBLIC__/Images/sixbtn/luqu_k_ico.png" class="ico6"><span class="btnTitle3">录取结果</span></a>
    </div>
    <?php if($plist == '报考指南'): ?><div class="cart_detail">
            <div class="cart_link">
                <a href="<?php echo U('List/index/',array('id'=>40));?>" class="cart-box4">招生章程 </a>
                <a href="<?php echo U('Search/index/',array('id'=>37));?>" class="cart-box1">招生计划 </a>
                <a href="<?php echo U('Search/apply/',array('id'=>38));?>" class="cart-box2">网上报名 </a>
                <a href="<?php echo U('Search/score/',array('id'=>42));?>" class="cart-box6" >历年分数 </a>
                <a href="<?php echo U('Search/subject/',array('id'=>39));?>" class="cart-box3" >选考科目 </a>
                <a href="<?php echo U('Search/admission/',array('id'=>55));?>" class="cart-box5" target="_blank">录取结果 </a>
            </div>
        </div><?php endif; ?>
    <div style="height: 1px;width: auto;background: #FFFFFF ;clear: both" >
    </div>
</div>

</div>
</div>


<div id="footer">
    <div class="footer">
        <div class="foot-cont">
            <p class="one">版权所有：中国民航大学招生办公室</p>
            <p class="two">地址：天津市东丽区津北公路2898号</p>
            <p class="three">邮编：300300 电话：022-24092114</p>
            <p class="four">地址：天津市东丽区津北公路2898号 &nbsp;邮编：300300 电话：022-24092114</p>
        </div>
    </div>
</div>
</body>
</html>