<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:97:"/www/web/yuewu/public_html/application/admin/view/curriculum/organization_curriculum_details.html";i:1547626597;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<!--     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit"> -->
    <!-- 搜索引擎优化相关 -->
<!--     <meta name="keywords" content="">
    <meta name="description" content=""> -->

<!--     <link rel="shortcut icon" href="favicon.ico"> -->

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
    <!-- animate -->
    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 自定义js库 -->
<!--     <script src="/public/static/admin/js/content.js?v=1.0.0"></script>
    <script src="/public/static/admin/js/extend.js"></script> -->
</head>
<body class="gray-bg">
<!-- <div class="wrapper wrapper-content animated fadeInRight">
 -->  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>机构课程信息详情</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="<?php echo url('Curriculum/organization_curriculum_update'); ?>" class="form-horizontal ajax-commit" enctype="multipart/form-data">
            <input type="hidden" value="" name="dance_type_id">
            <div class="form-group">
              <label class="col-sm-2 control-label">课程名称</label>
              <div class="col-sm-10">
                <input disabled type="hidden" name="curriculum_id" value="<?php echo $organization_curriculum_find['curriculum_id']; ?>">
                <input disabled class="form-control verify" type="text" name="curriculum_name" value="<?php echo $organization_curriculum_find['curriculum_name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">课程导师</label>
              <div class="col-sm-10">
                <input disabled class="form-control verify" type="text" name="curriculum_admin" value="<?php echo $organization_curriculum_find['curriculum_admin']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">课程负责人</label>
              <div class="col-sm-10">
                <input disabled class="form-control verify" type="text" name="organization_business_hours" value="<?php echo $organization_curriculum_find['organization_name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">收藏数</label>
              <div class="col-sm-10">
                <input disabled class="form-control verify" type="text" name="organization_synopsis" value="<?php echo $organization_curriculum_find['curriculum_collect']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">有效时间</label>
              <div class="col-sm-10">
                <input disabled class="form-control verify" type="text" name="curriculum_state" value="<?php if(strtoupper($organization_curriculum_find['curriculum_state']) != 1): ?>长期有效
                <?php else: ?><?php echo date("Y-m-d",$organization_curriculum_find['curriculum_start_time']); ?>至<?php echo date("Y-m-d",$organization_curriculum_find['curriculum_over_time']); endif; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">最大人数</label>
              <div class="col-sm-10">
                <input disabled class="form-control verify" type="text" name="max_people_number" value="<?php echo $organization_curriculum_find['max_people_number']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">舞蹈种类</label>
              <div class="col-sm-10">
                <input disabled class="form-control verify" type="text" name="dance_type_name" value="<?php echo $organization_curriculum_find['dance_type_name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">课程状态</label>
              <div class="col-sm-10">
                <select class="form-control m-b" name="curriculum_state" style="height: 35px;padding-bottom: 0px;padding-top: 0px;padding-left: 12px;">
                    <option selected="selected" value="<?php echo $organization_curriculum_find['curriculum_state']; ?>">
                    <?php if(strtoupper($organization_curriculum_find['curriculum_state']) == 1): ?>正常
                    <?php elseif(strtoupper($organization_curriculum_find['curriculum_state']) == 2): ?>封停
                    <?php endif; ?>
                    </option>
                    <option value="1">正常</option>
                    <option value="2">封停</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <!-- <button class="btn btn-primary" type="submit">保存内容</button> -->
                    
                    <a class="btn btn-white" type="reset" href="<?php echo url('Curriculum/organization_curriculum_list'); ?>">返回</a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->

<!-- iCheck -->
<!-- <script src="/public/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<link href="/public/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
<script>
$(document).ready(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
});
</script> -->

<!-- uploadify and cropper -->
<!-- <link rel="stylesheet" href="/public/static/common/uploadify/uploadify.css">
<link rel="stylesheet" href="/public/static/common/uploadify/imglist.css">
<script src="/public/static/common/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" href="/public/static/common/cropper/cropper.min.css">
<script src="/public/static/common/cropper/cropper.min.js"></script> -->

</body>
</html>