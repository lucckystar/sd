<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\wamp\www\shop/application/admin\view\personnel\position_edit.html";i:1529658364;}*/ ?>
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
.permission label{height:30px;}
</style>
<div class="wrapper">
  <div class="data-box">
    <div class="db-header">职位编辑</div>
    <form class="ajax-commit" action="<?php echo url('position_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>职位名称</label>
              <input class="form-control verify" name="position_name" type="text" value="<?php echo $info['position_name']; ?>"/>
              <p class="help-block"></p>
          </div>
          <?php if(\think\Request::instance()->get('id') != '1'): ?>
          <div class="form-group">
              <label>所属职位</label>
              <select class="form-control verify" name="position_pid">
                <option value="">-请选择-</option>
                <?php if(is_array($position_lists) || $position_lists instanceof \think\Collection || $position_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $position_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['position_id']; ?>" permission='<?php echo $v['position_permission']; ?>' position-type="<?php echo $v['position_type']; ?>" <?php if($info['position_pid']===$v['position_id']){echo 'selected';$info['p_position_type']=$v['position_type'];}?>><?php echo str_repeat('&nbsp;&nbsp;',substr_count($v['position_evalpath'],'-')); ?><?php echo $v['position_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <p class="help-block"></p>
          </div>
          <?php if($_SESSION['admin']['position_type'] != '2'): ?>
          <div class="form-group" <?php if($info['p_position_type'] == '2'): ?>style="display:none;"<?php endif; ?>>
              <label>职位类型</label>
              <div class="checkbox">
                  <label><input type="radio" name="position_type" value="1" <?php if($info['position_type'] == '1'): ?>checked<?php endif; ?>> 总控职位</label>
                  <label><input type="radio" name="position_type" value="2" <?php if($info['position_type'] == '2'): ?>checked<?php endif; ?>> 分店职位</label>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group" <?php if($info['p_position_type'] == 2 || $info['position_type'] != 2): ?>style="display:none;"<?php endif; ?>>
              <label>所属门店</label>
              <select class="form-control verify" name="store_id">
                <option value="">-请选择-</option>
                <?php if(is_array($store_lists) || $store_lists instanceof \think\Collection || $store_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $store_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['store_id']; ?>" <?php if($info['store_id'] == $v['store_id']): ?>selected<?php endif; ?>><?php echo $v['store_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <p class="help-block"></p>
          </div>
          <?php endif; ?>
          <div class="form-group">
              <label>职位权限</label>
              <div class="checkbox permission">
                <?php if(is_array($menu_lists) || $menu_lists instanceof \think\Collection || $menu_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $menu_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <label eval="<?php echo $v['menu_eval']; ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$v['menu_eval']); ?><input type="checkbox" name="position_permission[]" value="<?php echo $v['menu_id']; ?>" <?php if(in_array(($v['menu_id']), is_array($info['position_permission'])?$info['position_permission']:explode(',',$info['position_permission']))): ?>checked<?php endif; ?>><?php echo $v['menu_name']; ?></label><br/>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
              <p class="help-block"></p>
          </div>
          <?php endif; ?>
      </div>
      <div class="db-footer">
          <input type="hidden" name="id" value="<?php echo \think\Request::instance()->get('id'); ?>">
          <button type="submit" class="btn btn-primary">保存</button>
          <button type="button" class="btn btn-default">取消</button>
      </div>
    </form>
  </div>
</div>
<script>
$(document).ready(function(){
  function position_type_change(obj){
    $('input[name="position_permission[]"]').parent('label').each(function(){
      if ($(this).text().indexOf('内部') != -1) {
        $(this).nextUntil('label[eval="'+$(this).attr('eval')+'"]').find('input[type="checkbox"]').prop(obj);
        $(this).find('input[type="checkbox"]').prop(obj);
        return false;
      }
    });
  }
  $('input[type="radio"][name="position_type"]').click(function(){
    if ($(this).val() == 2) {
      $('select[name="store_id"]').parents('.form-group').show();
      position_type_change({'disabled':true,'checked':false});
    }else{
      $('select[name="store_id"]').parents('.form-group').hide();
      position_type_change({'disabled':false});
    }
  });
  $('select[name="position_pid"]').change(function(){
    if (!$(this).val()) {
      $('.permission input[name="position_permission[]"]').prop('disabled',false);
    }else{
      var permission = $(this).find('option:selected').attr('permission');
      $.parseJSON(permission);
      $('.permission input[name="position_permission[]"]').each(function(){
        if (permission.indexOf($(this).val()) != -1) {
          $(this).prop('disabled',false);
        }else{
          $(this).prop({disabled:true,checked:false});
        }
      });
    }
    var type = $(this).find('option:selected').attr('position-type');
    if (type == 2) {
      $('select[name="store_id"],input[name="position_type"]').parents('.form-group').hide();
      position_type_change({'disabled':true,'checked':false});
    }else{
      $('select[name="store_id"],input[name="position_type"]').parents('.form-group').show();
      position_type_change({'disabled':false});
    }
  });
  $('.permission input[name="position_permission[]"]').click(function(){
    var label = $(this).parent('label');
    var eval = label.attr('eval');
    if ($(this).is(':checked')) {
      for (var i=eval-1; i>=1; i--) {
        label.prevAll('label[eval="'+i+'"]:first').find('input[type="checkbox"]').prop('checked',true);
      }
    }else{
      label.nextUntil('label[eval="'+eval+'"]').find('input[type="checkbox"]').prop('checked',false);
    }
  });
});
</script>
</body>
</html>