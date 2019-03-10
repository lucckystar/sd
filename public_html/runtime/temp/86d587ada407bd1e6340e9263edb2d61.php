<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\wamp\www\shop/application/home\view\index\index.html";i:1530615436;}*/ ?>
<!DOCTYPE html>
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

  <link rel="stylesheet" href="/public/static/Home/css/login.css" />
</head>
<body>
<div class="title"><a href="<?php echo url('store/store'); ?>"><div class="title-b"><i class="fa fa-angle-left"></i></div></a>首页</div>

<div class="banner">
    <ul>
        <li class="banner-u-l"><a href=""><img src="/public/static/Home/images/j-banner02.jpg"></a></li>
        <li class="banner-u-l"><a href=""><img src="/public/static/Home/images/j-banner04.jpg"></a></li>
        <li class="banner-u-l"><a href=""><img src="/public/static/Home/images/j-banner04.jpg"></a></li>
    </ul>
</div>

<div class="largen">
  <div class="planning-l">
    <a href="<?php echo url('Promotion/coupon'); ?>"><div class="planning-l-i bg-red"><i class="fa fa-ticket"></i></div></a>
    <a href="<?php echo url('Promotion/coupon'); ?>"><div class="planning-l-n">优惠券</div></a>
  </div>
  <div class="planning-l">
    <a href="<?php echo url('Promotion/combo'); ?>"><div class="planning-l-i bg-violet"><i class="fa fa-cubes"></i></div></a>
    <a href="<?php echo url('Promotion/combo'); ?>"><div class="planning-l-n">优惠套餐</div></a>
  </div>
  <div class="planning-l">
    <a href="<?php echo url('Promotion/discount'); ?>"><div class="planning-l-i bg-green"><i class="fa fa-minus-square-o"></i></div></a>
    <a href="<?php echo url('Promotion/discount'); ?>"><div class="planning-l-n">折扣</div></a>
  </div>
  <div class="planning-l">
    <a href="<?php echo url('/Promotion/gift'); ?>"><div class="planning-l-i bg-bluish"><i class="fa fa-gift"></i></div></a>
    <a href="<?php echo url('Promotion/gift'); ?>"><div class="planning-l-n">有赠品</div></a>
  </div>
  <div class="planning-l">
    <a href="<?php echo url('Promotion/seckill'); ?>"><div class="planning-l-i bg-orange"><i class="fa fa-clock-o"></i></div></a>
    <a href="<?php echo url('Promotion/seckill'); ?>"><div class="planning-l-n">秒杀</div></a>
  </div>
  <div class="planning-l">
    <a href="<?php echo url('Promotion/coupon'); ?>"><div class="planning-l-i bg-yellow"><i class="fa fa-group"></i></div></a>
    <a href="<?php echo url('Promotion/coupon'); ?>"><div class="planning-l-n">分销商品</div></a>
  </div>
</div>

<div class="largen">
  <div class="title">推荐商品</div>
  <div class="pliest-r">
    <div class="pliest-r-l">
      <div class="pliest-rl-i"><img src="/public/static/Home/images/m1.jpg"></div>
      <div class="pliest-rl-n">呼伦贝尔草莓</div>
      <div class="pliest-rl-b">来自呼伦贝尔，我也不知道.</div>
      <div class="pliest-rl-s">还剩10052件</div>
      <div class="pliest-rl-p">￥150.00<span class="abolish">￥180.00</span></div>
      <div class="pliest-rl-a">
        <span class="bg-red" alt="赠品">赠</span>
        <span class="bg-red" alt="优惠券">券</span>
        <span class="bg-red" alt="折扣">折</span>
        <span class="bg-red" alt="分销">销</span>
        <span class="bg-red" alt="套餐">套</span>
        <span class="bg-red" alt="秒杀">秒</span>
        <span class="bg-red" alt="会员卡">卡</span>
      </div>
    </div>
    <div class="pliest-r-l">
      <div class="pliest-rl-i"><img src="/public/static/Home/images/m1.jpg"></div>
      <div class="pliest-rl-n">呼伦贝尔草莓</div>
      <div class="pliest-rl-b">来自呼伦贝尔</div>
      <div class="pliest-rl-s">还剩10052件</div>
      <div class="pliest-rl-p">￥150.00</div>
    </div>
  </div>
  <div class="pliest-r">
    <div class="pliest-r-l">
      <div class="pliest-rl-i"><img src="/public/static/Home/images/m1.jpg"></div>
      <div class="pliest-rl-n">打地鼠游戏</div>
      <div class="pliest-rl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
      <div class="pliest-rl-s">不限量</div>
      <div class="pliest-rl-p">￥150.00/小时<span class="abolish">180.00/小时</span></div>
    </div>
    <div class="pliest-r-l">
      <div class="pliest-rl-i"><img src="/public/static/Home/images/m1.jpg"></div>
      <div class="pliest-rl-n">呼伦贝尔草莓</div>
      <div class="pliest-rl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
      <div class="pliest-rl-s">不限量</div>
      <div class="pliest-rl-p">￥150.00</div>
      <div class="pliest-rl-a">
        <span class="bg-red">套</span>
      </div>
    </div>
  </div>
