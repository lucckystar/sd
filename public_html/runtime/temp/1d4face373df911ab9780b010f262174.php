<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\wamp\www\shop/application/admin\view\store\store_edit.html";i:1529662554;}*/ ?>
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
<style type="text/css">
  .choose{display:block;margin-bottom:15px;}
  #allmap{display:none;width:100%;height:500px;margin-bottom:15px;}
  .log-lat{overflow:hidden;clear:both;}
  .log-lat>div{float:left;width:48%;}
  .log-lat>div:first-child{margin-right:15px;}
</style>
<div class="wrapper">
  <div class="data-box">
    <div class="db-header">门店编辑</div>
    <form class="ajax-commit" action="<?php echo url('store_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>门店名称</label>
              <input class="form-control verify" name="store_name" type="text" value="<?php echo $info['store_name']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>门店主图</label>
              <input type="file" class="cropper-fileone" field="store_cover" upload="<?php echo url('Common/uploadone_img'); ?>">
              <div class="imglist">
                <?php if(!(empty($info['store_cover']) || (($info['store_cover'] instanceof \think\Collection || $info['store_cover'] instanceof \think\Paginator ) && $info['store_cover']->isEmpty()))): ?>
                <div>
                  <img class="img-thumbnail" src="/public/static/<?php echo get_file_path($info['store_cover']); ?>"/>
                  <input type="hidden" name="store_cover" value="<?php echo $info['store_cover']; ?>"/>
                  <button class="btn btn-danger" type="button">&times;</button>
                </div>
                <?php endif; ?>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>门店地址</label>
              <input class="form-control verify" name="store_address" type="text" value="<?php echo $info['store_address']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>门店经纬度</label>
              <div class="choose"><button type="button" class="btn btn-primary">选取经纬度</button></div>
              <div id="allmap"></div>
              <div class="log-lat">
                <div class="input-group">
                    <div class="input-group-addon">经度</div>
                    <input class="form-control verify" name="store_longitude" type="text" value="<?php echo $info['store_longitude']; ?>"/>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">纬度</div>
                    <input class="form-control verify" name="store_latitude" type="text" value="<?php echo $info['store_latitude']; ?>"/>
                </div>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
            <label>状态</label>
            <select class="form-control verify" name="store_isonline">
              <option value="0">-请选择-</option>
              <option value="1" <?php if($info['store_isonline'] == '1'): ?>selected<?php endif; ?>>上线</option>
              <option value="2" <?php if($info['store_isonline'] == '2'): ?>selected<?php endif; ?>>下线</option>
            </select>
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
<script type="text/javascript">
  $('.choose button').click(function(){
    // 百度地图API功能
    $('#allmap').show();
    var map = new BMap.Map("allmap");
    map.centerAndZoom(new BMap.Point(116.404,39.915),11);
    map.enableScrollWheelZoom(true); 
    var local = new BMap.LocalSearch(map, {
      renderOptions:{map: map}
    });
    local.search($('input[name="store_address"]').val());
      map.addEventListener("click", function(e){
      $('input[name="store_longitude"]').val(e.point.lng);
      $('input[name="store_latitude"]').val(e.point.lat);
      $('#allmap').hide();
    });
  });
</script>
</body>
</html>