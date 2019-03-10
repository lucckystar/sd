<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\wamp\www\shop/application/admin\view\member\member_edit.html";i:1530001620;}*/ ?>
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
    <div class="db-header">会员编辑</div>
    <form class="ajax-commit" action="<?php echo url('member_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>手机号</label>
              <input class="form-control verify" name="member_phone" type="text"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>姓名</label>
              <input class="form-control verify" name="member_realname" type="text"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>性别</label>
              <div class="checkbox">
                  <label><input type="radio" name="member_sex" value="1" checked> 男</label>
                  <label><input type="radio" name="member_sex" value="2"> 女</label>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>是否启用</label>
              <div class="checkbox">
                  <label><input type="radio" name="member_using" value="1" checked> 启用</label>
                  <label><input type="radio" name="member_using" value="2"> 禁用</label>
              </div>
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