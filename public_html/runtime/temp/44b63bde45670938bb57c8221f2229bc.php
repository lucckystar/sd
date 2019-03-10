<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\wamp\www\shop/application/admin\view\basic\store_setting.html";i:1530069805;}*/ ?>
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
      <div class="db-header">网站信息</div>
      <form class="ajax-commit" action="<?php echo url('store_setting_ok'); ?>" method="post">
        <div class="db-body">
            <div class="form-group">
                <label>网站备案号</label>
                <input class="form-control" name="internet_no" type="text" value="<?php echo $info['internet_no']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>网站名称</label>
                <input class="form-control" name="website_name" type="text" value="<?php echo $info['website_name']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>网站logo</label>
                <input class="form-control" name="website_logo" type="text" value="<?php echo $info['website_logo']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>网站标题</label>
                <input class="form-control" name="website_title" type="text" value="<?php echo $info['website_title']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>网站描述</label>
                <input class="form-control" name="website_describe" type="text" value="<?php echo $info['website_describe']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>网站关键字</label>
                <input class="form-control" name="website_keyword" type="text" value="<?php echo $info['website_keyword']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>联系人</label>
                <input class="form-control" name="linkman" type="text" value="<?php echo $info['linkman']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>联系电话</label>
                <input class="form-control" name="tel" type="text" value="<?php echo $info['tel']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>联系手机</label>
                <input class="form-control" name="phone" type="text" value="<?php echo $info['phone']; ?>"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>详细地址</label>
                <input class="form-control" name="address" type="text" value="<?php echo $info['address']; ?>"/>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="db-footer">
            <button type="submit" class="btn btn-primary">保存</button>
            <button type="button" onclick="javascript:history.go(-1);" class="btn btn-default">取消</button>
        </div>
      </form>
    </div>
</div>
</body>
</html>