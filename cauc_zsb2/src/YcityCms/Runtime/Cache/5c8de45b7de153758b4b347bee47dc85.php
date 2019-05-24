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

<script src="__PUBLIC__/Js/flexslider/jquery.min.js"></script>
<script src="__PUBLIC__/Js/flexslider/jquery.mmenu.min.all.js"></script>
<script src="__PUBLIC__/Js/flexslider/jquery.flexslider.js"></script>
<script src="__PUBLIC__/Js/flexslider/o-script.js"></script>
<script src="__PUBLIC__/Js/jquery.scroll.js" type="text/javascript"></script>
<!-- 图片播放功能 -->
<div class="bannerPane">
    <section class="slider">
        <div class="flexslider">
            <ul class="slides">
                <?php if(is_array($advlist)): $i = 0; $__LIST__ = $advlist;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                        <a class="banner-img" href="<?php echo ($row["link_url"]); ?>" target="_blank">
                            <img src="__ROOT__/Uploads/<?php echo ($row["attach_file"]); ?>"/>
                        </a>
                    </li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </ul>
        </div>
    </section>
</div>
<div class="newsbox">
    <div class="news">
        <div class="title" ><span>招生快讯</span><a href="<?php echo U('List/index/',array('id'=>'13'));?>" class="more2">more+</a></div>
        <ul>
            <?php if(is_array($flashList)): $i = 0; $__LIST__ = $flashList;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                    <div class="date">
                        <div class="year"><span><?php echo (date("Y",$row["update_time"])); ?></span></div>
                        <div class="day"><span><?php echo (date("m.d",$row["update_time"])); ?></span></div>
                    </div>
                    <?php if($row['link_url'] != ''): ?><a href="<?php echo ($row["link_url"]); ?>" target="_blank">
                            <div class="topic" id="kuan"><?php echo (msubstr($row["title"],0,30)); ?></div>
                            <div class="topic" id="jiaokuan"><?php echo (msubstr($row["title"],0,66)); ?></div>
                            <div class="detail" id="kuan"><?php echo (msubstr($row["description"],0,90)); ?></div>
                            <div class="detail" id="jiaokuan"><?php echo (msubstr($row["description"],0,30)); ?></div>
                        </a>
                        <?php else: ?>
                        <a href="<?php echo U('List/detail/',array('id'=>$row['id']));?>">
                            <div class="topic" id="kuan">
                                <?php echo (msubstr($row["title"],0,34)); ?>
                            </div>
                            <div class="topic" id="jiaokuan">
                                <?php echo (msubstr($row["title"],0,70)); ?>
                            </div>
                            <div class="detail" id="kuan"><?php echo (msubstr($row["description"],0,100)); ?></div>
                            <div class="detail" id="jiaokuan"><?php echo (msubstr($row["description"],0,36)); ?></div>
                        </a><?php endif; ?>
                </li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>
</div>
<div class="newsbox1">
    <div class="news">
        <div class="title" ><span>招生快讯</span><a href="<?php echo U('List/index/',array('id'=>'13'));?>" class="more2">more+</a></div>
        <ul>
            <?php if(is_array($flashList1)): $i = 0; $__LIST__ = $flashList1;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                    <div class="date">
                        <div class="year"><span><?php echo (date("Y",$row["create_time"])); ?></span></div>
                        <div class="day"><span><?php echo (date("m.d",$row["create_time"])); ?></span></div>
                    </div>
                    <?php if($row['link_url'] != ''): ?><a href="<?php echo ($row["link_url"]); ?>" target="_blank">
                            <span class="topic" id="zhai"><?php echo (msubstr($row["title"],0,72)); ?></span>
                            <span class="topic" id="zuizhai"><?php echo (msubstr($row["title"],0,24)); ?></span>
                        </a>
                        <?php else: ?>
                        <a href="<?php echo U('List/detail/',array('id'=>$row['id']));?>">
                            <span class="topic" id="zhai">
                                <?php echo (msubstr($row["title"],0,42)); ?>
                            </span>
                            <span class="topic" id="zuizhai">
                                <?php echo (msubstr($row["title"],0,24)); ?>
                            </span>
                        </a><?php endif; ?>
                </li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>
</div>
<div class="cart">
    <div class="cart_link">
        <a href="<?php echo U('List/index/',array('id'=>40));?>" class="cart-box1">招生章程 </a>
        <a href="<?php echo U('Search/index/',array('id'=>37));?>" class="cart-box2">招生计划 </a>
        <a href="<?php echo U('Search/apply/',array('id'=>38));?>" class="cart-box3">网上报名 </a>
        <a href="<?php echo U('Search/scorenav/',array('id'=>42));?>" class="cart-box4" >历年分数 </a>
        <a href="<?php echo U('Search/subject/',array('id'=>39));?>" class="cart-box5" >选考科目 </a>
        <a href="<?php echo U('Search/admission/',array('id'=>55));?>" class="cart-box6">录取结果 </a>
    </div>
</div>
<div class="re-cart">
    <div class="cartbox">
        <a href="<?php echo U('List/index/',array('id'=>40));?>" class="cart-left-box1">招生章程</a>
        <a href="<?php echo U('Search/index/',array('id'=>37));?>" class="cart-left-box2">招生计划</a>
        <a href="<?php echo U('Search/apply/',array('id'=>38));?>" class="cart-left-box3">网上报名</a>
        <a href="<?php echo U('Search/scorenav/',array('id'=>42));?>" class="cart-left-box4">历年分数</a>
        <a href="<?php echo U('Search/subject/',array('id'=>39));?>" class="cart-left-box5">选考科目</a>
        <a href="<?php echo U('Search/admission/',array('id'=>55));?>" class="cart-left-box6">录取结果</a>
    </div>
