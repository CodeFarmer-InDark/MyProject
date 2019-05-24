<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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





<body>
<div id="wrap1">
    <div class="header loginBox">
        <div class="nav_pc">
            <div class="nav1">
                <ul class="contentnav">
                    <li class="last_logined"><a href="<?php echo U('Login/logout');?>" class="memberIco"><img src="/cauc_zs3/lqgl/Public/Images/promotion/loginout_ico.jpg" alt="退出登录">退出登录</a></li>
                    <li class="last_logined toleft"><a href="<?php echo U('Index/info');?>" class="memberIco" id="username"></a></li>

                    <li class="on"><a href="#" class="nav <?php if($controllerName == 'Query'): ?>checked<?php endif; ?>" >录取查询</a></li>
                    <li class="on"><a href="<?php echo U('Index/info');?>" class="nav <?php if($controllerName == 'IndexInfo'): ?>checked<?php endif; ?>">个人资料</a></li>
                    <li class="on"><a href="<?php echo U('History/index');?>" class="nav <?php if($controllerName == 'History'): ?>checked<?php endif; ?>">历史报名</a></li>

                    <li class="on1">
                        <?php switch($cmsConfig['signup_status']): case "0": ?><a href="<?php echo U('Signup/index');?>" class="nav <?php if($controllerName == 'Signup'): ?>checked<?php endif; ?>">报名</a><?php break;?>
                            <?php case "1": ?><a href="<?php echo U('Signup/index');?>" class="nav <?php if($controllerName == 'Signup'): ?>checked<?php endif; ?>">报名</a><?php break;?>
                            <?php case "2": ?><a href="<?php echo U('SignSecond/select');?>" class="nav <?php if($controllerName == 'SignSecond'): ?>checked<?php endif; ?>">报名</a><?php break; endswitch;?>
                    </li>
                    <li class="on1"><a href="<?php echo U('Index/index');?>" class="nav <?php if($controllerName == 'Index'): ?>checked<?php endif; ?>">首页</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="/cauc_zs3/lqgl/Public/Js/promotion/test/lib/esl.js"></script>
<script src="/cauc_zs3/lqgl/Public/Js/promotion/test/lib/config.js"></script>
<script src="/cauc_zs3/lqgl/Public/Js/promotion/test/lib/jquery.min.js"></script>
<script src="/cauc_zs3/lqgl/Public/Js/promotion/test/lib/facePrint.js"></script>

<style>
    html, body, #main {
        width: 100%;
        height: 100%;
        margin: 0;
    }
