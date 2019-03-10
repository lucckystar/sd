<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\wamp\www\shop/application/home\view\account\login.html";i:1531300384;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>某某网站</title>

  <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>

  <link rel="stylesheet" href="/public/static/common/jquery-mobile/jquery.mobile-1.4.5.css">
  <script src="/public/static/common/jquery-mobile/jquery.mobile-1.4.5.js"></script>
  
  <link rel="stylesheet" href="/public/static/home/css/common.css"/>
  <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">

  <script src="/public/static/home/js/common.js"></script>

  <link rel="stylesheet" href="/public/static/home/css/banner.css">
  <script src="/public/static/home/js/banner.js"></script>

  <link rel="stylesheet" href="/public/static/Home/css/login.css" />
</head>
<body>

<div class="login">
	<div class="welcome"><img src="/public/static/Home/images/welcome.png"></div>
	<form class="ajax-commit" method="post" action="<?php echo url('login_ok'); ?>" data-ajax="false">
	<div class="login-form">
		<div class="login-inp"><label>手机号</label><input class="verify" name="phone" type="text" placeholder="请输入手机号"></div>
		<div class="login-inp"><label>密码</label><input class="verify" name="password" type="password" placeholder="请输入密码"></div>
		<div class="login-inp"><button type="submit">立即登录</button></div>
	</div>
	</form>
	<div class="login-txt">
		<a href="<?php echo url('register'); ?>">立即注册</a>
		<a href="<?php echo url('resetpass'); ?>" class="login-txt-r">忘记密码？</a>
	</div>
</div>
</body>
</html>
