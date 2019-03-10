<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\wamp\www\shop/application/admin\view\goods\type_edit.html";i:1529661075;}*/ ?>
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
    <div class="db-header">商品分类编辑</div>
    <form class="ajax-commit" action="<?php echo url('type_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>分类名称</label>
              <input class="form-control verify" name="goods_type_name" type="text" value="<?php echo $info['goods_type_name']; ?>"/>
              <p class="help-block"></p>
          </div>
      </div>
      <div class="db-footer">
          <input type="hidden" name="id" value="<?php echo \think\Request::instance()->get('id'); ?>">
          <button type="submit" class="btn btn-primary">保存</button>
          <button type="button" class="btn btn-default">取消</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>