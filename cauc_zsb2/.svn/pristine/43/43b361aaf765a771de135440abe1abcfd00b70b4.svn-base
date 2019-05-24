<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>中国民航大学|网上报名 </title>
    <link rel="stylesheet" href="/cauc_zs3/zs/Public/Static/assets/layui/css/layui.css">
    <link rel="stylesheet" href="/cauc_zs3/zs/Public/Home/css/base2.css">
    </head>
<body class="layui-layout-body">
    <div style="margin: 22px 34px auto;float:left;">
        <img src="/cauc_zs3/zs/Public/Home/images/logo.png"/>
    </div>
    <!-- 内容主体区域 -->
    
    <div class="container" style="width: 540px;height: 437px;margin-top: 200px;">
        <div style="margin:auto;width: 77%;">
            <p style="font-size: 26px;color: #fff;text-align: center; margin:35px 35px 15px 35px;">用户登录/User login</p>
            <div class="input">
                <img src="/cauc_zs3/zs/Public/Home/images/user-name.png">
                <input class="input-text" type="number" name="phone" placeholder="请输入手机号">
            </div>
            <div class="input">
                <img src="/cauc_zs3/zs/Public/Home/images/user-password.png">
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
    
    <script src="/cauc_zs3/zs/Public/Static/assets/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['jquery','layer'], function(){
            var $ = layui.$,//jquery引入重点
                layer = layui.layer;
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
                                window,location.href = data.data.url;
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>