</div>
<div class="indexmain">
    <div class="stutype">
        <div class="title" ><span>招生类型</span></div>
        <ul>
            <li><a href="<?php echo U('List/index/',array('id'=>19));?>">国家统招</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>20));?>">中外合作办学中欧航空工程师</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>21));?>">民航招飞</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>22));?>">空乘空保招生</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>23));?>">高水平运动队</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>24));?>">港澳侨台</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>25));?>">少数民族</a></li>
            <li class="last"><a href="<?php echo U('List/index/',array('id'=>26));?>">国家贫困专项</a></li>
        </ul>
    </div>
    <div class="stuvideo">
        <div class="title" ><span>招生视频</span><a href="<?php echo U('Video/index');?>" class="more1">more+</a></div>
        <div class="video-box">
            <div class="vcontent">
                <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" poster="Uploads/<?php echo ($video["attach_file"]); ?>" data-setup="{}">
                    <source src='Uploads/<?php echo ($video["videoUrl"]); ?>' type="video/mp4">
                </video>
            </div>
        </div>
    </div>
    <div class="re-stutype">
        <div class="title" ><span>招生类型</span></div>
        <ul>
            <li><a href="<?php echo U('List/index/',array('id'=>19));?>">国家统招</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>20));?>">中外合作办学中欧航空工程师</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>21));?>">民航招飞</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>22));?>">空乘空保招生</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>23));?>">高水平运动队</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>24));?>">港澳侨台</a></li>
            <li><a href="<?php echo U('List/index/',array('id'=>25));?>">少数民族</a></li>
            <li class="last"><a href="<?php echo U('List/index/',array('id'=>26));?>">国家贫困专项</a></li>
        </ul>
    </div>
    <div class="re-picture">
        <div class="lxfscroll" >
            <ul>
                <?php if(is_array($picList)): $i = 0; $__LIST__ = $picList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                        <div class="ptitle"><a href="<?php echo ($row["link_url"]); ?>" target="_blank" ><?php echo ($row["title"]); ?></a></div>
                        <a href="<?php echo ($row["link_url"]); ?>" target="_blank"  >
                            <?php if($row['attach_file'] != ''): ?><img src="__ROOT__/Uploads/<?php echo ($row["attach_file"]); ?>" alt="<?php echo ($row["title"]); ?>" >
                                <?php else: ?>
                                <img src="__PUBLIC__/Images/nopic.png" alt="暂无图片" class="pic"/><?php endif; ?>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="button">
            <input name="a" type="button" onClick="lxfLast()" value="< " class="leftbtn"/>
            <input name="a" type="button" onClick="lxfNext()" value="&nbsp;>" class="rightbtn"/>
        </div>
    </div>
</div>
<div class="colordiv"><div class="div"></div></div>
<div class="picture">
    <div class="picbox">
        <ul>
            <?php if(is_array($picList)): $i = 0; $__LIST__ = $picList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                    <div id="ptitle" class="ptitle"><a href="<?php echo ($row["link_url"]); ?>" target="_blank" class="ie8"><?php echo ($row["title"]); ?></a></div>
                    <a href="<?php echo ($row["link_url"]); ?>" target="_blank" >
                        <?php if($row['attach_file'] != ''): ?><img src="__ROOT__/Uploads/<?php echo ($row["attach_file"]); ?>" alt="<?php echo ($row["title"]); ?>" class="ie8">
                            <?php else: ?>
                            <img src="__PUBLIC__/Images/nopic.png" alt="暂无图片" class="pic"/><?php endif; ?>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<!--[if lt IE 9]>
<style>
    .picture ul li a img.ie8{margin:-30px 0px 0px 10px}
    .picture ul li #ptitle{top:210px;}
    .picture ul li a.ie8{margin-top:00px}
</style>
<![endif]-->
<script>
    $(function(){
        var i=0;
        var li = $(".lxfscroll li");
        var n=li.length-1;
        var speed = 300;
        li.not(":first").css({left:"500px"});
        li.eq(n).css({left:"-500px"});
        lxfNext=function (){
            if (!li.is(":animated")) {
                if (i>=n){i=0;li.eq(n).animate({left:"-400px"},speed);
                    li.eq(i).animate({left:"0px"},speed);
                }else{i++;li.eq(i-1).animate({left:"-400px"},speed);li.eq(i).animate({left:"0px"},speed);};
                li.not("eq(i)").css({left:"400px"});
                $("i").text(i+1);
            }else{};
        };
        lxfLast=function (){
            if (!li.is(":animated")) {
                if (i<=0){i=n;li.eq(0).animate({left:"400px"},speed);li.eq(n).animate({left:"0px"},speed);
                }else{i--;li.eq(i+1).animate({left:"400px"},speed);li.eq(i).animate({left:"0px"},speed);}
                li.not("eq(i)").css({left:"-400px"});
                $("i").text(i+1);
            };
        };
    });
</script>
<link href="./Public/Js/video-js/css/video-js.css" rel="stylesheet">
<script src="./Public/Js/video-js/js/videojs-ie8.min.js"></script>
<script src="./Public/Js/video-js/js/video.js"></script>

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