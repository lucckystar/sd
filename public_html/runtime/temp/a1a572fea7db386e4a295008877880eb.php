<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\wamp\www\shop/application/admin\view\personnel\courier_edit.html";i:1529668362;}*/ ?>
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
    <div class="db-header">配送人员编辑</div>
    <form class="ajax-commit" action="<?php echo url('courier_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>用户名</label>
              <input class="form-control verify" name="courier_username" type="text" value="<?php echo $info['courier_username']; ?>"/>
              <p class="help-block"></p>
          </div>
          <?php if($_SESSION['admin']['position_type'] == '1'): ?>
          <div class="form-group">
              <label>所属门店</label>
              <select class="form-control verify" name="store_id">
                <option value="0">-请选择-</option>
                <?php if(is_array($store_lists) || $store_lists instanceof \think\Collection || $store_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $store_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['store_id']; ?>" <?php if($info['store_id'] == $v['store_id']): ?>selected<?php endif; ?>><?php echo $v['store_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <p class="help-block"></p>
          </div>
          <?php endif; ?>
          <div class="form-group">
              <label>真实姓名</label>
              <input class="form-control verify" name="courier_realname" type="text" value="<?php echo $info['courier_realname']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>电话</label>
              <input class="form-control verify" name="courier_phone" type="text" value="<?php echo $info['courier_phone']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>头像</label>
              <input type="file" class="cropper-fileone" field="courier_portrait" upload="<?php echo url('Common/uploadone_img'); ?>">
              <div class="imglist">
                <?php if(!(empty($info['courier_portrait']) || (($info['courier_portrait'] instanceof \think\Collection || $info['courier_portrait'] instanceof \think\Paginator ) && $info['courier_portrait']->isEmpty()))): ?>
                <div>
                  <img class="img-thumbnail" src="/public/static/<?php echo get_file_path($info['courier_portrait']); ?>"/>
                  <input type="hidden" name="courier_portrait" value="<?php echo $info['courier_portrait']; ?>"/>
                  <button class="btn btn-danger" type="button">&times;</button>
                </div>
                <?php endif; ?>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>是否启用</label>
              <select class="form-control verify" name="courier_using">
                <option value="0">-请选择-</option>
                <option value="1" <?php if($info['courier_using'] == '1'): ?>selected<?php endif; ?>>启用</option>
                <option value="2" <?php if($info['courier_using'] == '2'): ?>selected<?php endif; ?>>禁用</option>
              </select>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>状态</label>
              <select class="form-control verify" name="courier_status">
                <option value="0">-请选择-</option>
                <option value="1" <?php if($info['courier_status'] == '1'): ?>selected<?php endif; ?>>在职</option>
                <option value="2" <?php if($info['courier_status'] == '2'): ?>selected<?php endif; ?>>离职</option>
                <option value="3" <?php if($info['courier_status'] == '3'): ?>selected<?php endif; ?>>休假</option>
              </select>
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