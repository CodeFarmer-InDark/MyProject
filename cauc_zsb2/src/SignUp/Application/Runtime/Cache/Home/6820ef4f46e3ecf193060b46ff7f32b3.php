<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>中国民航大学|网上报名 </title>
    <link rel="stylesheet" href="/job/cauc_zsb2/zsb/Public/Static/assets/layui/css/layui.css">
    <link rel="stylesheet" href="/job/cauc_zsb2/zsb/Public/Home/css/base1.css">
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
    <style type="text/css">
        .layui-header{
            height: 256px;
            background:url(/job/cauc_zsb2/zsb/Public/Home/images/banner.png);
            -moz-background-size:100% 100%;
            background-size:100% 100%;
        }
        .layui-layout-body{
            background:#f2f2f2;
            overflow: auto;
            font-family: inherit;
        }
        .layui-text{
            color: #fff;
            font-size: 16px;
            font-family: inherit;
        }
        .layui-footer{
            width:100%;
            /*position: absolute;*/
            bottom:0;
            left:0;
            background:url(/job/cauc_zsb2/zsb/Public/Home/images/footer.png);
            -moz-background-size:100% 100%;
            background-size:100% 100%;
            height:295px;
        }
        .footer-log{
            height: 96px;
            margin-top: 90px;
            float: left;
            margin-left: 26%;
        }
        .footer-web-info{
            padding-top: 70px;
            float: left;
            margin-left: 175px;
        }
        .footer-web-info span{
            display: -webkit-box;
            line-height: 35px;
            font-size: 15px;
        }
    </style>
    </head>
