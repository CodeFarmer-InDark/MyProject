<?php if (!defined('THINK_PATH')) exit();?>﻿
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
    <div class="bfont">当前位置：<a href="__ROOT__/">首页</a>><a href="<?php echo U('List/open',array('id'=>34));?>"><?php echo ($moduleTitle); ?></a></div>
</div>
<div class="re-breadcrumbs">
    <div class="bfont"><a href="__ROOT__/">首页</a> > <a href="<?php echo U('List/open',array('id'=>34));?>"><?php echo ($moduleTitle); ?></a></div>
</div>
<div class="listmain">
    <div class="cont_v">
        <div >
            <div class="vd-title">信息公开</div>
            <ul class="vd-ul">
                <?php if(isset($dataContentList)): if(is_array($dataContentList)): $i = 0; $__LIST__ = $dataContentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                            <?php if($row['link_url'] != ''): ?><a href="<?php echo ($row["link_url"]); ?>" style="<?php echo ($row["title_style"]); ?>" target="_blank" class="zs-a" id="kuan"><?php echo (msubstr($row["title"],0,40)); ?></a>
                                <a href="<?php echo ($row["link_url"]); ?>" style="<?php echo ($row["title_style"]); ?>" target="_blank" class="zs-a" id="jiaokuan"><?php echo (msubstr($row["title"],0,36)); ?></a>
                                <a href="<?php echo ($row["link_url"]); ?>" style="<?php echo ($row["title_style"]); ?>" target="_blank" class="zs-a" id="zhai"><?php echo (msubstr($row["title"],0,28)); ?></a>
                                <a href="<?php echo ($row["link_url"]); ?>" style="<?php echo ($row["title_style"]); ?>" target="_blank" class="zs-a" id="zuizhai"><?php echo (msubstr($row["title"],0,18)); ?></a>
                                <?php else: ?>
                                <a class="zs-a" href="<?php echo U('List/detail/',array('id'=>$row[id]));?>" id="kuan"><?php echo (msubstr($row["title"],0,40)); ?></a>
                                <a class="zs-a" href="<?php echo U('List/detail/',array('id'=>$row[id]));?>" id="jiaokuan"><?php echo (msubstr($row["title"],0,36)); ?></a>
                                <a class="zs-a" href="<?php echo U('List/detail/',array('id'=>$row[id]));?>" id="zhai"><?php echo (msubstr($row["title"],0,28)); ?></a>
                                <a class="zs-a" href="<?php echo U('List/detail/',array('id'=>$row[id]));?>" id="zuizhai"><?php echo (msubstr($row["title"],0,18)); ?></a><?php endif; ?> <span class="f_r">【<?php echo (date("Y-m-d",$row["create_time"])); ?>】</span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <div class="nullData">暂无数据</div><?php endif; ?>
            </ul>
        </div>
        <div class="fenye">
            <div class="page">
                <?php echo ($pageContentBar); ?>
            </div>
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