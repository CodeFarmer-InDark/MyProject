<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<title>页面提示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
html, body{margin:0; padding:0; border:0 none;font:14px Tahoma,Verdana;line-height:150%;background:white}
a{text-decoration:none; color:#174B73; border-bottom:1px dashed gray}
a:hover{color:#F60; border-bottom:1px dashed gray}
div.message{margin:10% auto 0px auto;clear:both;padding:5px;border:1px solid silver; text-align:center; width:45%}
#wait{color:blue;font-weight:bold}
span.error{color:red;font-weight:bold}
span.success{color:blue;font-weight:bold}
div.msg{margin:20px 0px}
</style>
</head>
<body>
<div class="message">
	<div class="msg">
	<?php if(isset($message)): ?><span class="success"><?php echo ($msgTitle); echo ($message); ?></span>
	<?php else: ?>
	<span class="error"><!--<?php echo ($msgTitle); ?>--><?php echo ($error); ?></span><?php endif; ?>
	</div>
	<div class="tip">
	<?php if(isset($closeWin)): ?>页面将在 <span id="wait"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待请点击 <a id="href" href="<?php echo ($jumpUrl); ?>">这里</a> 关闭
	<?php else: ?>
		页面将在 <span id="wait"><?php echo ($waitSecond); ?></span> 秒后自动跳转，如果不想等待请点击 <a id="href" href="<?php echo ($jumpUrl); ?>">这里</a> 跳转<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script></body>
</html>