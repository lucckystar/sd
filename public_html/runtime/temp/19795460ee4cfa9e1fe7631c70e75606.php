<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\shop/application/admin\view\stock\inout.html";i:1529485692;}*/ ?>
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
    <div class="db-header">商品分类列表</div>
    <div class="db-body">
      <div class="dbb-search">
          <div class="dr-pr-3">
              <div class="input-group">
                  <span class="input-group-addon">选择门店</span>
                  <select class="form-control verify" id="store-id">
                    <option value="">-请选择-</option>
                    <volist name="store_lists" id="v">
                    <option value="<?php echo $v['store_id']; ?>"><?php echo $v['store_name']; ?></option>
                    </volist>
                  </select>
              </div>
          </div>
          <div class="dr-pr-9">
              <div class="input-group">
                  <span class="input-group-addon">批次备注：</span>
                  <input class="form-control" id="stock-remark" type="text"/>
              </div>
          </div>
      </div>
      <table>
          <thead>
              <tr>
                  <th>货号</th>
                  <th>信息</th>
                  <th>数量</th>
                  <th>备注信息</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody id="stock-form">
              <tr>
                  <td><input class="form-control verify stock-style" type="text"/></td>
                  <td class="stock-info"></td>
                  <td><input class="form-control verify stock-num" type="number" min="0" step="1"/></td>
                  <td><input class="form-control stock-remark" type="text"/></td>
                  <td>
                    <button type="button" class="btn btn-default stock-in">入库</button>
                    <button type="button" class="btn btn-default stock-out">出库</button>
                    <button type="button" class="btn btn-danger remove">删除</button>
                  </td>
              </tr>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <button type="button" class="btn btn-success"  id="add">添加</button>
        <button type="button" class="btn btn-danger" id="removeAll">清空</button>
        <button type="button" class="btn btn-primary" id="confirm">确认</button>
        <div class="dbf-page"></div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">检查信息</h4>
      </div>
      <div class="modal-body">
        <div class="details-rows">
          <div class="dr-12">
            <div class="data-box">
              <div class="db-header">出入库信息列表</div>
              <div class="db-body">
                <table>
                    <thead>
                        <tr>
                            <th>货号</th>
                            <th>信息</th>
                            <th>数量</th>
                            <th>备注信息</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody  id="stock-msg"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="stock-affirm">提交</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  var add_tr = function(){
    $('#stock-form').append('<tr><td><input class="form-control verify stock-style" type="text"/></td><td class="stock-info"></td><td><input class="form-control verify stock-num" type="number" min="0" step="1"/></td><td><input class="form-control stock-remark" type="text"/></td><td><button type="button" class="btn btn-default stock-in">入库</button>'+"\r"+'<button type="button" class="btn btn-default stock-out">出库</button>'+"\r"+'<button type="button" class="btn btn-danger remove">删除</button></td></tr>');
  }

  $('#add').click(function(){
    add_tr();
  });

  $('#removeAll').click(function(){
    if (!confirm('是否删除全部出入库操作？')) {
      return false;
    }
    $('#stock-form').empty();
    add_tr();
  });

  var parm;
  $('#confirm').click(function(){
    parm = [];
    $('#stock-msg').empty();
    $('#stock-form tr').each(function(){
      var stock;
      if ($(this).find('.btn-primary').hasClass('stock-in')) {
        stock = {'symbol':'+','operation':'入库'};
      }
      if ($(this).find('.btn-primary').hasClass('stock-out')) {
        stock = {'symbol':'-','operation':'出库'};
      }
      var obj_snum = $(this).find('.stock-num');
      if (!verify(obj_snum)) {
        return true;
      }
      var gid = $(this).find('.stock-style').attr('gid');
      if (gid && stock) {
        $('#stock-msg').append('<tr><td>'+$(this).find('.stock-style').val()+'</td><td>'+$(this).find('.stock-info').text()+'</td><td>'+stock.symbol+obj_snum.val()+'</td><td>'+$(this).find('.stock-remark').val()+'</td><td>'+stock.operation+'</td></tr>');
          parm.push({'gid':gid,'symbol':stock.symbol,'num':obj_snum.val(),'remark':$(this).find('.stock-remark').val()});
      }
    });
    $('.bs-example-modal').modal('show');
  });

  $('#stock-affirm').click(function(){
    ajax_frame('/admin/stock/inout_ok','post',JSON.stringify({'remark':$('#stock-remark').val(),'store':$('#store-id').val(),'lists':parm}),function(data){commit_success(data)});
  });

  $(document).off('blur','.stock-style');
  $(document).on('blur','.stock-style',function(){
    if (!verify($('#store-id'))) {
      return false;
    }
    if (!verify($(this))) {
      return false;
    }
    var th = $(this);
    ajax_frame('/admin/stock/inout_info?style='+$(this).val()+'&sid='+$('#store-id').val(),'get','',function(data){
      if (data.id) {
        th.parent('td').next('.stock-info').text('商品编号：'+data.id+'，商品名称：'+data.name+'，当前库存：'+data.num);
        th.attr('gid',data.id);
      }else{
        th.parent('td').next('.stock-info').text('无此商品信息，请检查货号是否正确');
      }
    });
  });

  $(document).off('click','.stock-in,.stock-out');
  $(document).on('click','.stock-in,.stock-out',function(){
    $(this).parent('td').find('.stock-in,.stock-out').removeClass('btn-primary');
    $(this).addClass('btn-primary');
  });

  $(document).off('click','.remove');
  $(document).on('click','.remove',function(){
    if (!confirm('是否删除此条出入库操作？')) {
      return false;
    }
    $(this).parents('tr').remove();
  });

});
</script>
</body>
</html>