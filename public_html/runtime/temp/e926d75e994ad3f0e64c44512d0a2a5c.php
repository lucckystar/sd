<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\wamp\www\shop/application/admin\view\order\order_edit.html";i:1529927132;}*/ ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>达容商城</title>
  <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>

  <link rel="stylesheet" href="/public/static/common/bootstarp/bootstrap.css">
  <script src="/public/static/common/bootstarp/bootstrap.js"></script>

  <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="/public/static/common/uploadify/uploadify.css">
  <script src="/public/static/common/uploadify/jquery.uploadify.min.js"></script>
  <link rel="stylesheet" href="/public/static/common/cropper/cropper.min.css">
  <script src="/public/static/common/cropper/cropper.min.js"></script>

  <link rel="stylesheet" href="/public/static/admin/css/homepage.css">
  <script src="/public/static/admin/js/extend.js"></script>
</head>
<body>
<style>
.modal-body{clear:both;overflow:hidden;}
</style>
<div class="wrapper">
  <div class="data-box">
    <div class="db-header">订单编辑</div>
    <form class="ajax-commit" action="<?php echo url('order_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>订单号</label>
              <input class="form-control verify" name="order_number" type="text"/>
              <p class="help-block"></p>
          </div>
          <?php if(!(empty($store_lists) || (($store_lists instanceof \think\Collection || $store_lists instanceof \think\Paginator ) && $store_lists->isEmpty()))): ?>
          <div class="form-group">
              <label>所属门店</label>
              <select class="form-control verify" name="store_id">
                <option value="">-请选择-</option>
                <?php if(is_array($store_lists) || $store_lists instanceof \think\Collection || $store_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $store_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['store_id']; ?>"><?php echo $v['store_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <p class="help-block"></p>
          </div>
          <?php endif; ?>
          <div class="form-group">
              <label>下单会员（id、电话或编号）</label>
              <input class="form-control verify" name="member_id" type="text"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>订单金额</label>
              <input class="form-control verify" name="order_money" type="text"/>
              <p class="help-block"></p>
          </div>
      </div>
      <div class="db-footer">
          <input type="hidden" name="id" value="<?php echo \think\Request::instance()->get('id'); ?>"/>
          <button type="submit" class="btn btn-primary">保存</button>
          <button type="button" class="btn btn-default">取消</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>