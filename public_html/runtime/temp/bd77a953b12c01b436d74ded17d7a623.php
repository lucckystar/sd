<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\wamp\www\shop/application/admin\view\basic\basic_setting.html";i:1529579489;}*/ ?>
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
<div class="wrapper">
  <div class="data-box">
    <div class="db-header">网络管理</div>
    <form class="ajax-commit" action="<?php echo url('basic_setting_ok'); ?>" method="post">
      <div class="db-body">
        <div class="form-group">
            <label>附件上传大小</label>
            <div class="input-group">
                <input class="form-control" name="upload_size" type="text" value="<?php echo $info['upload_size']; ?>"/>
                <div class="input-group-addon">M</div>
            </div>
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label>默认库存</label>
            <div class="input-group">
                <input class="form-control" name="stock_default" type="text" value="<?php echo $info['stock_default']; ?>"/>
                <div class="input-group-addon">件</div>
            </div>
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label>库存预警数</label>
            <div class="input-group">
                <input class="form-control" name="stock_warning" type="text" value="<?php echo $info['stock_warning']; ?>"/>
                <div class="input-group-addon">件</div>
            </div>
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label>减库存时机</label>
            <div class="radio">
                <label><input name="stock_subtract_timing" type="radio" value="1" <?php if($info['stock_subtract_timing'] == '1'): ?>checked<?php endif; ?>/>下单后</label>
                <label><input name="stock_subtract_timing" type="radio" value="2" <?php if($info['stock_subtract_timing'] == '2'): ?>checked<?php endif; ?>/>发货后</label>
            </div>
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label>自动收货时间</label>
            <div class="input-group">
                <input class="form-control" name="take_day" type="text" value="<?php echo $info['take_day']; ?>"/>
                <div class="input-group-addon">天</div>
            </div>
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">全场满</div>
                <input class="form-control" name="freight_full" type="text" value="<?php echo $info['freight_full']; ?>"/>
                <div class="input-group-addon">元免运费</div>
            </div>
            <p class="help-block"></p>
        </div>
      </div>
      <div class="db-footer">
          <button type="submit" class="btn btn-primary">保存</button>
          <button type="button" class="btn btn-default">取消</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>