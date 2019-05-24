<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>中国民航大学|网上报名 </title>
    <link rel="stylesheet" href="/job/cauc_zs3/lqgl/Public/Static/assets/layui/css/layui.css">
    <link rel="stylesheet" href="/job/cauc_zs3/lqgl/Public/Home/css/base2.css">
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
    <div class="mobile-top" id="mobile-top"><img src="/job/cauc_zs3/lqgl/Public/Home/images/daohang.png" alt=""
            id="topImg"><span><?php echo ($moduleName); ?></span></div>
    <div class="leftMenu" id="leftMenu">
        <div class="left-top">
            <a href="<?php echo U('Index/index');?>"><img src="/job/cauc_zs3/lqgl/Public/Home/images/face.png" alt=""><?php echo session('user_name');?></a>
        </div>
        <ul class="mobileul">
            <li class="mobileli"><a href="<?php echo U('Index/index');?>" class="mobilenav"><img
                        src="/job/cauc_zs3/lqgl/Public/Home/images/member_index.png" alt="">报名入口</a></li>
            <li class="mobileli"><a href="<?php echo U('Index/modifypassword');?>" class="mobilenav"><img
                        src="/job/cauc_zs3/lqgl/Public/Home/images/member_pwd.png" alt="">修改密码</a></li>
            <li class="mobileli"><a href="<?php echo U('Index/modifyPhone');?>" class="mobilenav"><img
                        src="/job/cauc_zs3/lqgl/Public/Home/images/member_mobile.png" alt="">修改手机号</a></li>
            <li class="mobileli"><a href="<?php echo U('Auth/exitLogin');?>" class="mobilenav"><img
                        src="/job/cauc_zs3/lqgl/Public/Home/images/member_logout.png" alt="">退出登录</a></li>
        </ul>
        <!--<a href="<?php echo U('Index/about');?>" class="about"> &nbsp;&nbsp;&nbsp;关于</a>-->
    </div>
    <div class="logo-img" <?php if($header_css == 'Auth/register'): ?>id='header_css'<?php endif; ?>>
        <img src="/job/cauc_zs3/lqgl/Public/Home/images/logo.png" />
    </div>
    <!-- 内容主体区域 -->
    
    <div class="layui-header">
        <div class="jzb-a">
            <a href="<?php echo U('Index/index');?>">
                <img src="/job/cauc_zs3/lqgl/Public/Home/images/user.png" class="layui-nav-img">
                <span class="layui-text"><?php echo session('user_name');?></span>
            </a>
            <a id="xiugai" href="javascript:;">
                <img src="/job/cauc_zs3/lqgl/Public/Home/images/xiugaixinxi.png" class="layui-nav-img">
                <span class="layui-text">修改信息</span>
                <img src="/job/cauc_zs3/lqgl/Public/Home/images/duobianx.png" style="width: 15px;height: 15px;height: 12px;margin-bottom: 4px;" class="layui-nav-img">
            </a>
            <div id="xuanXiang">
                <a href="<?php echo U('Index/modifyPhone');?>">修改手机号</a>
                <a href="<?php echo U('Index/modifyPassword');?>">修改密码</a>
            </div>
            <a href="<?php echo U('Auth/exitLogin');?>">
                <img src="/job/cauc_zs3/lqgl/Public/Home/images/tuichu.png" style="height: 18px;" class="layui-nav-img">
                <span class="layui-text">退出登录</span>
            </a>
        </div>
    </div>
    <div class="user-center">
        <p style="font-size: 34px;color:#fff;text-align: center;margin-bottom: 35px;" id="p_entrance">报名入口</p>
        <div class='userBox'>
            <?php if(($kckb['registration_switch'] == 1) and ($kckb['bm_type'] == 3)): ?><a href="<?php echo U('Index/AeronauticalAttendants');?>" class="list">
                    <div class="picture-container">
                        <img src="/job/cauc_zs3/lqgl/Public/Home/images/kckb.png">
                    </div>
                    <div style="text-align: center;">
                        <p>空乘空保</p>
                        <p>Flight enrollment</p>
                    </div>
                </a><?php endif; ?>
            <?php if(isset($gsp)): ?><a href="<?php echo U('Index/highLevelAthletes');?>" class="list">
                <div class="picture-container">
                    <img src="/job/cauc_zs3/lqgl/Public/Home/images/ydy.png">
                </div>
                <div style="text-align: center;">
                    <p>高水平运动员</p>
                    <p>Senior athlete</p>
                </div>
            </a><?php endif; ?>
            
        <?php if(($zzy['registration_switch'] == 1) and ($zzy['bm_type'] == 1)): ?><a  href="javascript:;" data-id="1" class="list getInto">
                <div class="picture-container">
                    <img src="/job/cauc_zs3/lqgl/Public/Home/images/zzy.png">
                </div>
                <div style="text-align: center;">
                    <p>转专业</p>
                    <p>Change the profession</p>
                </div>
            </a><?php endif; ?>
        <?php if(($zo['registration_switch'] == 1) and ($zo['bm_type'] == 2)): ?><a  href="javascript:;" data-id="2" class="list last-child getInto">
                <div class="picture-container">
                    <img src="/job/cauc_zs3/lqgl/Public/Home/images/zoxb.png">
                </div>
                <div style="text-align: center;">
                    <p>中欧选拔</p>
                    <p>College selection</p>
                </div>
            </a><?php endif; ?>
        </div>
    </div>
    <div class="user-center1" style="display:none;">
        <div class='userBox'>
            <?php if(($kckb['registration_switch'] == 1) and ($kckb['bm_type'] == 3)): ?><a href="<?php echo U('Index/AeronauticalAttendants');?>" class="list">
                    <img src="/job/cauc_zs3/lqgl/Public/Home/images/cabin_icon.png">
                </a><?php endif; ?>
            <a href="<?php echo U('Index/highLevelAthletes');?>" class="list">
                <img src="/job/cauc_zs3/lqgl/Public/Home/images/athele_icon.png">
            </a>
            <?php if(($zzy['registration_switch'] == 1) and ($zzy['bm_type'] == 1)): ?><a href="javascript:;" data-id="1" class="list getInto">
                    <img src="/job/cauc_zs3/lqgl/Public/Home/images/shift_icon.png">
                </a><?php endif; ?>
            <?php if(($zo['registration_switch'] == 1) and ($zo['bm_type'] == 2)): ?><a href="javascript:;" data-id="2" class="list getInto">
                    <img src="/job/cauc_zs3/lqgl/Public/Home/images/select_icon.png">
                </a><?php endif; ?>
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <div class="footer-web-info">
            <span class="layui-text">版权所有：中国民航大学</span>
            <span class="layui-text">技术支持：天津盛扬信远科技有限公司</span>
        </div>
    </div>
    
    <script src="/job/cauc_zs3/lqgl/Public/Static/assets/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['jquery','layer'], function(){
            var $ = layui.$,//jquery引入重点
                layer = layui.layer;
            $('#xiugai').click(function () {
                if($('#xuanXiang').is(":hidden")){
                    $('#xuanXiang').show();
                }else{
                    $('#xuanXiang').hide();
                }
            });
            $('.getInto').click(function () {
                var type = $(this).attr('data-id');
                if (type == '1' || type == '2') {
                    $.ajax({
                        type:"POST",
                        url:"<?php echo U('Index/getInto');?>",
                        dataType: "json",
                        data:{
                            type:type
                        },
                        success:function(data){
                            if (data.code == 1) {
                                window.location.href = data.url;
                            }else {
                                layer.msg(data.msg,function () {
                                    window.location.reload();
                                });
                            }

                        }
                    });
                }
            });
        });
    </script>


    <!--pad端nav-->
    <script src="/job/cauc_zs3/lqgl/Public/Js/Jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
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