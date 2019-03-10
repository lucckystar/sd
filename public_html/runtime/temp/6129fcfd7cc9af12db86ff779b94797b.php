<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/www/web/yuewu/public_html/application/admin/view/teacher/user_teacher_update_show.html";i:1547358365;}*/ ?>
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
            <h5>教师信息修改</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="<?php echo url('Teacher/user_teacher_update'); ?>" class="form-horizontal ajax-commit" enctype="multipart/form-data">
            <!-- <div class="form-group">
              <label class="col-sm-2 control-label">舞蹈类型id</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="dance_type_id" value="" >
              </div>
            </div> -->
            <input type="hidden" value="" name="dance_type_id">
            <div class="form-group">
              <label class="col-sm-2 control-label">教师名称</label>
              <div class="col-sm-10">
                <input type="hidden" name="user_teacher_id" value="<?php echo $user_teacher_find['user_teacher_id']; ?>">
                <input class="form-control verify" type="text" name="teacher_name" value="<?php echo $user_teacher_find['teacher_name']; ?>">
              </div>
            </div>
<!--             <div class="form-group">
              <label class="col-sm-2 control-label">机构头像</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="teacher_portrait" value="<?php echo $user_teacher_find['teacher_portrait']; ?>">
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-2 control-label">教师地址</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="teacher_site" value="<?php echo $user_teacher_find['teacher_site']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师授课时间</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="schooltime" value="<?php echo $user_teacher_find['schooltime']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师简介</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="teacher_intro" value="<?php echo $user_teacher_find['teacher_intro']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师客服电话</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="teacher_phone" value="<?php echo $user_teacher_find['teacher_phone']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师舞蹈类型</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="teacher_master" value="<?php echo $user_teacher_find['teacher_master']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师等级</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="teacher_level" value="<?php echo $user_teacher_find['teacher_level']; ?>">
              </div>
            </div>
<!--             <div class="form-group">
              <label class="col-sm-2 control-label">教师关注数</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="organization_attention" value="">
              </div>
            </div> -->
            
            <div class="form-group">
              <label class="col-sm-2 control-label">教师状态</label>
              <div class="col-sm-10" style="height: 30px;">
                <select class="form-control m-b" name="teacher_state" style="height: 30px;padding-bottom: 0px;padding-top: 0px;padding-left: 12px;border-bottom-width: 1px;"">
                    <option selected="selected" value="<?php echo $user_teacher_find['teacher_state']; ?>">
                    <?php if(strtoupper($user_teacher_find['teacher_state']) == 1): ?>正常
                    <?php elseif(strtoupper($user_teacher_find['teacher_state']) == 2): ?>封停
                    <?php endif; ?>
                    </option>
                    <option value="1">正常</option>
                    <option value="2">封停</option>
                </select>
<!--                 <input class="form-control verify" type="text" name="teacher_state" value="<?php echo $user_teacher_find['teacher_state']; ?>">
 -->              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">机构所属地区</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="district_name" value="<?php echo $user_teacher_find['district_name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师创建时间</label>
              <div class="col-sm-10">
                <input class="form-control verify" disabled type="text" name="teacher_creattime" value="<?php echo date('y-m-d H:m:s',$user_teacher_find['teacher_creattime']); ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">教师余额</label>
              <div class="col-sm-10">
                <input class="form-control verify" disabled type="text" name="teacher_money" value="<?php echo $user_teacher_find['teacher_money']; ?>">
              </div>
            </div>

            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary" type="submit">保存内容</button>
                    <a class="btn btn-white" type="reset" href="<?php echo url('Teacher/user_teacher_list',['user_teacher_id'=>$user_teacher_find['user_teacher_id']]); ?>">取消</a>
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