<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<title>新城网络企业网站管理平台提示信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
function jumpUrl(){
	 window.location.href = '<?php echo ($jumpUrl); ?>';
}
document.onload = setTimeout("jumpUrl()" , <?php echo ($waitSecond); ?> * 1000);
</script>
<base target="_self" />
<style type="text/css" media="screen,print" >
body { background:#eee}
#content{width:50%;height:500;background:#FFFFFF;border:1px solid #CCCCCC;border-radius: 6px 6px 6px 6px;margin:40px;padding:35px;font-size:14px;text-align:left;color:#888;}
a{color:#61C422;}
a:link,a:visited{text-decoration:none;}
a:hover,a:active{text-decoration:none;}
</style>
</head>
<body>
<center>
<div id="content">

<!-- 成功-->
<?php if(($status) == "1"): if(isset($message)): ?><h3><a style="background:transparent url(__PUBLIC__/Admin/success.gif) no-repeat scroll left center;padding:15px 0px 15px 60px;"><?php echo ($msgTitle); ?></a></h3>
    <h4><a style="padding:15px 0px 15px 60px;"><?php echo ($message); ?></a></h4><?php endif; endif; ?>

<!--失败-->
<?php if(($status) == "0"): if(isset($error)): ?><h3><a  style="background:transparent url(__PUBLIC__/Admin/error.gif) no-repeat scroll left center;color:#E26000;padding:15px 0px 15px 60px;"><?php echo ($msgTitle); ?></a></h3>   
    <h4><a style="padding:15px 0px 15px 60px;"><?php echo ($error); ?></a></h4><?php endif; endif; ?>    
   
<?php if(isset($closeWin)): ?><p>系统将在 <span style="color:#F87F15;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">关闭</A></p><?php endif; ?>
        
<?php if(!isset($closeWin)): ?><p>
系统将在 <span style="color:#F87F15;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 跳转</>
</p><?php endif; ?>
</div>
</center>
</body>
</html>