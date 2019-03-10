<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"D:\wamp\www\shop/application/home\view\user\user.html";i:1530678722;}*/ ?>
<html ng-app="App">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>某某网站</title>

  <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>

  <link rel="stylesheet" href="/public/static/common/jquery-mobile/jquery.mobile-1.4.5.css">
  <script src="/public/static/common/jquery-mobile/jquery.mobile-1.4.5.js"></script>
  
  <link rel="stylesheet" href="/public/static/home/css/common.css"/>
  <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="/public/static/home/css/banner.css">
  <script src="/public/static/home/js/banner.js"></script>
</head>
<body>

  <div class="user-top">
    <div class="usert-i"><img src="/public/static/Home/images/myorder1.jpg"></div>
    <div class="usert-r">
      <div class="usert-r-n"><?php echo $_SESSION['home']['member_phone']; ?></div>
      <div class="usert-r-n">师志勇 先生</div>
    </div>
    <div class="usert-s"><i class="fa fa-cog"></i> <span>设置</span></div>
  </div>

  <div class="user-oper">
    <div class="usero-l">
      <a href="tel:13920425572"><div class="usero-l-p"><i class="fa fa-phone-square"></i>  <span>客服电话：1390425572</span></div></a>
    </div>
    <div class="usero-l">
      <a href="<?php echo url('order_list'); ?>"><div class="usero-l-l"><i class="fa fa-clipboard color-bluish"></i>  <span>我的订单</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-money color-orange"></i>  <span>我的余额</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-ticket color-red"></i>  <span>我的优惠券</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-credit-card-alt color-green"></i>  <span>我的会员卡</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-group color-yellow"></i>  <span>我的分销</span></div></a>
    </div>
    <div class="usero-l">
      <a href=""><div class="usero-l-l"><i class="fa fa-envelope color-orange"></i>  <span>消息</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-bookmark color-red"></i>  <span>我的收藏</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-location-arrow  color-violet"></i>  <span>我的地址</span></div></a>
    </div>
    <div class="usero-l">
      <a href=""><div class="usero-l-l"><i class="fa fa-address-card-o color-bluish"></i>  <span>个人信息</span></div></a>
      <a href=""><div class="usero-l-l"><i class="fa fa-lock color-green"></i>  <span>修改密码</span></div></a>
    </div>
    <div class="usero-l">
      <a href="<?php echo url('login_out'); ?>"><div class="usero-l-l"><i class="fa fa-sign-out color-yellow"></i>  <span>退出登录</span></div></a>
    </div>
  </div>

<div class="footer-monter"></div>
<footer class="footer">
  <ul>
    <li class="footer-l"><a href="<?php echo url('index/index'); ?>" class="footer-l-a"><i class="fa fa-home"></i>首页</a></li>
    <li class="footer-l"><a href="<?php echo url('goods/goods'); ?>" class="footer-l-a"><i class="fa fa-shopping-bag"></i>商品</a></li>
    <li class="footer-l"><a href="<?php echo url('cart/cart'); ?>" class="footer-l-a"><i class="fa fa-shopping-cart"></i>购物车</a></li>
    <li class="footer-l"><a href="<?php echo url('user/user'); ?>" class="footer-l-a active"><i class="fa fa-male"></i>会员中心</a></li>
  </ul>
</footer>
</body>
</html>