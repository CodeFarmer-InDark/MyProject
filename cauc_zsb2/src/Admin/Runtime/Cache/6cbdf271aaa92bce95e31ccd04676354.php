<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新城网络企业网站管理平台登录</title>
<link rel="stylesheet" href="__PUBLIC__/Admin/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" >
$(function(){   
    $("#submit").click(function(){
	var jumpUri = $("#jumpUri").val();
       $.ajax({   
		  type:"POST",   
			  url:"<?php echo U('Public/doLogin');?>",
			  data:{
				  username: $('#username').val(), password: $('#password').val(), verifyCode: $('#verifyCode').val()
				  },   
			  beforeSend:function(){
				  	$("#submit").addClass("disable");
					$("#submit").attr("disable","disable");
				  	$("#submit").attr("value","正在登录...");
				  },
			  success:function(data){
				  var data = JSON.parse(data)
				switch(data.msg)
				{
					case 'errorVerifyCode':
						//$("#verifyImage").attr('src', "<?php echo U('Public/verify',0,0,0);?>?"+ Math.random());
						resetVerifyCode();
						resetSubmit();
						$("#msg").html('<span style="color:#FF0000">验证码错误</span>'); 
						break;
					case 'emptyInfo':
						$("#msg").html('<span style="color:#FF0000">用户名密码必须填写</span>'); 
						resetSubmit();
						break;
					case 'usernameFalse':
						$("#msg").html('<span style="color:#FF0000">用户信息不存在，登录失败</span>'); 
						resetVerifyCode();
						resetSubmit();
						break;
					case 'passwordFalse':
						$("#msg").html('<span style="color:#FF0000">密码错误</span>'); 
						resetVerifyCode();
						resetSubmit();
						break;
					case 'roleFalse':
						$("#msg").html('<span style="color:#FF0000">当前用户被限制登录，请联系管理员</span>');
						resetVerifyCode();
						resetSubmit();
						break;
					case 'roleLost':
						$("#msg").html('<span style="color:#FF0000">不存在的用户组，请联系管理员</span>');
						resetVerifyCode();
						resetSubmit();
						break;
					case 'noprower':
						$("#msg").html('<span style="color:#FF0000">没有任何权限</span>');
						resetVerifyCode();
						resetSubmit();
						break;
					case "loginSuccess":
						$("#msg").html('<span style="color:#FF0000">登录成功</span>');
						if(data.url == ''){
							window.location.href = '<?php echo U("Index/index");?>';
						}else{
							window.location.href = '<?php echo U("News/index");?>'
						}
						//window.location.href = '<?php echo U("Index/index");?>';
						return true;
						break;
					default:
						$("#msg").html('<span style="color:#FF0000">'+data.msg+'</span>');
						alert ('未知错误，请联系管理员');
				}
				return false;			
			}
         });   
		return false;
    });  
	$("#verifyImage").click(function(){
		resetVerifyCode();						
	})
}); 
function resetSubmit(){
	$("#submit").removeClass("disable");
	$("#submit").attr("disable","enable");
	$("#submit").attr("value","提交");
}
function resetVerifyCode()
{
	$("#verifyImage").attr('src', "<?php echo U('Public/verify',0,0,0);?>/"+ Math.random());
}

</script>
</head>
	<body id="login">
	  <div id="login-wrapper" class="png_bg">
			<div id="login-top">
				<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="__PUBLIC__/Admin/Images/logo.png" alt="新城网络网站管理平台" />
			</div> <!-- End #logn-top -->
			<div id="login-content">
				<form method="post" action="<?php echo U('Public/doLogin');?>">
					<p>
						<label>用户名</label>
						<input class="text-input" type="text" name="username" id="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label>密码</label>
						<input class="text-input" type="password" name="password" id="password" />
					</p>
					<div class="clear"></div>
					<p>
                    	<label>验证码</label>
						<img src="<?php echo U('Public/verify');?>" align="absmiddle" class="checkcode" title="如果您无法识别验证码，请点图片更换" id="verifyImage"/><input class="text-input" type="text" name="verifyCode" id="verifyCode" size="8" maxlength="4" />
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" name="submit" id="submit" value="登录" />
                        <input name="jumpUri" type="hidden" id="jumpUri" value="<?php echo ($jumpUri); ?>" />
					</p>
				</form>
                <div id="msg"></div>
			</div> <!-- End #login-content -->
		</div> <!-- End #login-wrapper -->
  </body>
</html>