<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="<?php echo U('Local/index');?>" method="get">
<div class="input-sms-code">
    <img src="<?php echo U('Signup/Wx/verify');?>" title="如果您无法识别验证码，请点图片更换" id="verifyImage">
    <span name="sp">session:::<?php echo ($sp); ?></span><br>
    <span name="spp"><?php echo ($spp); ?></span>
    <input type="text" name="verify" />
    <input type="submit" value="提交">
</div></form>
</body>
</html>