</div>

<div class="largen">
  <div class="title">优惠套餐</div>
  <div class="combo-l">
    <div class="combo-l-n">香蕉草莓套餐</div>
    <div class="combo-l-b">二合一，更优惠</div>
    <div class="combo-l-p">￥150.00</div>
    <div class="combo-l-c">
      <div class="combo-lc-l">
        <div class="combo-lcl-i"><img src="/public/static/Home/images/m4.jpg"/></div>
        <div class="combo-lcl-n">呼伦贝尔草莓</div>
        <div class="combo-lcl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
        <div class="combo-lcl-p">￥150.00</div>
      </div>
      <div class="combo-lc-s">+</div>
      <div class="combo-lc-l">
        <div class="combo-lcl-i"><img src="/public/static/Home/images/m4.jpg"/></div>
        <div class="combo-lcl-n">呼伦贝尔香蕉</div>
        <div class="combo-lcl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
        <div class="combo-lcl-p">￥150.00</div>
      </div>
    </div>
  </div>

  <div class="combo-l">
    <div class="combo-l-n">香蕉草莓套餐</div>
    <div class="combo-l-b">四合一，更优惠</div>
    <div class="combo-l-p">￥150.00</div>
    <div class="combo-l-c">
      <div class="combo-lc-l">
        <div class="combo-lcl-i"><img src="/public/static/Home/images/m4.jpg"/></div>
        <div class="combo-lcl-n">呼伦贝尔草莓</div>
        <div class="combo-lcl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
        <div class="combo-lcl-p">￥150.00</div>
      </div>
      <div class="combo-lc-s">+</div>
      <div class="combo-lc-l">
        <div class="combo-lcl-i"><img src="/public/static/Home/images/m4.jpg"/></div>
        <div class="combo-lcl-n">呼伦贝尔香蕉</div>
        <div class="combo-lcl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
        <div class="combo-lcl-p">￥150.00</div>
      </div>
      <div class="combo-lc-s">+</div>
      <div class="combo-lc-l">
        <div class="combo-lcl-i"><img src="/public/static/Home/images/m4.jpg"/></div>
        <div class="combo-lcl-n">呼伦贝尔香蕉</div>
        <div class="combo-lcl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
        <div class="combo-lcl-p">￥150.00</div>
      </div>
      <div class="combo-lc-s">+</div>
      <div class="combo-lc-l">
        <div class="combo-lcl-i"><img src="/public/static/Home/images/m4.jpg"/></div>
        <div class="combo-lcl-n">呼伦贝尔香蕉</div>
        <div class="combo-lcl-b">来自呼伦贝尔，我也不知道那有没有草莓。但是绝对好吃</div>
        <div class="combo-lcl-p">￥150.00</div>
      </div>
    </div>
  </div>
</div>

<div class="largen">
  <div class="title">折扣</div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">呼伦贝尔没有草莓</div>
      <div class="comm-lr-b abolish">原价：￥152</div>
      <div class="comm-lr-p">现价:￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m5.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">呼伦贝尔没有草莓</div>
      <div class="comm-lr-b abolish">原价：￥152</div>
      <div class="comm-lr-p">现价:￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m1.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">呼伦贝尔没有草莓</div>
      <div class="comm-lr-b abolish">原价：￥152</div>
      <div class="comm-lr-p">现价:￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
