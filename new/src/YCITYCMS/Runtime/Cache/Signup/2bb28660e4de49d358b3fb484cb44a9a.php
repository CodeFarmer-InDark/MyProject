<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>中国民航大学|网上报名</title>
    <link rel="stylesheet" href="__STATIC__/assets/layui/css/layui.css">
    <link rel="stylesheet" href="__PUBLIC__/Home/css/base2.css">
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
    <div class="mobile-top" id="mobile-top"><img src="__PUBLIC__/Home/images/daohang.png" alt=""
            id="topImg"><span><?php echo ($moduleName); ?></span></div>
    <div class="leftMenu" id="leftMenu">
        <div class="left-top">
            <a href="<?php echo U('Index/index');?>"><img src="__PUBLIC__/Home/images/face.png" alt=""><?php echo session('user_name');?></a>
        </div>
        <ul class="mobileul">
            <li class="mobileli"><a href="<?php echo U('Index/index');?>" class="mobilenav"><img
                        src="__PUBLIC__/Home/images/member_index.png" alt="">报名入口</a></li>
            <li class="mobileli"><a href="<?php echo U('Index/modifypassword');?>" class="mobilenav"><img
                        src="__PUBLIC__/Home/images/member_pwd.png" alt="">修改密码</a></li>
            <li class="mobileli"><a href="<?php echo U('Index/modifyPhone');?>" class="mobilenav"><img
                        src="__PUBLIC__/Home/images/member_mobile.png" alt="">修改手机号</a></li>
            <li class="mobileli"><a href="<?php echo U('Auth/exitLogin');?>" class="mobilenav"><img
                        src="__PUBLIC__/Home/images/member_logout.png" alt="">退出登录</a></li>
        </ul>
        <!--<a href="<?php echo U('Index/about');?>" class="about"> &nbsp;&nbsp;&nbsp;关于</a>-->
    </div>
    <div class="logo-img" <?php if($header_css == 'Auth/register'): ?>id='header_css'<?php endif; ?>>
        <img src="__PUBLIC__/Home/images/logo.png" />
    </div>
    <!-- 内容主体区域 -->
    
    <div class="container registerBox">
        <div class="containerBox">
            <p class="login-title">用户注册/User registration</p>
            <div class="input">
                <img src="__PUBLIC__/Home/images/user-name.png" class="userImg">
                <input class="input-text" type="text" name="user_name" placeholder="请输入姓名 (须与高考报名一致)">
            </div>
            <div class="input">
                <img src="__PUBLIC__/Home/images/sfzh.png" class="idCardImg">
                <input class="input-text" type="text" name="id_number" placeholder="请输入身份证号">
            </div>
            <div class="input">
                <img src="__PUBLIC__/Home/images/user-password.png" class="userImg">
                <input class="input-text" type="password" name="password" placeholder="请输入密码 (6-16位任意字符，请牢记)">
            </div>
            <div class="input">
                <img src="__PUBLIC__/Home/images/user-password.png" class="userImg">
                <input class="input-text" type="password" name="opassword" placeholder="请确认密码">
            </div>
            <div class="input-code">
                <div class="input verifyCode">
                    <input class="input-text" type="text" name="verify_code" placeholder="图形验证码">
                </div>
                <div class="input-sms-code">
                    <img src="<?php echo U('Signup/Wx/verify');?>" title="如果您无法识别验证码，请点图片更换" id="verifyImage">
                </div>
            </div>
            <div class="input">
                <img src="__PUBLIC__/Home/images/sjh.png" class="mobileImg">
                <input class="input-text" type="number" name="phone" placeholder="手机号">
            </div>
            <small>此手机号将作为您的安全手机，用于登录系统、找回密码和接收短信通知。</small>
            <div class="input-code smscode">
                <div class="input verifyCode">
                    <input class="input-text" type="text" name="sms_code" placeholder="短信验证码">
                </div>
                <div class="input-sms-code">
                    <input type="button" class="input-submit" id="getCode" style="font-size: 16px;" value="获取验证码"/>
                </div>
            </div>

                <a style="color:#fff; font-size: 15px;" class="register_title" href="<?php echo U('Auth/login');?>">已有账号去登陆</a>

            <button type="button" id="doRegister" class="input-submit">注册</button>
        </div>
    </div>
    <style>
        small{color:#aeaeae;margin-left:15px;}
        .mobile-top{display:none;}
    </style>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <div class="footer-web-info">
            <span class="layui-text">版权所有：中国民航大学</span>
            <span class="layui-text">技术支持：天津盛扬信远科技有限公司</span>
        </div>
    </div>
    
    <script src="__STATIC__/assets/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['jquery','layer'], function(){
            var $ = layui.$,//jquery引入重点
                layer = layui.layer;

            $("#verifyImage").click(function(){
                resetVerifyCode();
            });
            function resetVerifyCode()
            {
                $("#verifyImage").attr('src', "<?php echo U('Signup/Wx/verify',0,0,0);?>/"+ Math.random());
            }
            $("input[name='user_name']").blur(function(){
                var user_name = $("input[name='user_name']").val();
                if (user_name == ''){
                    layer.msg('姓名必填');
                    $("input[name='user_name']").focus();
                    $("input[name='user_name']").val('');
                }else{
                    if(user_name.indexOf("·") != -1){
                        user_name = user_name.replace("·","");
                    }
                    var ret=true;
                    for(var i=0;i<user_name.length;i++){
                        ret=ret && (user_name.charCodeAt(i)>=10000);
                    }
                    if (ret == false){
                        layer.msg('姓名必须为汉字');
                        $("input[name='user_name']").focus();
                        $("input[name='user_name']").val('');
                        return false;
                    }else{
                        if(user_name.length < 2 || user_name.length > 10){
                            layer.msg('姓名字数不得少于2个且不多于10个');
                            $("input[name='user_name']").focus();
                            $("input[name='user_name']").val('');
                            return false;
                        }
                    }
                }
            });
            $("input[name='opassword']").blur(function(){
                var password = $("input[name='password']").val();
                var opassword = $("input[name='opassword']").val();
                if (password != opassword) {
                    layer.msg('两次输入密码不一致');
                    $("input[name='opassword']").focus();
                    return false;
                }
            });
            $('#getCode').click(function () {
                var phone = $("input[name='phone']").val();
                var sfzh = $("input[name='id_number']").val();
                var verify_code = $("input[name='verify_code']").val();
                if (!phone.match(/^0?1[0-9]{10}$/)) {
                    layer.msg('手机号码错误，请检查后重新填写。');
                    $("input[name='phone']").focus();
                    return false;
                }else if('' == sfzh) {
                    layer.msg('请填写身份证号码');
                    $("input[name='id_number']").focus();
                    return false;
                }else if('' == verify_code){
                    layer.msg('请填写图形验证码');
                    $("input[name='verify_code']").focus();
                    return false;
                }
                settime($(this));
                var obj = $('#getCode');
                $.ajax({
                    type:"POST",
                    url:"<?php echo U('Auth/sendSMS');?>",
                    dataType: "json",
                    data:{
                        phone:phone,type:"register",verify_code:verify_code,sfzh:sfzh
                    },
                    success:function(data){
                        layer.msg(data.msg);
                        if (data.code != 1){
                            //settime($(this));
                            resetVerifyCode();
                            $("input[name='sms_code']").val("");
                            $("input[name='verify_code']").val("");
                        }
                    },
                    error:function(){
                        layer.msg('网络错误');
                    }
                });
            });
            $('#doRegister').click(function () {
                var user_name = $("input[name='user_name']").val();
                var user_name1 = $("input[name='user_name']").val();
                var id_number = $("input[name='id_number']").val();
                var password = $("input[name='password']").val();
                var opassword = $("input[name='opassword']").val();
                var phone = $("input[name='phone']").val();
                var sms_code = $("input[name='sms_code']").val();
                var verify_code = $("input[name='verify_code']").val();
                if (user_name == "") {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('请填写姓名');
                    return false;
                }else{
                    if(user_name.indexOf("·") != -1){
                        user_name = user_name.replace("·","");
                    }
                    var ret=true;
                    for(var i=0;i<user_name.length;i++){
                        ret=ret && (user_name.charCodeAt(i)>=10000);
                    }
                    if (ret == false){
                        layer.msg('姓名必须为汉字');
                        $("input[name='user_name']").focus();
                        $("input[name='user_name']").val('');
                        return false;
                    }else{
                        if(user_name.length < 2 || user_name.length > 10){
                            layer.msg('姓名字数不得少于2个且不多于10个');
                            $("input[name='user_name']").focus();
                            $("input[name='user_name']").val('');
                            return false;
                        }
                    }
                }
                if (id_number == "") {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('请填身份证号');
                    return false;
                }
                if (verify_code == "") {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('请填写图形验证码');
                    return false;
                }
                if (phone == "") {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('请填写手机号');
                    return false;
                }
                if (password == "") {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('请输入密码');
                    return false;
                }
                if (password.length < 6 || password.length > 16){
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('密码必须为6-16位');
                    return false;
                }
                if (password != opassword) {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('两次输入密码不一致');
                    return false;
                }
                if (sms_code == "") {
                    resetVerifyCode();
                    $("input[name='sms_code']").val("");
                    $("input[name='verify_code']").val("");
                    layer.msg('请填写短信验证码');
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"<?php echo U('Auth/register');?>",
                    dataType: "json",
                    data:{
                        user_name:user_name1,id_number:id_number,phone:phone,password:password,opassword:opassword,sms_code:sms_code,verify_code:verify_code
                    },
                    success:function(data){
                        layer.msg(data.msg,function () {
                            if (data.code == 1) {
                                window.location.href = data.data.url;
                            }
                        });
                    },error:function()
                    {
                        layer.alert('fail')
                    }
                });
            });
            var countdown=60;
            function settime(obj) { //发送验证码倒计时
                if (countdown == 0) {
                    obj.attr('disabled',false);
                    //obj.removeattr("disabled");、
                    obj.css('cursor','pointer');
                    obj.val("获取验证码");
                    countdown = 60;
                    return;
                } else {
                    obj.attr('disabled',true);
                    obj.css('cursor','not-allowed');
                    obj.val("重新发送(" + countdown + ")");
                    countdown--;
                }
                setTimeout(function() {settime(obj) },1000);//每秒递归，60秒，59秒，58秒...
            }
        });
    </script>


    <!--pad端nav-->
    <script src="__PUBLIC__/Js/Jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
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