<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/web/yuewu/public_html/application/admin/view/area/area_edit_show.html";i:1545394403;}*/ ?>
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
            <h5>地区信息修改</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="<?php echo url('Area/area_edit'); ?>" class="form-horizontal ajax-commit">
            <div class="form-group">
              <label class="col-sm-2 control-label">地区名称</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="district_name" value="<?php echo $district_find['district_name']; ?>" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">地区账号</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="district_account" value="<?php echo $district_find['district_account']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">地区密码</label>
              <div class="col-sm-10">
                <input class="form-control verify" type="text" name="district_psd" value="<?php echo $district_find['district_psd']; ?>">
              </div>
            </div>
            
            <!-- <div class="hr-line-dashed"></div> -->
            <!-- <div class="form-group">
              <label class="col-sm-2 control-label">头像</label>
              <div class="col-sm-10">
                <input type="file" class="cropper-fileone" field="answer_people_pic" upload="">
                 <div class="imglist">
                  
                  <div>
                    <img class="img-thumbnail" src="/public/static/upload/"/>
                    <input type="hidden" name="answer_people_pic" value=""/>
                    <button class="btn btn-danger" type="button">&times;</button>
                  </div>
                  
                </div>
              </div>
            </div> -->
            <!-- <div class="hr-line-dashed"></div> -->
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <input type="hidden" name="district_id" value="<?php echo $district_find['district_id']; ?>">
                    <button class="btn btn-primary" type="submit">保存内容</button>
                    <a class="btn btn-white" type="reset" href="<?php echo url('Area/area_list'); ?>">取消</a>
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
<link href="/public/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet"> -->
<!-- <script>
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