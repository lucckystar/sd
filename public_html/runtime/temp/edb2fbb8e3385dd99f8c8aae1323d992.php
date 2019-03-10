<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"D:\wamp\www\shop/application/home\view\cart\cart.html";i:1531300122;}*/ ?>
<!DOCTYPE html>
<html class="no-js">
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

  <link rel="stylesheet" href="/public/static/Home/css/login.css" />
</head>
<body>
  <div class="title"><a href="javascript:window.history.go(-1);"><div class="title-b"><i class="fa fa-angle-left"></i></div></a>购物车</div>

  <div class="largen">
    <div class="cart-l">
      <div class="cart-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
      <div class="cart-l-r">
        <div class="cart-lr-n">呼伦贝尔草莓</div>
        <div class="cart-lr-b">单价：￥15.00</div>
        <div class="cart-lr-b">呼伦贝尔草莓呼伦贝尔草莓呼</div>
        <div class="cart-lr-sub">小计：￥15.00</div>
        <div class="cart-lr-num">
          <button type="button">&ndash;</button><input type="number"><button type="button">+</button>
        </div>
      </div>
      <div class="cart-l-s"><i class="fa fa-square-o"></i></div>
    </div>

    <div class="cart-l">
      <div class="cart-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
      <div class="cart-l-r">
        <div class="cart-lr-n">呼伦贝尔草莓</div>
        <div class="cart-lr-b">单价：￥15.00</div>
        <div class="cart-lr-b">呼伦贝尔草莓呼伦贝尔草莓呼</div>
        <div class="cart-lr-sub">小计：￥15.00</div>
        <div class="cart-lr-num">
          <button type="button">+</button><input type="number"><button type="button"> &ndash;</button>
        </div>
      </div>
      <div class="cart-l-s"><i class="fa fa-check-square-o"></i></div>
    </div>
  </div>

  <div class="cart-bottom">
    <div class="cartb-sub">合计：￥36005.00</div>
    <div class="cartb-check"><i class="fa fa-check-square-o"></i>  <span>取消全选</span></div>
    <div class="cartb-settle bg-red">结算</div>
  </div>

<div class="footer-monter"></div>
<footer class="footer">
  <ul>
    <li class="footer-l"><a href="<?php echo url('index/index'); ?>" class="footer-l-a"><i class="fa fa-home"></i>首页</a></li>
    <li class="footer-l"><a href="<?php echo url('goods/goods'); ?>" class="footer-l-a"><i class="fa fa-shopping-bag"></i>商品</a></li>
    <li class="footer-l"><a href="<?php echo url('cart/cart'); ?>" class="footer-l-a active"><i class="fa fa-shopping-cart"></i>购物车</a></li>
    <li class="footer-l"><a href="<?php echo url('user/user'); ?>" class="footer-l-a"><i class="fa fa-male"></i>会员中心</a></li>
  </ul>
</footer>
</body>
</html>