</style>
<div class="body grey">
    <div id="mainMap"></div>
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
<script>
    require([
        'echarts'
    ], function (echarts) {
        require(['map/js/china'], function () {
            var chart = echarts.init(document.getElementById('mainMap'));

            var itemStyle = {
                normal:{
                    borderColor: 'rgba(0, 0, 0, 0.2)'
                },
                emphasis:{
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowBlur: 20,
                    borderWidth: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            };

            chart.setOption({
                tooltip: {},
                title : {
                    text: '*请选择报名的省份',
                    subtext: '点击图中对应省份即可',
                    left: 'center'
                },
//                legend: {
//                    orient: 'vertical',
//                    left: 'left',
//                    data:['iphone3','iphone4','iphone5']
//                },
//                visualMap: {
//                    min: 0,
//                    max: 1500,
//                    left: 'left',
//                    top: 'bottom',
//                    text:['高','低'],           // 文本，默认为数值文本
//                    calculable : true
//                },
                selectedMode: 'single',
                series : [
                    {
                        name: 'province',
                        type: 'map',
                        map: 'china',
                        itemStyle: itemStyle,
                        showLegendSymbol: true,
                        // zoom: 10,
                        // center: [115.97, 29.71],
                        roam: true,
                        markPoint: {
                            data: [{
//                                coord: [115.97, 29.71]
                                coord: [117.57,39.21]
                            }]
                        },
                        label: {
                            normal: {
                                show: true,
                                rotate: 40,
                                formatter: '{b}',
//                                formatter: '{b}：{value|{c}}',
                                // position: 'inside',
                                backgroundColor: '#fff',
                                padding: [3, 5],
                                borderRadius: 3,
                                borderWidth: 1,
                                borderColor: 'rgba(0,0,0,0.5)',
                                color: '#777',
                                rich: {
                                    value: {
                                        color: '#019D2D',
                                        fontSize: 14,
                                        // fontWeight: 'bold'
                                        // textBorderWidth: 2,
                                        // textBorderColor: '#000'
                                    }
                                }
                            },
                            emphasis: {
                                show: true
                            }
                        },
                        data:[
                            {name: '北京',value: 11,<?php if($pid == 11): ?>selected:true<?php endif; ?>},
                            {name: '天津',value: 12,<?php if($pid == 12): ?>selected:true<?php endif; ?>},
                            {name: '上海',value: 31,<?php if($pid == 31): ?>selected:true<?php endif; ?>},
                            {name: '重庆',value: 50,<?php if($pid == 50): ?>selected:true<?php endif; ?>},
                            {name: '河北',value: 13,<?php if($pid == 13): ?>selected:true<?php endif; ?>},
                            {name: '河南',value: 41,<?php if($pid == 41): ?>selected:true<?php endif; ?>},
                            {name: '云南',value: 53,<?php if($pid == 53): ?>selected:true<?php endif; ?>},
                            {name: '辽宁',value: 21,<?php if($pid == 21): ?>selected:true<?php endif; ?>},
                            {name: '黑龙江',value: 23, <?php if($pid == 23): ?>selected:true<?php endif; ?>},
                            {name: '湖南',value: 43, <?php if($pid == 43): ?>selected:true<?php endif; ?>},
                            {name: '安徽',value: 34, <?php if($pid == 34): ?>selected:true<?php endif; ?>},
                            {name: '山东',value: 37, <?php if($pid == 37): ?>selected:true<?php endif; ?>},
                            {name: '新疆',value: 65, <?php if($pid == 65): ?>selected:true<?php endif; ?>},
                            {name: '江苏',value: 32, <?php if($pid == 32): ?>selected:true<?php endif; ?>},
                            {name: '浙江',value: 33, <?php if($pid == 33): ?>selected:true<?php endif; ?>},
                            {name: '江西',value: 36, <?php if($pid == 36): ?>selected:true<?php endif; ?>},
                            {name: '湖北',value: 42, <?php if($pid == 42): ?>selected:true<?php endif; ?>},
                            {name: '广西',value: 45, <?php if($pid == 45): ?>selected:true<?php endif; ?>},
                            {name: '甘肃',value: 62, <?php if($pid == 62): ?>selected:true<?php endif; ?>},
                            {name: '山西',value: 14, <?php if($pid == 14): ?>selected:true<?php endif; ?>},
                            {name: '内蒙古',value: 15, <?php if($pid == 15): ?>selected:true<?php endif; ?>},
                            {name: '陕西',value: 61, <?php if($pid == 61): ?>selected:true<?php endif; ?>},
                            {name: '吉林',value: 22, <?php if($pid == 22): ?>selected:true<?php endif; ?>},
                            {name: '福建',value: 35, <?php if($pid == 35): ?>selected:true<?php endif; ?>},
                            {name: '贵州',value: 52, <?php if($pid == 52): ?>selected:true<?php endif; ?>},
                            {name: '广东',value: 44, <?php if($pid == 44): ?>selected:true<?php endif; ?>},
                            {name: '青海',value: 63, <?php if($pid == 63): ?>selected:true<?php endif; ?>},
                            {name: '西藏',value:54, <?php if($pid == 54): ?>selected:true<?php endif; ?>},
                            {name: '四川',value:51, <?php if($pid == 51): ?>selected:true<?php endif; ?>},
                            {name: '宁夏',value: 64, <?php if($pid == 64): ?>selected:true<?php endif; ?>},
                            {name: '海南',value: 46, <?php if($pid == 46): ?>selected:true<?php endif; ?>},
                            {name: '台湾',value: 71, <?php if($pid == 71): ?>selected:true<?php endif; ?>},
                            {name: '香港',value: 81, <?php if($pid == 81): ?>selected:true<?php endif; ?>},
                            {name: '澳门',value: 82, <?php if($pid == 81): ?>selected:true<?php endif; ?>}
                        ]
                    }
                ]
            });

            chart.on('click', function (param) {
                var province= param.value;
                $.ajax({
                    url:"<?php echo U('SignSecond/getMap');?>",
                    type:"post",
                    data:{'province':province},
                    datatype:'json',
                    success:function(data){
                        var obj = eval("("+data+")");
                        switch(obj.msg)
                        {
                            case 1:
                                alert('省份代码不存在');break;
                            case 2:
                                var jumpUri = "<?php echo U('Promotion/SignSecond/index',array('province'=>'pid'));?>";
                                jumpUri1 =  jumpUri.replace("pid",obj.province); //将代替变量的字符串用真实变量替换掉
                                window.location.href = jumpUri1;
//                                document.write('<form action="'+jump+'" method="post" name="subform" id="subform">');
//                                document.write("<input type='hidden' name='province' id='province' value='"+obj.province+"'>");
//                                document.write('</form>');
//                                document.getElementById('subform').submit();
                                break;
                            default:;
                        }
                    }
                })
            });
            // setTimeout(function () {
            //     chart.setOption({
            //         series: [{
            //             zoom: 5
            //         }]
            //     });
            // }, 2000);
        });
    });

</script>