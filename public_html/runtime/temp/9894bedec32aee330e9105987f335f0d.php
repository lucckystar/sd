<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\wamp\www\shop/application/home\view\pay\goods_message.html";i:1531989427;}*/ ?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>某某网站</title>

  <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>

  <link rel="stylesheet" href="/public/static/common/jquery-mobile/jquery.mobile-1.4.5.css">
  <script>
  $(document).on('mobileinit',function(){
//     $.mobile.loadingMessageTextVisible = true;
// 　　$.mobile.loadingMessage = '加载中...';
//     $.mobile.loadingMessageTheme = 'a';
//     $.mobile.pageLoadErrorMessage = '服务器正忙，请联系管理员...';
//     $.mobile.linkBindingEnabled = false;
    $.mobile.page.prototype.options.keepNative = "*";
  });
  </script>
  <script src="/public/static/common/jquery-mobile/jquery.mobile-1.4.5.js"></script>
  
  <link rel="stylesheet" href="/public/static/home/css/common.css"/>
  <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">

  <script src="/public/static/home/js/common.js"></script>

  <link rel="stylesheet" href="/public/static/home/css/banner.css">
  <script src="/public/static/home/js/banner.js"></script>

  <link rel="stylesheet" href="/public/static/Home/css/login.css" />
</head>
<body>
<div class="title"><a href="javascript:window.history.go(-1);"><div class="title-b"><i class="fa fa-angle-left"></i></div></a>订单信息</div>

<form class="ajax-commit" method="post" action="<?php echo url('create_order'); ?>" data-ajax="false">
<div class="largen largen_margin">
  <div class="comm-l">
    <div class="comm-l-l"><img src="/public/static/<?php echo $Goods_info['goods_cover_path']; ?>"></div>
    <div class="comm-l-r">
      <div class="comm-lr-n"><?php echo $Goods_info['goods_name']; ?></div>
      <div class="comm-lr-b"><?php echo $Goods_info['goods_brief']; ?></div>
      <div class="comm-lr-b">单价：<?php echo $Goods_info['goods_price']; ?>元 &times; 1<?php echo $Goods_info['goods_unit']; ?></div>
      <div class="comm-lr-p">小计:￥150.00</div>
    </div>
    <input type="hidden" name="gid" value="<?php echo $Goods_info['goods_id']; ?>"/>
    <input type="hidden" name="gnum" value="1"/>
  </div>
</div>

<div class="largen">
  <div class="message-n">配送方式 : 
    <div class="largen_m_i">
        <select name="delivery_type">
          <option value="0">--请选择--</option>
          <option value="1">到店自提</option>
          <option value="2">内部配送</option>
          <option value="3">线上交付</option>
          <option value="4">快递</option>
        </select>
    </div>
  </div>
  <div class="message-n">收货地址 : 
    <div class="largen_m_i">
        <select name="aid">
          <option value="0">--请选择--</option>
          <?php if(is_array($MemberAddress_lists) || $MemberAddress_lists instanceof \think\Collection || $MemberAddress_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $MemberAddress_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $v['member_address_id']; ?>"><?php echo $v['member_address_linkman']; ?> <?php echo $v['member_address_phone']; ?> <?php echo $v['member_address_name']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
  </div>
</div>

<div class="message-bottom-monter"></div>
<div class="message-bottom">
  <div class="messageb-sub">合计：3569元</div>
  <div class="messageb-settle bg-red"><button type="submit">去支付</button></div>
</div>
</form>
</body>
</html>