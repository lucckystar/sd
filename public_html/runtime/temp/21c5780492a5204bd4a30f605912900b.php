<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\wamp\www\shop/application/home\view\goods\goods.html";i:1530703929;}*/ ?>
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
  <div class="title"><a href="javascript:window.history.go(-1);"><div class="title-b"><i class="fa fa-angle-left"></i></div></a>商品列表</div>

  <div class="filtrate">
    <a href="<?php echo url('goods'); ?>"><div class="filtrate-l">默认</div></a>
    <a href="<?php echo url('goods?',['order_price'=>1]); ?>"><div class="filtrate-l">价格 <span class="fa fa-caret-down"></span></div></a>
    <a href="<?php echo url('goods?',['order_sales'=>1]); ?>"><div class="filtrate-l">销量 <span class="fa fa-caret-down"></span></div></a>
    <a href="javascript:;"><div class="filtrate-l filtrate-show" show-class=".filtrate-s">筛选</div></a>
    <div class="filtrate-s">
      <div class="filtrate-s-d">
        <div class="filtrate-sd-d">
          <div class="filtrate-sdd-t">服务活动</div>
          <div class="filtrate-sdd-t">商品类型</div>
        </div>
        <div class="filtrate-sd-o">
          <div class="filtrate-sdo-r">重置</div>
          <div class="filtrate-sdo-a">确认</div>
        </div>
      </div>
    </div>
  </div>

  <div class="largen">
    <?php $p_div = 1;if(is_array($goods_lists) || $goods_lists instanceof \think\Collection || $goods_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($p_div == '1'): ?><div class="pliest-r"><?php endif; ?>
      <a href="<?php echo url('details',['id'=>$v['goods_id']]); ?>">
      <div class="pliest-r-l">
        <div class="pliest-rl-i"><img src="/public/static/<?php echo $v['file_path']; ?>"></div>
        <div class="pliest-rl-n"><?php echo $v['goods_name']; ?></div>
        <div class="pliest-rl-b"><?php echo $v['goods_brief']; ?></div>
        <div class="pliest-rl-s">还剩<?php echo $v['goods_num']; ?><?php echo $v['goods_unit']; ?></div>
        <div class="pliest-rl-p">￥<?php echo $v['goods_price']; ?><!-- <span class="abolish">￥180.00</span> --></div>
        <!-- <div class="pliest-rl-a">
          <span class="bg-red" alt="赠品">赠</span>
          <span class="bg-red" alt="优惠券">券</span>
          <span class="bg-red" alt="折扣">折</span>
          <span class="bg-red" alt="分销">销</span>
          <span class="bg-red" alt="套餐">套</span>
          <span class="bg-red" alt="秒杀">秒</span>
          <span class="bg-red" alt="会员卡">卡</span>
        </div> -->
      </div>
      </a>
    <?php
      $p_div++;
      if($p_div > 2){
        echo '</div>';
        $p_div = 1;
      }
    endforeach; endif; else: echo "" ;endif; ?>
    <div class="largen-more"><a href="">查看更多</a></div>
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