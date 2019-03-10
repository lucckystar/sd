<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\wamp\www\shop/application/home\view\goods\details.html";i:1531455512;}*/ ?>
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
  <div class="title"><a href="javascript:window.history.go(-1);"><div class="title-b"><i class="fa fa-angle-left"></i></div></a>商品详情</div>

  <div class="banner">
      <ul>
          <li class="banner-u-l"><a href=""><img src="/public/static/Home/images/j-banner02.jpg"></a></li>
          <li class="banner-u-l"><a href=""><img src="/public/static/Home/images/j-banner04.jpg"></a></li>
          <li class="banner-u-l"><a href=""><img src="/public/static/Home/images/j-banner04.jpg"></a></li>
      </ul>
  </div>

  <div class="largen">
    <div class="details-n"><?php echo $Goods_info['goods_name']; ?></div>
    <div class="details-b"><?php echo $Goods_info['goods_brief']; ?></div>
    <div class="details-b">还剩<?php echo $Goods_info['goods_num']; ?><?php echo $Goods_info['goods_unit']; ?></div>
    <?php if(is_array($GoodsGP_lists) || $GoodsGP_lists instanceof \think\Collection || $GoodsGP_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsGP_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <div class="details-b"><?php echo $v['goods_property_name']; ?>：<?php echo $v['goods_g_p_value']; ?></div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="details-p"><?php echo $Goods_info['goods_price']; ?>元</div>
    <div class="details-b">促销：</div>
    <div class="details-a">
      <div class="details-a-l"><span class="bg-red" alt="赠品">赠</span> 送赠品：大三大四、大大松、达到撒</div>
      <div class="details-a-l"><span class="bg-red" alt="优惠券">券</span> 送赠品：大三大四、大大松、达到撒</div>
      <div class="details-a-l"><span class="bg-red" alt="折扣">折</span> 送赠品：大三大四、大大松、达到撒</div>
      <div class="details-a-l"><span class="bg-red" alt="分销">销</span> 送赠品：大三大四、大大松、达到撒</div>
      <div class="details-a-l"><span class="bg-red" alt="套餐">套</span> 送赠品：大三大四、大大松、达到撒</div>
      <div class="details-a-l"><span class="bg-red" alt="秒杀">秒</span> 送赠品：大三大四、大大松、达到撒</div>
      <div class="details-a-l"><span class="bg-red" alt="会员卡">卡</span> 送赠品：大三大四、大大松、达到撒</div>
    </div>
  </div>

  <div class="largen">
    <?php echo $Goods_info['goods_centents']; ?>
  </div>

  <div class="details-bottom-monter"></div>
  <div class="details-bottom">
    <div class="detailsb-l">
      <div class="detailsb-l-l"><i class="fa fa-user"></i> 收藏</div>
      <div class="detailsb-l-l"></div>
      <div class="detailsb-l-l"></div>
    </div>
    <div class="detailsb-r">
      <div class="detailsb-r-l bg-orange">加入购物车</div>
      <div class="detailsb-r-l bg-red"><a href="<?php echo url('pay/goods_message',['gid'=>$Goods_info['goods_id']]); ?>">立即购买</a></div>
    </div>
  </div>

<div class="footer-monter"></div>
<footer class="footer">
  <ul>
    <li class="footer-l"><a href="<?php echo url('index/index'); ?>" class="footer-l-a"><i class="fa fa-home"></i>首页</a></li>
    <li class="footer-l"><a href="<?php echo url('goods/goods'); ?>" class="footer-l-a active"><i class="fa fa-shopping-bag"></i>商品</a></li>
    <li class="footer-l"><a href="<?php echo url('cart/cart'); ?>" class="footer-l-a"><i class="fa fa-shopping-cart"></i>购物车</a></li>
    <li class="footer-l"><a href="<?php echo url('user/user'); ?>" class="footer-l-a"><i class="fa fa-male"></i>会员中心</a></li>
  </ul>
</footer>
</body>
</html>