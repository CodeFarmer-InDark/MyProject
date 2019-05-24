<?php if (!defined('THINK_PATH')) exit();?><!-- taglib yc -->
<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <title><?php if(isset($moduleTitle)): echo ($moduleTitle); ?> -<?php endif; ?> <?php if(isset($cmsConfig)): echo ($cmsConfig["site_name"]); endif; ?> </title>
    <meta name="keywords" content="<?php echo ((isset($contentDetail["keyword"]) && ($contentDetail["keyword"] !== ""))?($contentDetail["keyword"]):$cmsConfig['seo_keyword']); ?>" />
    <meta name="description" content="<?php echo ((isset($contentDetail["description"]) && ($contentDetail["description"] !== ""))?($contentDetail["description"]):$cmsConfig['seo_description']); ?>" />
    <link rel="stylesheet" href="/cauc_zs3/lqgl/Public/Style/Style.css" type="text/css">

    <link rel="stylesheet" href="/cauc_zs3/lqgl/Public/Style/member.css" type="text/css">

    <link rel="stylesheet" href="/cauc_zs3/lqgl/Public/Style/promotion.css" type="text/css">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="/cauc_zs3/lqgl/Public/Js/Jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
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
                $('li.last_logined a#username').html('<img src="/cauc_zs3/lqgl/Public/Images/promotion/member_ico.jpg" alt="进入用户中心" id="img" />'+ username );
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





<script type="text/javascript">
    $(function(){
        $("li.last-child").css('display','none');
        $(".banner1").css('display','none');
    });
</script>
<div class="body clearfix">
    <div class="loginPage">
        <form method="post" action="<?php echo U('Login/doLogin');?>" id="loginform">
            <div class="login_title">用户登录/User login</div>
            <p>
                <input type="text" name="username" class="username" id="username" placeholder="请输入用户名">
            </p>
            <p>
                <input type="password" name="password" class="password" id="password" placeholder="请输入密码">
            </p>
            <p>
                <input type="submit" name="submit" class="submit" id="submit" value="登 录">
            </p>
            <div id="msg" style="margin-top:20px"></div>
        </form>
    </div>
</div>
</div>
<script language="JavaScript">
    $("#submit").click(function(){
        $.ajax({
            type:"POST",
            url:"<?php echo U('Login/doLogin');?>",
            data:{
                username:$('#username').val(),password:$('#password').val()
            },
            beforeSend:function(){
                $("#submit").addClass("disable");
                $("#submit").attr("disable","disable");
                $("#submit").attr("value","正在登录...");
            },
            success:function(data){
                switch(data)
                {
                    case 'emptyInfo':
                        $("#msg").html('<span style="color:#FF0000">用户名密码必须填写</span>');
                        break;
                    case 'falseAccess':
                        $("#msg").html('<span style="color:#FF0000">当前用户被限制，请联系管理员</span>');
                        break;
                    case 'loginSuccess':
                        $("#msg").html('<span style="color:#FF0000">登录成功</span>');
                        window.location.href = '<?php echo U("Index/index");?>';
                        return true;
                        break;
                    case 'false':
                        $("#msg").html('<span style="color:#FF0000">用户信息不存在，登录失败</span>');
                        break;
                    default:
                        $("#msg").html('<span style="color:#FF0000">'+data+'</span>');
                        alert ('未知错误，请联系管理员');
                }
                $("#submit").attr("disable","");
                $("#submit").attr("value","登  录");
                return false;
            }
        });
        return false;
    });
</script>
</body>
</html>