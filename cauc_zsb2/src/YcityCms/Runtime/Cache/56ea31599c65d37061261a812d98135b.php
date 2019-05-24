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
    <div class="bfont">当前位置：<a href="__ROOT__/">首页</a> > <a href="<?php echo U('Search/score',array('id'=>42));?>">历年分数</a></div>
</div>
<div class="re-breadcrumbs">
    <div class="bfont"><a href="__ROOT__/">首页</a> >&nbsp;<a href="<?php echo U('Search/score',array('id'=>42));?>">历年分数</a></div> </div>
</div>
<div class="listmain">
    <div class="search-condition">
        <form action="<?php echo U('Search/score',array('id'=>42));?>" method="get" class="search-box" onsubmit="addStr()">
            <input type="hidden" name="m" class="moduleName" value="<?php echo ($moduleName); ?>">
            <input type="hidden" name="a" class="actionName" value="<?php echo ($actionName); ?>">
            <input type="hidden" name="id" class="id" value="<?php echo ($id); ?>">
            <label> <span style="color:red;margin:3px 5px 0 0; float:left;">*</span> 省份</label>
            <select name="province" id="province" class="search-item" >
                <option value="">选择省份</option>
                <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i; if($p["id"] == $pid): ?><option value="<?php echo ($p["id"]); ?>" selected><?php echo ($p["province"]); ?></option>
                        <?php else: ?>
                        <option value="<?php echo ($p["id"]); ?>"><?php echo ($p["province"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <label>年份</label>
            <div class="checkbox_year">
                <input type="checkbox" name="year1" id="year" value="<?php echo ($year[0]); ?>" <?php if(in_array($year[0],$year_selected)): ?>checked<?php endif; ?>><?php echo ($year[0]); ?>
                <input type="checkbox" name="year2" id="year" value="<?php echo ($year[1]); ?>" <?php if(in_array($year[1],$year_selected)): ?>checked<?php endif; ?>><?php echo ($year[1]); ?>
                <div hidden><input type="checkbox" name="year3" id="year" value="<?php echo ($year[2]); ?>" <?php if(in_array($year[2],$year_selected)): ?>checked<?php endif; ?>><?php echo ($year[2]); ?></div>
            </div>
            <label hidden="hidden">批次</label>
            <select name="pc" id="pc" class="major-item" hidden="hidden">
                <option value="">选择批次</option>
            </select>
            <div class="submit forpad"><input type="submit" class="submitcont" value="查询"></div>
        </form>
    </div>
    <div class="search">
        <table  cellspacing="0" cellpadding="0">
            <thead>
            <tr><th colspan="10" class="search-title">历年分数</th></tr>
            <tr class="plan-attr">
                <th>年份</th>
                <th>省份</th>
                <th>省内批次</th>
                <th>科类</th>
                <th>最高分</th>
                <th>最低分</th>
                <th>平均分</th>
            </tr>
            </thead>
            <?php if(isset($data)): ?><tbody>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!--<tr>
                        <td class="yearName"><?php echo ($vo["year"]); ?></td>
                        <td class="yearName"><?php echo ($vo["pname"]); ?></td>
                        <td><?php echo ($vo["pcname"]); ?></td>
                        <td><?php echo ($vo["zyname"]); ?></td>
                        <td><?php echo ($vo["zyfx"]); ?></td>
                        <td class="tarName"><?php echo ($vo["tname"]); ?></td>
                        <td class="tarName"><?php echo ($vo["topscore"]); ?></td>
                        <td class="tarName"><?php echo ($vo["lowscore"]); ?></td>
                        <td class="tarName"><?php echo ($vo["avescore"]); ?></td>
                    </tr>
                    </tr>-->
					
					 <tr>
                        <td class="yearName"><?php echo ($vo["year"]); ?></td>
                        <td class="yearName"><?php echo ($vo["pname"]); ?></td>
                        <td><?php echo ($vo["pcname"]); ?></td>
                        <td class="tarName"><?php echo ($vo["tname"]); ?></td>
                        <td class="tarName"><?php echo ($vo["topscore"]); ?></td>
                        <td class="tarName"><?php echo ($vo["lowscore"]); ?></td>
                        <td class="tarName"><?php echo ($vo["avescore"]); ?></td>
                    </tr>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <?php else: ?>
                <tbody>
                <tr>
                    <td colspan="10"><p class="no" ><?php echo ($msg); ?></p></td>
                </tr><?php endif; ?>
        </table>
        <div class="fenye">
            <div class="page">
                <?php echo ($page); ?>
            </div>
        </div> <!-- End .pagination -->

        <div class="bottombox">
            <div class="msg">
                <div id="msg"></div>
            </div>
            <div id="charts" class="charts"></div>
            <?php if($count == 2): ?><!--<h5 style="text-align: center;font-weight:bold;display:none;" id="icon-title">若未选择科类查询出文理两条记录，统计图中默认展示文史类，请选择科类切换查看。</h5>--><?php endif; ?>
        </div>
        <?php if(isset($data)): ?><div class="remark_s"><?php echo ($remark); ?></div><?php endif; ?>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var pid = $('#province').val();
        var year = "<?php echo ($year_selected1); ?>";
        /* echarts图表 */
        var MYCHART;
        MYCHART = echarts.init(document.getElementById("charts"));
        var option = {
            noDataLoadingOption: {
                text: '暂无数据',
                effect: 'bubble',
                effectOption: {
                    effect: {
                        n: 0
                    }
                }
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {show: true, readOnly: true},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            tooltip: {
                show: true
            },
            legend: {
                data: ['最高分', '最低分', '平均分']
            },
            xAxis: [
                {
                    type: "category",
                    data: [],
                    // axisLabel: {
                    //     interval: 0,
                    //     formatter: function (value, index) {
                    //         if (index % 2 != 0) {
                    //             return '\n\n' + value;
                    //         } else {
                    //             return value;
                    //         }
                    //     }
                    // }
                }
            ],
            yAxis: [
                {
                    type: "value",
                    splitLine: {lineStyle: {type: 'dashed'}},
                    axisLabel: {
                        textStyle: {
                            baseline: 'middle',
                            fontSize: 10
                        }
                    },
                    scale: true
                }
            ],
            series: [
                {
                    "name": "最高分",
                    "type": "bar",
                    data: []

                },
                {
                    "name": "最低分",
                    "type": "bar",
                    data: []

                },
                {
                    "name": "平均分",
                    "type": "bar",
                    data: []

                }
            ]
        };
        //没有选择批次的时候，不画图
        var pcdm = '';
        $('#charts').parent().css('display', 'none');
        if (pcdm) {
            $('#charts').parent().css('display', 'block');
            $.ajax({
                // url: "http://www.cauc.edu.cn/lqgl/Api/Inquire/chartsByPc?province=" + pid + "&year=" + year + "&pcdm=" + pcdm,
                url: "http://www.squality.com/lqgl/index.php/Api/Inquire/chartsByPc?province=" + pid + "&year=" + year + "&pcdm=" + pcdm,
//                 url: "<?php echo U('Search/charts');?>&province=" + pid + "&year=" + year + "&pcdm=" + pcdm,
                type: 'get',
                dataType: 'jsonp',
                jsonp: "callback",
                success: function (result) {
                    if (result.msg == 1) {
                        var data = result.scoreList;
                    }
                    option.xAxis[0].data = data.year;
                    option.series[0].data = data.topScore;
                    option.series[1].data = data.lowScore;
                    option.series[2].data = data.aveScore;
                    MYCHART.setOption(option);
                    // if (data.topScore) {
                    //     option.yAxis[0].max = Math.max.apply(null, data.topScore);
                    // }
                    if (data.lowScore) {
                        option.yAxis[0].min = (Math.min.apply(null, data.lowScore)) * 1 - 10;
                    }
                    MYCHART.setOption(option);
                    $('#charts').show();
                    $('#icon-title').show();
                    $('.bottombox').css({'width': '90%', 'border': '0', 'margin-bottom': '0'});
                    $("#msg").html('<span style="color:#FF0000"></span>');
                },
                error: function () {
                    option.xAxis[0].data = [];
                    option.series[0].data = [];
                    option.series[1].data = [];
                    option.series[2].data = [];

                    MYCHART.setOption(option);
                    $('.bottombox').hide();
                }
            });
        }
    });
</script>

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