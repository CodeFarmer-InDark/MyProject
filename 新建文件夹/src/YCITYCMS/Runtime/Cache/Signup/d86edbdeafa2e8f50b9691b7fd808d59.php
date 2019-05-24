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
    
    <div class="layui-header">
        <div class="jzb-a">
            <a href="<?php echo U('Index/index');?>">
                <img src="__PUBLIC__/Home/images/user.png" class="layui-nav-img">
                <span class="layui-text"><?php echo session('user_name');?></span>
            </a>
            <a id="xiugai" href="javascript:;">
                <img src="__PUBLIC__/Home/images/xiugaixinxi.png" class="layui-nav-img">
                <span class="layui-text">修改信息</span>
                <img src="__PUBLIC__/Home/images/duobianx.png" style="width: 15px;height: 15px;height: 12px;margin-bottom: 4px;" class="layui-nav-img">
            </a>
            <div id="xuanXiang">
                <a href="<?php echo U('Index/modifyPhone');?>">修改手机号</a>
                <a href="<?php echo U('Index/modifyPassword');?>">修改密码</a>
            </div>
            <a href="<?php echo U('Auth/exitLogin');?>">
                <img src="__PUBLIC__/Home/images/tuichu.png" style="height: 18px;" class="layui-nav-img">
                <span class="layui-text">退出登录</span>
            </a>
        </div>
    </div>
    <div class="container modifyphone" style="width: 540px;height: 437px!important;margin-top: 200px;">
        <div id="touMingCen" style="margin:auto;width: 77%;">
            <p style="font-size: 26px;color: #fff;text-align: center; margin:35px 35px 15px 35px;">修改手机号</p>
            <div class="input">
                <input class="input-text" type="number" name="phone" placeholder="请输入新的手机号">
            </div>
            <div class="input-code">
                <div class="input" style="width: 200px;margin: 0;float: left;">
                    <input class="input-text" type="text" name="verify_code" placeholder="图形验证码">
                </div>
                <div class="input-sms-code">
                    <img src="<?php echo U('Home/Wx/verify');?>" title="如果您无法识别验证码，请点图片更换" id="verifyImage" style="width: 178px;border-radius: 15px;">
                </div>
            </div>
            <div class="input-code">
                <div class="input" style="width: 200px;margin: 0;float: left;">
                    <input class="input-text" type="text" name="sms_code" placeholder="请填写验证码">
                </div>
                <div class="input-sms-code">
                    <input type="button" class="input-submit" id="getCode" style="font-size: 16px;" value="获取验证码"/>
                </div>
            </div>
            <button type="button" style="margin: 30px auto;" id="confirmation" class="input-submit">确认修改</button>
        </div>
    </div>

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
                $("#verifyImage").attr('src', "<?php echo U('Home/Wx/verify',0,0,0);?>/"+ Math.random());
            }
            $('#xiugai').click(function () {
                if($('#xuanXiang').is(":hidden")){
                    $('#xuanXiang').show();
                }else{
                    $('#xuanXiang').hide();
                }
            });
            $('#getCode').click(function () {
                var sfzh = "<?php echo ($sfzh); ?>";
                var phone = $("input[name='phone']").val();
                var verify_code = $("input[name='verify_code']").val();
                if (!phone.match(/^0?1[0-9]{10}$/)) {
                    layer.msg('手机号码错误，请检查后重新填写。');
                    $("input[name='phone']").focus();
                    return false;
                }else if('' == verify_code){
                    layer.msg('请填写图形验证码');
                    $("input[name='verify_code']").focus();
                    return false;
                }
                settime($(this));
                $.ajax({
                    type:"POST",
                    url:"<?php echo U('Auth/sendSMS');?>",
                    dataType: "json",
                    data:{
                        phone:phone,type:"modifyPhone",sfzh:sfzh,verify_code:verify_code
                    },
                    success:function(data){
                        layer.msg(data.msg);
                    }
                });
            });
            $('#confirmation').click(function () {
                var phone = $("input[name='phone']").val();
                var sms_code = $("input[name='sms_code']").val();
                var verify_code = $("input[name='verify_code']").val();
                if (!phone.match(/^0?1[0-9]{10}$/)) {
                    layer.msg('手机号码错误，请检查后重新填写。');
                    return false;
                }else if('' == verify_code){
                    layer.msg('请填写图形验证码');
                    return false;
                }else if (sms_code == "") {
                    layer.msg('请填写验证码');
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"<?php echo U('Index/modifyPhone');?>",
                    dataType: "json",
                    data:{
                       phone:phone,sms_code:sms_code,redirect_uri:"<?php echo ($redirect_uri); ?>"
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
            var countdown=60;
            function settime(obj) { //发送验证码倒计时
                if (countdown == 0) {
                    obj.attr('disabled',false);
                    obj.css('cursor','');
                    //obj.removeattr("disabled");
                    obj.val("获取验证码");
                    countdown = 60;
                    return;
                } else {
                    obj.attr('disabled',true);
                    obj.css('cursor','not-allowed');
                    obj.val("重新发送(" + countdown + ")");
                    countdown--;
                }
                setTimeout(function() {settime(obj)},1000)
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