<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\wamp\www\backstage/application/admin\view\admin\role_edit.html";i:1541244452;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <!-- 搜索引擎优化相关 -->
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <title>达竹科技总控后台</title>

    <!-- jquery -->
    <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>
    <!-- bootstarp -->
    <link rel="stylesheet" href="/public/static/common/bootstarp/bootstrap.min.css">
    <script src="/public/static/common/bootstarp/bootstrap.js"></script>
    <!-- 字体库 -->
    <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">
    <!-- iCheck -->
    <script src="/public/static/admin/js/plugins/iCheck/icheck.min.js"></script>
    <link href="/public/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 自定义js库 -->
    <script src="/public/static/admin/js/extend.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>编辑页面 <small>编辑页面</small></h5>
        </div>
        <div class="ibox-content">
          <form method="get" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">职位名称</label>
              <div class="col-sm-10">
                <input class="form-control verify" name="admin_role_name" type="text" value="<?php echo $info['admin_role_name']; ?>"/>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <?php if(\think\Request::instance()->get('id') != '1'): ?>
            <div class="form-group">
              <label class="col-sm-2 control-label">所属职位</label>
              <div class="col-sm-10">
                <select class="form-control verify" name="admin_role_pid">
                  <option value="">-请选择-</option>
                  <?php if(is_array($AdminRole_lists) || $AdminRole_lists instanceof \think\Collection || $AdminRole_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $AdminRole_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $v['admin_role_id']; ?>" permission='<?php echo $v['admin_role_permission']; ?>' <?php if($v['admin_role_id'] == $info['admin_role_pid']): ?>selected<?php endif; ?>><?php echo str_repeat('&nbsp;&nbsp;',substr_count($v['admin_role_evalpath'],'-')); ?><?php echo $v['admin_role_name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">职位权限</label>
              <div class="col-sm-10 permission">
                <?php if(is_array($AdminMenu_lists) || $AdminMenu_lists instanceof \think\Collection || $AdminMenu_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $AdminMenu_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <div class="checkbox">
                  <label eval="<?php echo $v['admin_menu_eval']; ?>">
                    <?php echo str_repeat('&nbsp;&nbsp;&nbsp;',$v['admin_menu_eval']); ?><input type="checkbox" name="admin_role_permission[]" value="<?php echo $v['admin_menu_id']; ?>" <?php if(in_array(($v['admin_menu_id']), is_array($info['admin_role_permission'])?$info['admin_role_permission']:explode(',',$info['admin_role_permission']))): ?>checked<?php endif; ?>> <?php echo $v['admin_menu_name']; ?>
                  </label>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <?php endif; ?>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <input type="hidden" name="id" value="<?php echo \think\Request::instance()->get('id'); ?>">
                    <button class="btn btn-primary" type="submit">保存内容</button>
                    <button class="btn btn-white" type="submit">取消</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 自定义js -->
<script src="/public/static/admin/js/content.js?v=1.0.0"></script>
<!-- iCheck -->
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

<script>
$(document).ready(function(){
  $('.permission input[name="admin_role_permission[]"]').click(function(){
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