<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\wamp\www\backstage/application/admin\view\account\login.html";i:1541232333;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 搜索引擎优化相关 -->
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <!-- jquery -->
    <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>
    <!-- bootstarp -->
    <link rel="stylesheet" href="/public/static/common/bootstarp/bootstrap.css">
    <script src="/public/static/common/bootstarp/bootstrap.js"></script>
    <!-- 字体库 -->
    <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">

    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 自定义js库 -->
    <script src="/public/static/admin/js/extend.js"></script>

    <title>达竹科技后台模版 - 登录</title>

    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">h</h1>
        </div>
        <h3>欢迎使用 hAdmin</h3>
        <form class="m-t ajax-commit" role="form" method="post" action="<?php echo url('Account/loginupdate'); ?>">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="用户名" name="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="密码" name="pwd">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="验证码" name="verify">
            </div>
            <div class="form-group">
                <a href="javascript:;" class="js_verify" title="看不清？换一张！" >
                    <img src="<?php echo captcha_src(); ?>" class="verify" />
                </a>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){
    var change_verify = function(){$('.verify').prop('src','<?php echo captcha_src(); ?>');};
    $('.js_verify').bind('click',function(){
        change_verify();
    }).trigger('click');
});
</script>
</body>
</html>
