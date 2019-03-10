<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\wamp\www\shop/application/admin\view\goods\goods_edit.html";i:1529742680;}*/ ?>
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
.modal-body{clear:both;overflow:hidden;}
</style>
<div class="wrapper">
  <div class="data-box">
    <div class="db-header">商品编辑</div>
    <form class="ajax-commit" action="<?php echo url('goods_'.(empty(input('get.id'))?'insert':'editok')); ?>" method="post">
      <div class="db-body">
          <div class="form-group">
              <label>名称</label>
              <input class="form-control verify" name="goods_name" type="text" value="<?php echo $info['goods_name']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>封面图</label>
              <input type="file" class="cropper-fileone" field="goods_cover" upload="__MODULE__/Common/uploadone_img">
              <div class="imglist">
                <?php if(!(empty($info['goods_cover']) || (($info['goods_cover'] instanceof \think\Collection || $info['goods_cover'] instanceof \think\Paginator ) && $info['goods_cover']->isEmpty()))): ?>
                <div>
                  <img class="img-thumbnail" src="/public/static/<?php echo get_file_path($info['goods_cover']); ?>"/>
                  <input type="hidden" name="goods_cover" value="<?php echo $info['goods_cover']; ?>"/>
                  <button class="btn btn-danger" type="button">&times;</button>
                </div>
                <?php endif; ?>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>banner</label>
              <input type="file" class="cropper-file" field="goods_banner[]" upload="<?php echo url('Common/uploadone_img'); ?>">
              <div class="imglist">
                <?php if(is_array($GoodsBanner_lists) || $GoodsBanner_lists instanceof \think\Collection || $GoodsBanner_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsBanner_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <div>
                  <img class="img-thumbnail" src="/public/static/<?php echo $v['file_path']; ?>"/>
                  <input type="hidden" name="goods_banner[]" value="<?php echo $v['goods_banner_file']; ?>"/>
                  <button class="btn btn-danger" type="button">&times;</button>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>单位</label>
              <input class="form-control verify" name="goods_unit" type="text" value="<?php echo $info['goods_unit']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>价格</label>
              <input class="form-control verify" name="goods_price" type="text" value="<?php echo $info['goods_price']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>货号</label>
              <input class="form-control verify" name="goods_style" type="text" value="<?php echo $info['goods_style']; ?>"/>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label>上架状态</label>
              <select class="form-control verify" name="goods_isputaway">
                <option value="">-请选择-</option>
                <option value="1" <?php if($info['goods_isputaway'] == '1'): ?>selected<?php endif; ?>>上架</option>
                <option value="2" <?php if($info['goods_isputaway'] == '2'): ?>selected<?php endif; ?>>下架</option>
              </select>
              <p class="help-block"></p>
          </div>
          <eq name="_SESSION['admin']['position_type']" value="1">
          <div class="form-group">
              <label>所属门店</label>
              <select class="form-control verify" name="store_id">
                <option value="">-请选择-</option>
                <?php if(is_array($store_lists) || $store_lists instanceof \think\Collection || $store_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $store_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['store_id']; ?>" <?php if($info['store_id'] == $v['store_id']): ?>selected<?php endif; ?>><?php echo $v['store_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <p class="help-block"></p>
          </div>
          </eq>
          <div class="form-group">
              <label>分类</label>
              <select class="form-control verify" name="goods_type_id">
                <option value="">-请选择-</option>
                <?php if(is_array($type_lists) || $type_lists instanceof \think\Collection || $type_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $type_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['goods_type_id']; ?>" <?php if($info['goods_type_id'] == $v['goods_type_id']): ?>selected<?php endif; ?>><?php echo $v['goods_type_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <p class="help-block"></p>
          </div>
          <div class="form-group">
              <label><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal1">选择属性</button></label>
              <p class="help-block"></p>
          </div>
          <?php if(is_array($GoodsGP_lists) || $GoodsGP_lists instanceof \think\Collection || $GoodsGP_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $GoodsGP_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
          <div class="form-group property_affirm">
              <label><?php echo $v['goods_property_name']; ?></label>
              <?php switch($v['goods_property_type']): case "1": ?>
              <input class="form-control verify" name="goods_property[<?php echo $v['goods_property_id']; ?>]" type="text" value="<?php echo $v['goods_g_p_value']; ?>"/>
              <?php break; case "2": ?>
              <textarea class="form-control verify" name="goods_property[<?php echo $v['goods_property_id']; ?>]" rows="3"><?php echo $v['goods_g_p_value']; ?></textarea>
              <?php break; case "3": ?>
              <select class="form-control verify" name="goods_property[<?php echo $v['goods_property_id']; ?>]">
                <option value="">-请选择-</option>
                <?php $_result=json_decode($v['goods_property_value'],true);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v1; ?>" <eq name="v.goods_g_p_value" value="$v1">selected</eq>><?php echo $v1; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <?php break; endswitch; ?>
              <p class="help-block"></p>
          </div>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <div class="form-group">
              <label>商品详情页</label>
              <textarea class="form-control verify" name="goods_centents" rows="3"><?php echo $info['goods_centents']; ?></textarea>
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

<div class="modal fade bs-example-modal1" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">选择属性</h4>
      </div>
      <div class="modal-body property_lists">
        <label>搜索属性</label>
        <input class="form-control property_search" type="text"/>
        <?php if(is_array($property_lists) || $property_lists instanceof \think\Collection || $property_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $property_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <div class="form-group">
          <div class="checkbox">
              <label>
                  <input type="checkbox" value="<?php echo $v['goods_property_id']; ?>" type-id="<?php echo $v['goods_type_id']; ?>" ptype="<?php echo $v['goods_property_type']; ?>" pvalue='<?php echo $v['goods_property_value']; ?>'/><?php echo $v['goods_property_name']; ?>
              </label>
          </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="property_affirm">确认</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $(document).off('input propertychange change','.property_search');
    $(document).on('input propertychange change','.property_search',function(){
      $('.property_lists .form-group').each(function(){
        if ($(this).find('label').text().indexOf($('.property_search').val())==(-1)){
          $(this).hide();
        }else{
          $(this).show();
        }
      });
    });
    $('#property_affirm').click(function(){
      $('.property_affirm').remove();
      $('.property_lists input[type="checkbox"]:checked:visible').each(function(){
        var html;
        var name = $(this).parent().text();
        var ptype = $(this).attr('ptype');
        if (ptype == 1) {
          html = '<input class="form-control verify" name="goods_property['+$(this).val()+']" type="text"/>';
        }
        if (ptype == 2) {
          html = '<textarea class="form-control verify" name="goods_property['+$(this).val()+']" rows="3"></textarea>';
        }
        if (ptype ==3) {
          var option = $.parseJSON($(this).attr('pvalue'));
          var option_html;
          for (var i = 0; i < option.length; i++) {
            option_html += '<option value="'+option[i]+'">'+option[i]+'</option>';
          };
          html = '<select class="form-control verify" name="goods_property['+$(this).val()+']"><option value="">-请选择-</option>'+option_html+'</select>';
        }
        $('textarea[name="goods_centents"]').parent('.form-group').before('<div class="form-group property_affirm"><label>'+name+'</label>'+html+'<p class="help-block"></p></div>');
      });
      $('.bs-example-modal1').modal('hide');
    });
});
</script>
</body>
</html>