</div>

<div class="largen">
  <div class="title">有赠品</div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-g">
        <div class="comm-lrg-l">赠品：</div>
        <div class="comm-lrg-r">
          <div class="comm-lrgr-l">新鲜的李i自哎呦偶</div>
          <div class="comm-lrgr-l">新鲜的香蕉哎呦偶</div>
        </div>
      </div>
      <div class="comm-lr-p">￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-g">
        <div class="comm-lrg-l">赠品：</div>
        <div class="comm-lrg-r">
          <div class="comm-lrgr-l">新鲜的李i自哎呦偶</div>
          <div class="comm-lrgr-l">新鲜的香蕉哎呦偶</div>
        </div>
      </div>
      <div class="comm-lr-p">￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-g">
        <div class="comm-lrg-l">赠品：</div>
        <div class="comm-lrg-r">
          <div class="comm-lrgr-l">新鲜的李i自哎呦偶</div>
          <div class="comm-lrgr-l">新鲜的香蕉哎呦偶</div>
        </div>
      </div>
      <div class="comm-lr-p">￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-g">
        <div class="comm-lrg-l">赠品：</div>
        <div class="comm-lrg-r">
          <div class="comm-lrgr-l">新鲜的李i自哎呦偶</div>
          <div class="comm-lrgr-l">新鲜的香蕉哎呦偶</div>
        </div>
      </div>
      <div class="comm-lr-p">￥150.00</div>
      <div class="comm-lr-b">时间：2017-11-12 至 2017-12-11</div>
    </div>
  </div>
</div>

<div class="largen">
  <div class="title">秒杀</div>
  <div class="seckill-l">
    <img class="seckill-l-i" src="/public/static/Home/images/m2.jpg">
    <div class="seckill-l-n">草莓组合限时打折</div>
    <div class="seckill-l-p">
      ￥150.00<span class="abolish">￥180.00</span>
      <div class="seckill-lp-t">距离结束:<span>08</span>时<span>23</span>分<span>57</span>秒</div>
    </div>
  </div>
  <div class="seckill-l">
    <img class="seckill-l-i" src="/public/static/Home/images/m1.jpg">
    <div class="seckill-l-n">猕猴桃组合限时打折</div>
    <div class="seckill-l-p">
      ￥150.00<span class="abolish">￥180.00</span>
      <div class="seckill-lp-t">距离结束:<span>05</span>时<span>23</span>分<span>57</span>秒</div>
    </div>
  </div>
  <div class="seckill-l">
    <img class="seckill-l-i" src="/public/static/Home/images/m4.jpg">
    <div class="seckill-l-n">火龙果组合限时打折</div>
    <div class="seckill-l-p">
      ￥150.00<span class="abolish">￥180.00</span>
      <div class="seckill-lp-t">距离结束:<span>240</span>时<span>23</span>分<span>57</span>秒</div>
    </div>
  </div>
</div>

<div class="largen">
  <div class="title">分销商品</div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m4.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-p">￥150.00<span class="abolish">￥180.00</span></div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m5.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-p">￥150.00<span class="abolish">￥180.00</span></div>
    </div>
  </div>
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/Home/images/m1.jpg"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n">呼伦贝尔草莓</div>
      <div class="comm-lr-b">天津市南开区资阳路15-15-206</div>
      <div class="comm-lr-p">￥150.00<span class="abolish">￥180.00</span></div>
    </div>
  </div>
</div>

<div class="footer-monter"></div>
<footer class="footer">
  <ul>
    <li class="footer-l"><a href="<?php echo url('index/index'); ?>" class="footer-l-a active"><i class="fa fa-home"></i>首页</a></li>
    <li class="footer-l"><a href="<?php echo url('goods/goods'); ?>" class="footer-l-a"><i class="fa fa-shopping-bag"></i>商品</a></li>
    <li class="footer-l"><a href="<?php echo url('cart/cart'); ?>" class="footer-l-a"><i class="fa fa-shopping-cart"></i>购物车</a></li>
    <li class="footer-l"><a href="<?php echo url('user/user'); ?>" class="footer-l-a"><i class="fa fa-male"></i>会员中心</a></li>
  </ul>
</footer>
</body>
</html>