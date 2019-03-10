<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\wamp\www\shop/application/admin\view\goods\property_edit.html";i:1529484751;}*/ ?>
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
        <div class="db-header">商品属性编辑</div>
        <form class="ajax-commit" action="<?php echo url('property_'.empty(input('get.id'))?'insert':'editok'); ?>" method="post">
          <div class="db-body">
              <div class="form-group">
                  <label>属性名称</label>
                  <input class="form-control verify" name="goods_property_name" type="text" value="<?php echo $info['goods_property_name']; ?>"/>
                  <p class="help-block"></p>
              </div>
              <div class="form-group">
                  <label>属性类型</label>
                  <select class="form-control verify" name="goods_property_type">
                    <option value="0">-请选择-</option>
                    <option value="1" <?php if($info['goods_property_type'] == '1'): ?>selected<?php endif; ?>>短文本</option>
                    <option value="2" <?php if($info['goods_property_type'] == '2'): ?>selected<?php endif; ?>>长文本</option>
                    <option value="3" <?php if($info['goods_property_type'] == '3'): ?>selected<?php endif; ?>>选择项</option>
                  </select>
                  <p class="help-block"></p>
              </div>
              <div class="form-group" <?php if($info['goods_property_type'] != '3'): ?>style="display:none;"<?php endif; ?>>
                  <label>属性值</label>
                  <textarea class="form-control verify" name="goods_property_value" rows="3" placeholder="每行一个选项值，如：&#xA选项1&#xA选项2&#xA选项3"><?php echo $info['goods_property_value']; ?></textarea>
                  <p class="help-block"></p>
              </div>
          </div>
          <div class="db-footer">
              <input type="hidden" name="tid" value="<?php echo \think\Request::instance()->get('tid'); ?>">
              <input type="hidden" name="id" value="<?php echo \think\Request::instance()->get('id'); ?>">
              <button type="submit" class="btn btn-primary">保存</button>
              <button type="button" class="btn btn-default">取消</button>
          </div>
        </form>
      </div>
</div>
<script>
$(document).ready(function(){
    $('select[name="goods_property_type"]').change(function(){
      if ($('select[name="goods_property_type"]').val() == 3) {
        $('textarea[name="goods_property_value"]').parent('.form-group').show();
      }else{
        $('textarea[name="goods_property_value"]').parent('.form-group').hide();
      }
    });
});
</script>
</body>
</html>
