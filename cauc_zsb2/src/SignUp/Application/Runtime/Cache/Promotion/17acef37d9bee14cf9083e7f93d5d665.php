<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <title><?php if(isset($moduleTitle)): echo ($moduleTitle); ?> -<?php endif; ?> <?php if(isset($cmsConfig)): echo ($cmsConfig["site_name"]); ?> -<?php endif; ?> <?php echo ($cmsConfig["seo_title"]); ?> </title>
    <meta name="keywords" content="<?php echo ((isset($contentDetail["keyword"]) && ($contentDetail["keyword"] !== ""))?($contentDetail["keyword"]):$cmsConfig['seo_keyword']); ?>" />
    <meta name="description" content="<?php echo ((isset($contentDetail["description"]) && ($contentDetail["description"] !== ""))?($contentDetail["description"]):$cmsConfig['seo_description']); ?>" />
    <link rel="stylesheet" href="/cauc_zs3/zs/Public/Style/Style.css" type="text/css">

    <link rel="stylesheet" href="/cauc_zs3/zs/Public/Style/member.css" type="text/css">

    <link rel="stylesheet" href="/cauc_zs3/zs/Public/Style/promotion.css" type="text/css">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="/cauc_zs3/zs/Public/Js/Jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script language="javascript">
        function setcookie(name,value){
            var Days = 30;
            var exp  = new Date();
            exp.setTime(exp.getTime() + Days*24*60*60*1000);
            document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
        }
        function getcookie(name){
            var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
            if(arr != null){
                return decodeURI(arr[2]);
            }else{
                return "";
            }
        }
        function delcookie(name){
            var exp = new Date();
            exp.setTime(exp.getTime() - 1);
            var cval=getCookie(name);
            if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
        }
        function subString(str, len, hasDot){
            var newLength = 0;
            var newStr = "";
            var chineseRegex = /[^\x00-\xff]/g;
            var singleChar = "";
            var strLength = str.replace(chineseRegex,"**").length;
            for(var i = 0;i < strLength;i++){
                singleChar = str.charAt(i).toString();
                if(singleChar.match(chineseRegex) != null){
                    newLength += 2;
                }else{
                    newLength++;
                }
                if(newLength > len){
                    break;
                }
                newStr += singleChar;
            }
            if(hasDot && strLength > len){
                newStr += "...";
            }
            return newStr;
        }
        function showlogin()
        {
            var auth = getcookie('YC_auth');
            if(auth != ''){
                var username = decodeURIComponent(getcookie('YC_username'));
                $('li.last_logined a#username').html('<img src="/cauc_zs3/zs/Public/Images/promotion/member_ico.jpg" alt="进入用户中心" id="img" />'+ username );
                $('li.last_logined').show();
            }else{
                $('li.last_logined').hide();
            }
        }
        $(function(){
            showlogin();
        });
    </script>
</head>
<body>
<div id="wrap" class="mobile-wrap">





<body>
<div id="wrap1">
    <div class="header loginBox">
        <div class="nav_pc">
            <div class="nav1">
                <ul class="contentnav">
                    <li class="last_logined"><a href="<?php echo U('Login/logout');?>" class="memberIco"><img src="/cauc_zs3/zs/Public/Images/promotion/loginout_ico.jpg" alt="退出登录">退出登录</a></li>
                    <li class="last_logined toleft"><a href="<?php echo U('Index/info');?>" class="memberIco" id="username"></a></li>

                    <li class="on"><a href="#" class="nav <?php if($controllerName == 'Query'): ?>checked<?php endif; ?>" >录取查询</a></li>
                    <li class="on"><a href="<?php echo U('Index/info');?>" class="nav <?php if($controllerName == 'IndexInfo'): ?>checked<?php endif; ?>">个人资料</a></li>
                    <li class="on"><a href="<?php echo U('Signup/history');?>" class="nav <?php if($controllerName == 'SignupHistory'): ?>checked<?php endif; ?>">历史报名</a></li>
                    <li class="on1"><a href="<?php echo U('Signup/index');?>" class="nav <?php if($controllerName == 'Signup'): ?>checked<?php endif; ?>">报名</a></li>
                    <li class="on1"><a href="<?php echo U('Index/index');?>" class="nav <?php if($controllerName == 'Index'): ?>checked<?php endif; ?>">首页</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="body grey">
    <div class="register pad fff bottom" style="min-height:400px;">
        <div class="rtitle">
            <span class="t1">报名详情</span>
        </div>
        <div class="infobox">
            <ul class="uleft">
                <li>年份：<?php echo ($vo["year"]); ?>年</li>
                <li>中学代码：<?php echo ($vo["zxdm"]); ?></li>
                <li>报名时间：<?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></li>
            </ul>
            <ul class="uleft">
                <li>省份：<?php echo ($vo["pname"]); ?></li>
                <li>中学名称：<?php echo ($vo["zxmc"]); ?></li>
                <li>审核状态：
                <?php switch($vo['status']): case "1": ?><span style="color: #ff0000;">待审核</span><?php break;?>
                    <?php case "2": ?><span style="color: #7bd22e;">通过</span><?php break;?>
                    <?php case "3": ?><span style="color: #ff0000;">未通过</span><?php break; endswitch;?>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
    <footer>
    	<div class="footer">
            <div class="left_content">

            </div>
        </div>
    </footer>
</body>
</html>