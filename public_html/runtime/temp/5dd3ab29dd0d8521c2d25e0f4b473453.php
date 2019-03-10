<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"D:\wamp\www\shop/application/admin\view\index\setpass.html";i:1530082275;}*/ ?>
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
    <div class="db-header">修改密码</div>
    <form class="ajax-commit" action="<?php echo url(setpass_ok); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
            <label>原密码</label>
            <input class="form-control verify" name="old_pwd" type="password"/>
            <p class="help-block"></p>
          </div>
          <div class="form-group">
            <label>新密码</label>
            <input class="form-control verify passWord" name="new_pwd" type="password"/>
            <p class="help-block"></p>
          </div>
          <div class="form-group">
            <label>确认新密码</label>
            <input class="form-control verify passWord" type="password"/>
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