<body class="layui-layout-body">
    <div class="layui-header mobile-header">
        <div class="member-zzy">
            <div class="jzb-a">
                <a href="<?php echo U('Index/index');?>">
                    <img src="/job/cauc_zsb2/zsb/Public/Home/images/user.png" class="layui-nav-img">
                    <span class="layui-text"><?php echo session('user_name');?></span>
                </a>
                <a id="xiugai" href="javascript:;">
                    <img src="/job/cauc_zsb2/zsb/Public/Home/images/xiugaixinxi.png" class="layui-nav-img xiugai">
                    <span class="layui-text xiugai">修改信息</span>
                    <img src="/job/cauc_zsb2/zsb/Public/Home/images/duobianx.png" style="width: 15px;height: 15px;height: 12px;margin-bottom: 4px;" class="layui-nav-img xiugai">
                </a>
                <div id="xuanXiang">
                    <a href="<?php echo U('Index/modifyPhone');?>">修改手机号</a>
                    <a href="<?php echo U('Index/modifyPassword');?>">修改密码</a>
                </div>
                <a href="<?php echo U('Auth/exitLogin');?>">
                    <img src="/job/cauc_zsb2/zsb/Public/Home/images/tuichu.png" style="height: 18px;" class="layui-nav-img">
                    <span class="layui-text">退出登录</span>
                </a>
            </div>
            <div class="jzb-b">
                <img src="/job/cauc_zsb2/zsb/Public/Home/images/logo.png"/>
            </div>
            <div class="now-title">
                中欧选拔报名
            </div>
        </div>
    </div>
    <!-- 内容主体区域 -->
    <div class="container">
        
    <div class="dao-hang">
        <span class="layui-text"></span>
        <span class="layui-text">个人信息</span>
        <a class="layui-text" href="<?php echo U('Index/index');?>"> <<返回报名入口 </a>
    </div>

        
    <div style="display: inline-flex;width: 100%;" class="zo-box">
        <?php if($info['provinceid'] == 44): ?><img class="user-photo" src="/job/cauc_zsb2/zsb/kszp/<?php echo ($info['year']); ?>/<?php echo ($info['provinceid']); ?>/<?php echo ($url); echo ($info['ksh']); ?>.jpg">
            <?php else: ?>
            <img class="user-photo" src="/job/cauc_zsb2/zsb/kszp/<?php echo ($info['year']); ?>/<?php echo ($info['provinceid']); ?>/<?php echo ($info['ksh']); ?>.jpg"><?php endif; ?>
        <div class="user-info zo">
            <div>姓名：<?php echo ($info['xm']); ?></div>
            <div>高考成绩：<?php echo ceil($info['tdcj']);?></div>
            <div>性别：<?php echo ($info['xbmc']); ?></div>
            <div>高考所在地：<?php echo ($info['name']); ?></div>
            <div>身份证号：<?php echo ($info['sfzh']); ?></div>
            <div >手机号：<?php echo ($info['phone']); ?></div>
            <div >考生号：<?php echo ($info['ksh']); ?></div>
            <?php if(($bm == false) and ($data['bm_time_status'] == 1)): ?><div>QQ号：<input style="width: 200px;height: 40px;" type="number" id="qq"/></div>
                <?php else: ?>
                <div>QQ号：<?php echo ($bm['qq']); ?></div><?php endif; ?>
        </div>

        <div class="zzy-mobile-title">个人信息</div>
        <div class="zzy-mobile">
            <div class="thisDiv">
                <span class="about-title">姓名：</span>
                <span class="about-content"><?php echo ($info['xm']); ?></span>
            </div>
            <div class="thisDiv">
                <span class="about-title">性别：</span>
                <span class="about-content"><?php echo ($info['xbmc']); ?></span>
            </div>
            <div class="thisDiv">
                <span class="about-title">考生号：</span>
                <span class="about-content"><?php echo ($info['ksh']); ?></span>
            </div>
            <div class="thisDiv">
                <span class="about-title">身份证号：</span>
                <span class="about-content"><?php echo ($info['sfzh']); ?></span>
            </div>
            <div class="thisDiv">
                <span class="about-title">生源地：</span>
                <span class="about-content"><?php echo ($info['name']); ?></span>
            </div>
            <div class="thisDiv">
                <span class="about-title">高考成绩：</span>
                <span class="about-content"><?php echo ceil($info['tdcj']);?></span>
            </div>
            <div class="thisDiv">
                <span class="about-title">手机号：</span>
                <span class="about-content"><?php echo ($info['phone']); ?></span>
            </div>
            <?php if(($bm == false) and ($data['bm_time_status'] == 1)): ?><div class="thisDiv">
                    <span class="about-title">QQ号：</span>
                    <span class="about-content"><input style="width: 200px;height: 40px;padding-left:10px;" type="number" id="qq1" placeholder="请输入QQ号"/></span>
                </div>
                <?php else: ?>
                <div class="thisDiv">
                    <span class="about-title">QQ号：</span>
                    <span class="about-content"><?php echo ($bm['qq']); ?></span>
                </div><?php endif; ?>
        </div>
    </div>
    <?php if($data['bm_time_status'] == 1): if($bm == false): ?><div style="height: 172px;" class="zo-submit">
                <div id="college">
                </div>
                <a class="zzy-a-button" id="zotj" href="javascript:;">提交申请 </a>
            </div>
            <?php else: ?>
            <div class="zzy-xzbmb" style="display: flex;align-items: center;justify-content: center;font-size: 28px;color: red;">
                已报名
            </div><?php endif; ?>
        <?php else: ?>
        <div class="zzy-xzbmb" style="display: flex;align-items: center;justify-content: center;font-size: 28px;color: red;">
            报名已经结束,截止时间：<?php echo ($data['end_time']?(date('Y-m-d',$data['end_time'])):''); ?>
        </div><?php endif; ?>
    <!--<?php if(($bm == false) and ($data['bm_time_status'] == 1)): ?>-->
        <!--<div style="height: 172px;">-->
            <!--<div id="college">-->
            <!--</div>-->
            <!--<a class="zzy-a-button" id="zotj" href="javascript:;">提交申请 </a>-->
        <!--</div>-->
        <!--<?php else: ?>-->
        <!--<div class="zzy-xzbmb" style="display: flex;align-items: center;justify-content: center;font-size: 28px;color: red;">-->
            <!--报名已经结束,截止时间：<?php echo ($data['end_time']?(date('Y-m-d',$data['end_time'])):''); ?>-->
        <!--</div>-->
    <!--<?php endif; ?>-->

    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <div class="footer-log">
            <img src="/job/cauc_zsb2/zsb/Public/Home/images/logo.png"/>
        </div>
        <div class="footer-web-info">
            <span class="layui-text">工作邮箱：325847154@qq.com</span>
            <span class="layui-text">联系电话：15547895472</span>
            <span class="layui-text">版权所有：中国民航大学</span>
            <span class="layui-text">技术支持：天津盛扬信远科技有限公司</span>
        </div>
    </div>
    <script src="/job/cauc_zsb2/zsb/Public/Static/assets/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['jquery','layer'], function(){
            var $ = layui.$,//jquery引入重点
                layer = layui.layer;
            $('.layui-text.xiugai').click(function () {
                xiugai();
            });
            $('.layui-nav-img.xiugai').click(function () {
                xiugai();
            });
            function xiugai() {
                if($('#xuanXiang').is(":hidden")){
                    $('#xuanXiang').show();
                }else{
                    $('#xuanXiang').hide();
                }
            }
        });
    </script>
    
    <?php if($bm_info == false): ?><script type="text/javascript">
            layui.use(['jquery','layer'], function(){
                var $ = layui.$,//jquery引入重点
                    layer = layui.layer;
                $('#zotj').click(function () {
                    var qq;
                    var qq1 = $('#qq').val();
                    var qq2 = $('#qq1').val();
                    if (qq1 == '' && qq2 == ''){
                        layer.msg('请填写QQ号');
                        return false;
                    }else if(qq1 == '' && qq2 != ''){
                        qq = qq2;
                    }else if(qq1 != '' && qq2 == ''){
                        qq = qq1;
                    }else{
                        layer.msg('请填写QQ号');
                        return false;
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo U('Index/SubSignUp');?>",
                        dataType: "json",
                        data:{
                            qq:qq,type:2
                        },
                        success:function(data){
                            layer.msg(data.msg,function () {
                                if (data.code == 1) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                });
            });
        </script><?php endif; ?>


</body>
</html>