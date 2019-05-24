<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>中国民航大学|网上报名 </title>
    <link rel="stylesheet" href="/job/cauc_zsb2/zsb/Public/Static/assets/layui/css/layui.css">
    <link rel="stylesheet" href="/job/cauc_zsb2/zsb/Public/Home/css/base2.css">
    <style>
        @media (min-width: 800px) and (max-width: 1100px) {
            #header_css {
                margin: 50px auto 0 auto;
            }
        }
    </style>

    <!--[if lte IE 9]>
    <style type="text/css">
        #ie6nomore,#ie6-tips,#ie6-dl,#ie6-tips p{float:left}
        #ie6nomore{width:100%;height:66px;background-color:#2A2A2A;color:#CCC;font-size:12px;font-family:Verdana, Geneva, sans-serif}
        #ie6nomore a{text-decoration:none;color:#A8C779; height:30px;}
        #ie6-content{width:900px;margin:0 auto}
        #ie6-tips{width:500px}
        #ie6-tips p{text-align:left;height:28px}
        #ie6{margin:8px 0 -8px}
        #up{font-weight:700;width:500px}
        #ie6-dl{width:400px;margin-top:18px}
        #ie6-dl span{margin-left:30px}
    </style>

    <div id="ie6nomore">
        <div id="ie6-content">
            <div id="ie6-tips">
                <p id="ie6">请注意：您正在使用 IE内核 浏览器</p>
                <p id="up">如果你的使用的是双核浏览器，请切换到极速模式访问，否则为获取更好展示效果，建议升级至IE10或更换另一款浏览器，给您带来不便请见谅</p>
                <p id="up"></p>
            </div>
            <div id="ie6-dl">
                <span><a rel="nofollow" href='http://www.google.cn/' title='下载 Google Chrome' target='_blank'>谷歌</a></span>
                <span><a rel="nofollow" href='http://www.uc.cn/ucbrowser/download/' title='下载 UC' target='_blank'>UC浏览器</a></span>
                <span><a rel="nofollow" href='http://www.firefox.com' title='下载 Firefox' target='_blank'>火狐</a></span>
            </div>
        </div>
    </div>
    <![endif]-->
</head>

<body class="layui-layout-body">
    <div class="mobile-top" id="mobile-top"><img src="/job/cauc_zsb2/zsb/Public/Home/images/daohang.png" alt=""
            id="topImg"><span><?php echo ($moduleName); ?></span></div>
    <div class="leftMenu" id="leftMenu">
        <div class="left-top">
            <a href="<?php echo U('Index/index');?>"><img src="/job/cauc_zsb2/zsb/Public/Home/images/face.png" alt=""><?php echo session('user_name');?></a>
        </div>
        <ul class="mobileul">
            <li class="mobileli"><a href="<?php echo U('Index/index');?>" class="mobilenav"><img
                        src="/job/cauc_zsb2/zsb/Public/Home/images/member_index.png" alt="">报名入口</a></li>
            <li class="mobileli"><a href="<?php echo U('Index/modifypassword');?>" class="mobilenav"><img
                        src="/job/cauc_zsb2/zsb/Public/Home/images/member_pwd.png" alt="">修改密码</a></li>
            <li class="mobileli"><a href="<?php echo U('Index/modifyPhone');?>" class="mobilenav"><img
                        src="/job/cauc_zsb2/zsb/Public/Home/images/member_mobile.png" alt="">修改手机号</a></li>
            <li class="mobileli"><a href="<?php echo U('Auth/exitLogin');?>" class="mobilenav"><img
                        src="/job/cauc_zsb2/zsb/Public/Home/images/member_logout.png" alt="">退出登录</a></li>
        </ul>
        <!--<a href="<?php echo U('Index/about');?>" class="about"> &nbsp;&nbsp;&nbsp;关于</a>-->
    </div>
    <div class="logo-img" <?php if($header_css == 'Auth/register'): ?>id='header_css'<?php endif; ?>>
        <img src="/job/cauc_zsb2/zsb/Public/Home/images/logo.png" />
    </div>
    <!-- 内容主体区域 -->
    
    <div class="container logincon">
        <div class="containerBox">
            <p class="login-title">用户登录/User login</p>
            <div class="input">
                <img src="/job/cauc_zsb2/zsb/Public/Home/images/user-name.png">
                <input class="input-text" type="number" name="phone" placeholder="请输入手机号">
            </div>
            <div class="input">
                <img src="/job/cauc_zsb2/zsb/Public/Home/images/user-password.png">
                <input class="input-text" type="password" name="password" placeholder="请输入密码">
            </div>
            <div style="margin: 30px auto;">
                <a style="color:#fff; font-size: 15px;" href="<?php echo U('Auth/register');?>">注册账号</a>
                <a style="color:#fff; font-size: 15px; float: right;" href="<?php echo U('Auth/forgotpassword');?>">忘记密码?</a>
            </div>
            <button type="button" class="input-submit" id="doLogin">登录</button>
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <div class="footer-web-info">
            <span class="layui-text">版权所有：中国民航大学</span>
            <span class="layui-text">技术支持：天津盛扬信远科技有限公司</span>
        </div>
    </div>
    
    <style>
        .input{ height: 55px;margin: 40px auto 40px auto;}
        #doLogin{height:50px;}
        .mobile-top{display:none;}
    </style>
    <script src="/job/cauc_zsb2/zsb/Public/Static/assets/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['jquery','layer'], function(){
            var $ = layui.$,//jquery引入重点
                layer = layui.layer;

            /*var islogin = "<?php echo ($logined); ?>";
            if (islogin == 1){
                $('#doLogin').css('background','#ccc');
                $('#doLogin').css('cursor','default');
                $('#doLogin').attr('disabled',true);
                layer.msg('已登录',function () {
                    //window.location.href = "<?php echo U('Index/index');?>";
                });
            }*/

            $('#doLogin').click(function () {
                var phone = $("input[name='phone']").val();
                var password = $("input[name='password']").val();
                if (phone == "") {
                    layer.msg('请输入用户名');
                    return false;
                }
                if (password == "") {
                    layer.msg('请输入密码');
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"<?php echo U('Auth/login');?>",
                    dataType: "json",
                    data:{
                        phone:phone,password:password
                    },
                    success:function(data){
                        layer.msg(data.msg,function () {
                            if (data.code == 1) {
                                window.location.href = data.data.url;
                            }
                        });
                    }
                });
            });
        });
    </script>


    <!--pad端nav-->
    <script src="/job/cauc_zsb2/zsb/Public/Js/Jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('.mobile-top').on('click', function () {
            $('.leftMenu').toggle();
        });
        $('body').bind('click', function (event) {
            // IE支持 event.srcElement ， FF支持 event.target
            var evt = event.srcElement ? event.srcElement : event.target;
            if (evt.id == 'leftMenu' || evt.id == 'mobile-top' || evt.id == 'topImg') return; // 如果是元素本身，则返回
            else {
                $('#leftMenu').hide(); // 如不是则隐藏元素
            }
        });

    </script>
</body>

</html>