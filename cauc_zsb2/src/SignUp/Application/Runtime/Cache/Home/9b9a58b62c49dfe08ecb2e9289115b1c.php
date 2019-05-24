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
                转专业报名
            </div>
        </div>
    </div>
    <!-- 内容主体区域 -->
    <div class="container">
        
    <div class="dao-hang">
        <span class="layui-text"></span>
        <span class="layui-text"><?php if($bm_info == false): ?>个人信息<?php else: ?>报名表预览<?php endif; ?></span>
        <a class="layui-text" href="<?php echo U('Index/index');?>"> <<返回报名入口 </a>
    </div>

        
    <div style="height: 490px;display: inline-flex;width: 100%;" class="zzy-detail">
        <?php if($info['provinceid'] == 44): ?><img class="user-photo" src="/job/cauc_zsb2/zsb/kszp/<?php echo ($info['year']); ?>/<?php echo ($info['provinceid']); ?>/<?php echo ($url); echo ($info['ksh']); ?>.jpg">
            <?php else: ?>
            <img class="user-photo" src="/job/cauc_zsb2/zsb/kszp/<?php echo ($info['year']); ?>/<?php echo ($info['provinceid']); ?>/<?php echo ($info['ksh']); ?>.jpg"><?php endif; ?>
        <div class="user-info">
            <table border="1" class="zzy-pc">
                <tr>
                    <td>姓名：<?php echo ($info['xm']); ?></td>
                    <td>生源地：<?php echo ($info['name']); ?></td>
                </tr>
                <tr>
                    <td>性别：<?php echo ($info['xbmc']); ?></td>
                    <td>学院：<?php echo ($info['collegeName']); ?></td>
                </tr>
                <tr>
                    <td>学号：<?php echo ($info['xh']); ?></td>
                    <td>班级：<?php echo ($info['bj']); ?></td>
                </tr>
                <tr>
                    <td>身份证号：<?php echo ($info['sfzh']); ?></td>
                    <td>考生号：<?php echo ($info['ksh']); ?></td>
                </tr>
                <tr>
                    <td>投档成绩：<?php echo ($info['tdcj']); ?></td>
                    <td>科类：<?php echo ($info['kl']); ?></td>
                </tr>
                <tr>
                    <td>录取专业：<?php echo ($info['zyname']); ?></td>
                    <td>手机号：<?php echo ($info['phone']); ?></td>
                </tr>
                <?php if($bm_info != false): ?><tr>
                        <td>志愿一：<?php echo ($bm_info['zy_one_mc']); ?></td>
                        <td>志愿二：<?php echo ($bm_info['zy_two_mc']); ?></td>
                    </tr><?php endif; ?>
            </table>

            <div class="zzy-mobile-title">报名信息预览</div>
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
                    <span class="about-title">学号：</span>
                    <span class="about-content"><?php echo ($info['xh']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">班级：</span>
                    <span class="about-content"><?php echo ($info['bj']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">生源地：</span>
                    <span class="about-content"><?php echo ($info['name']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">学院：</span>
                    <span class="about-content"><?php echo ($info['collegeName']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">录取专业：</span>
                    <span class="about-content"><?php echo ($info['zyname']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">科类：</span>
                    <span class="about-content"><?php echo ($info['kl']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">投档成绩：</span>
                    <span class="about-content"><?php echo ($info['tdcj']); ?></span>
                </div>
                <div class="thisDiv">
                    <span class="about-title">手机号：</span>
                    <span class="about-content"><?php echo ($info['phone']); ?></span>
                </div>
                <?php if($bm_info != false): ?><div class="thisDiv">
                        <span class="about-title">志愿一：</span>
                        <span class="about-content"><?php echo ($bm_info['zy_one_mc']); ?></span>
                    </div>
                    <div class="thisDiv">
                        <span class="about-title">志愿二：</span>
                        <span class="about-content"><?php echo ($bm_info['zy_two_mc']); ?></span>
                    </div><?php endif; ?>
            </div>
        </div>
    </div>

    <?php switch($user_bm_status): case "1": ?><div class="dao-hang">
                <span class="layui-text"></span>
                <span class="layui-text">说明</span>
            </div>
            <div class="zzy-mobile-title">说明</div>
            <div style="height:auto;line-height:30px;" class="zzy-remark">
                <h3 style="color: #565353;margin:30px 0 30px 45px;"><?php echo ($remark); ?></h3>
            </div>
            <div class="zzy-xzbmb">
                <a class="zzy-a-button" id="xzbmb" href="javascript:;">下载报名表</a>
            </div><?php break;?>
        <?php case "2": ?><div class="dao-hang">
                <span class="layui-text"></span>
                <span class="layui-text">说明</span>
            </div>
            <div class="zzy-mobile-title">说明</div>
            <div style="height:150px;line-height:30px;" class="zzy-remark">
                <h3 style="color: #565353;margin:30px 0 30px 45px;">体检合格，转入一志愿。</h3>
            </div><?php break;?>
        <?php case "3": ?><div class="dao-hang">
                <span class="layui-text"></span>
                <span class="layui-text">说明</span>
            </div>
            <div class="zzy-mobile-title">说明</div>
            <div style="height:150px;line-height:30px;" class="zzy-remark">
                <h3 style="color: #565353;margin:30px 0 30px 45px;">体检不合格，维持原专业。</h3>
            </div><?php break;?>
        <?php case "4": ?><div class="dao-hang">
                <span class="layui-text"></span>
                <span class="layui-text">说明</span>
            </div>
            <div class="zzy-mobile-title">说明</div>
            <div style="height:150px;line-height:30px;" class="zzy-remark">
                <h3 style="color: #565353;margin:30px 0 30px 45px;">未体检，视为放弃。</h3>
            </div><?php break;?>
        <?php case "5": ?><div class="dao-hang">
                <span class="layui-text"></span>
                <span class="layui-text">说明</span>
            </div>
            <div class="zzy-mobile-title">说明</div>
            <div style="height:150px;line-height:30px;" class="zzy-remark">
                <h3 style="color: #565353;margin:30px 0 30px 45px;">体检合格，转入二志愿。</h3>
            </div><?php break;?>
        <?php default: ?>
        <?php if(($data["bm_time_status"]) == "1"): if(($noTopTen == 1) OR ($noScore == 1) OR ($noSkx == 1) OR ($noBeyondScoreOther == 1) OR ($pc_error == 1)): ?><div style="height: 470px;">
                    <div class="dao-hang">
                        <span class="layui-text"></span>
                        <span class="layui-text">说明</span>
                    </div>
                    <div class="zzy-mobile-title">说明</div>
                    <div id="zzy">
                        <div id="xuanz">
                            <div>
                                您不符合转专业报名条件，如有疑问，请与校招生办联系，联系电话：24092126。
                            </div>
                        </div>
                    </div>
                </div>
                    <?php else: ?>
                    <div style="height: 470px;" class="select-zzy">
                        <div class="dao-hang">
                            <span class="layui-text"></span>
                            <span class="layui-text">转入专业</span>
                        </div>
                        <div class="zzy-mobile-title">选择转入专业</div>
                        <div id="zzy">
                            <div id="xuanz" style="width:50%;float:left;margin-left:30px;display:block;" class="zzy-mobile">
                                <div class="thisDiv">
                                    <span class="about-title morec">志愿一：</span>
                                    <select id="zy1" class="about-content">
                                        <option value=""> 请选择</option>
                                        <?php if(is_array($zy)): $i = 0; $__LIST__ = $zy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['zymc']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                                <div class="thisDiv">
                                    <span class="about-title morec">志愿二：</span>
                                    <select  id="zy2" class="about-content">
                                        <option value=""> 请选择</option>
                                        <?php if(is_array($zy)): $i = 0; $__LIST__ = $zy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['zymc']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top:80px;width:35%;float:left;" class="zzy-shuom">
                                <span style="font-size:18px;color:red;letter-spacing: 1px;">请选择拟转专业后认真核对以上信息是否无误，<br>一旦提交，无法更改，<br>如有疑问，请联系校招生办，<br>联系电话：24092126.</span>
                            </div>
                        </div>
                        <button class="zzy-a-button" id="zzytj" style="border:0;height:40px;padding-top:0;">确认提交 </button>
                    </div>
                </div><?php endif; ?>
            <?php else: ?>
            <div class="zzy-xzbmb" style="display: flex;align-items: center;justify-content: center;font-size: 28px;color: red;">
                报名已经结束,截止时间：<?php echo ($data['end_time']?(date('Y-m-d',$data['end_time'])):''); ?>
            </div><?php endif; endswitch;?>

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
    
    <style>.noclick{cursor:default;background-color: #ccc;} .noclick:hover{color:#fff;}</style>
    <?php if($bm_info == false): ?><script type="text/javascript">
            layui.use(['jquery','layer'], function(){
                var $ = layui.$,//jquery引入重点
                    layer = layui.layer;

                var notopten = "<?php echo ($noTopTen); ?>";
                var noScore = "<?php echo ($noScore); ?>";
                var noSkx = "<?php echo ($noSkx); ?>";
                var noBeyondScoreOther = "<?php echo ($noBeyondScoreOther); ?>";
                var pcError = "<?php echo ($pc_error); ?>";
                var zy = "<?php echo ($zy); ?>";
                if (!zy) {
                    //layer.msg('高考分数不达标');
                }

                $('#zzytj').click(function () {
                    if (pcError){
                        layer.msg('只有除飞行技术、内高班、高水平运动员、定向就业生、预科生以及进校后已通过选拔进入中欧航空工程师学院的普通本科新生才可报名');
                        return false;
                    }
                    if (notopten){
                        layer.msg('投档成绩未达到我校在本省份本科批次录取人数的前10%');
                        return false;
                    }
                    if (noScore){
                        layer.msg('考生高考投档成绩未超本省一段分数线50分（含）以上，或高考选考科目成绩未达到单科100分、或双科97分、或三科94分');
                        return false;
                    }
                    if (noSkx){
                        layer.msg('转专业资格线未设置，请联系系统管理员');
                        return false;
                    }
                    if (noBeyondScoreOther){
                        layer.msg('投档成绩未超本省一本分数线90分（含）以上');
                        return false;
                    }
                    if (!zy) {
                        //layer.msg('高考分数不达标');
                        return false;
                    }
                    var zyid_one = $('#zy1').val();
                    var zyid_two = $('#zy2').val();
                    if (zyid_one == '') {
                        layer.msg('请选择志愿一');
                        return false;
                    }
                    if (zyid_two == '') {
                        layer.msg('请选择志愿二');
                        return false;
                    }

                    $('#zzytj').attr('disabled','true');
                    $('#zzytj').addClass('noclick');
                    layer.confirm('报名一经提交无法修改，确定提交吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function(index){

                        layer.close(index);
                        $.ajax({
                            type:"POST",
                            url:"<?php echo U('Index/SubSignUp');?>",
                            dataType: "json",
                            data:{
                                zyid_one:zyid_one,zyid_two:zyid_two,type:1
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
            });
        </script>
        <?php else: ?>
        <script type="text/javascript">
            layui.use(['jquery','layer'], function(){
                var $ = layui.$,//jquery引入重点
                    layer = layui.layer;
                $('#xzbmb').click(function () {
                    window.location.href = "<?php echo U('Index/zzyDownload');?>";
                });
            });
        </script><?php endif; ?>


</body>
</html>