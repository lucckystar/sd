<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\shop/application/home\view\pay\pay_type.html";i:1532500994;}*/ ?>
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
<div class="title"><a href="javascript:window.history.go(-1);"><div class="title-b"><i class="fa fa-angle-left"></i></div></a>选择支付方式</div>

<div class="pay_center">
  <p class="pay_c_p1"><?php echo $Order_info['order_money']; ?>元</p>
  <p class="pay_c_p2">单号：<?php echo $Order_info['order_number']; ?></p>
</div>
<form data-ajax="false">
<input type="hidden" name="oid" value="<?php echo $Order_info['order_id']; ?>">
<div class="pay_w_wexin">
  <div class="usero-l">
    <div class="sum__list_jilu usero-l-l">
      <i class="fa fa-clipboard color-bluish"></i>  <span>余额支付</span>
      <div class="pay_d_l">
        <input class="pay_d_l_i" id="item1" type="radio" name="payway" value="2"/>
        <label class="pay_d_l_l" for="item1"></label>
      </div>
    </div>
    <div class="sum__list_jilu usero-l-l">
      <i class="fa fa-weixin" aria-hidden="true"></i>  <span>微信支付</span>
      <div class="pay_d_l">
          <input class="pay_d_l_i" id="item3" type="radio" name="payway" value="3"/>
          <label class="pay_d_l_l" for="item3"></label>
      </div>
    </div>
    <div class="sum__list_jilu usero-l-l">
      <i class="fa fa-money color-orange"></i>  <span>支付宝支付</span>
      <div class="pay_d_l">
          <input class="pay_d_l_i" id="item2" type="radio" name="payway" value="4"/>
          <label class="pay_d_l_l" for="item2"></label>
      </div>
    </div>
    <div class="sum__list_jilu usero-l-l">
      <i class="fa fa-money color-orange"></i>  <span>银行卡支付</span>
      <div class="pay_d_l">
          <input class="pay_d_l_i" id="item4" type="radio" name="payway" value="5"/>
          <label class="pay_d_l_l" for="item4"></label>
      </div>
    </div>
  </div>
  <div><button type="button" id="submit">确认支付</button></div>
</div>
</form>
<script>
$(document).ready(function(){
  $('.sum__list_jilu').click(function(){
    $(this).find('.pay_d_l_i').prop('checked',true);
  });
  $('#submit').click(function(){
    event.preventDefault();
    if ($('input[name="payway"]').val() == 1) {
      
    };
    var fd = new FormData($(this)[0]);
    dazhu.ajax_commit('<?php echo url('pay_money'); ?>','post',fd);
  });
});
</script>
</body>
</html>