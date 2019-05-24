<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <title><?php if(isset($moduleTitle)): echo ($moduleTitle); ?> -<?php endif; ?> <?php if(isset($cmsConfig)): echo ($cmsConfig["site_name"]); endif; ?> </title>
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
                    <li class="on"><a href="<?php echo U('History/index');?>" class="nav <?php if($controllerName == 'History'): ?>checked<?php endif; ?>">历史报名</a></li>

                    <li class="on1">
                        <?php switch($cmsConfig['signup_status']): case "0": ?><a href="<?php echo U('Signup/index');?>" class="nav <?php if($controllerName == 'Signup'): ?>checked<?php endif; ?>">报名</a><?php break;?>
                            <?php case "1": ?><a href="<?php echo U('Signup/index');?>" class="nav <?php if($controllerName == 'Signup'): ?>checked<?php endif; ?>">报名</a><?php break;?>
                            <?php case "2": ?><a href="<?php echo U('SignSecond/index');?>" class="nav <?php if($controllerName == 'SignSecond'): ?>checked<?php endif; ?>">报名</a><?php break; endswitch;?>
                    </li>
                    <li class="on1"><a href="<?php echo U('Index/index');?>" class="nav <?php if($controllerName == 'Index'): ?>checked<?php endif; ?>">首页</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="body grey">
    <div class="register pad fff bottom" style="min-height:500px;">
        <div class="stitle">
            <span class="s1">学校列表（<?php echo ($year); ?>年）</span>
            <a href="<?php echo U('Index/index');?>" class="s2"><< 返回首页</a>
        </div>
        <form action="<?php echo U('Signup/doCommand');?>" method="post" >
            <table class="bmlist">
                <thead>
                <tr>
                    <th style="width:100px;"><input class="check-all" type="checkbox" id="chkall" name="chkall" onclick="checkAll(this,'id[]');">&nbsp;全选</th>
                    <th>学校</th>
                    <th>报名人数</th>
                    <th>审批人数</th>
                </tr>
                </thead>
                <?php if(isset($dataList)): ?><tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="pagination">
                                <?php echo ($pageBar); ?>
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr style="height:20px;"></tr>
                    <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"></td>
                            <td><?php echo ($vo["zxmc"]); ?></td>
                            <td><?php echo ($vo["bmCount"]); ?></td>
                            <td><?php echo ($vo["checkCount"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <tbody>
                    <tr>
                        <td colspan="4"><p class="no">暂无数据</p></td>
                    </tr><?php endif; ?>
                </tbody>
            </table>
            <input type="submit" value="提交" class="submit">
        </form>
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
<script type="text/javascript">
    function checkAll(e, itemName)
    {
        var aa = document.getElementsByName(itemName);    //获取全选复选框
        for (var i=0; i<aa.length; i++){
            aa[i].checked = e.checked;    //改变所有复选框的状态为全选复选框的状态
        }
    }
</script>