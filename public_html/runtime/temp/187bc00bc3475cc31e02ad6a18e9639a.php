<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\shop/application/admin\view\order\order.html";i:1530013995;}*/ ?>
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
    <div class="db-header">订单列表</div>
    <div class="db-body">
      <table>
          <thead>
              <tr>
                  <th>订单编号</th>
                  <th>订单号</th>
                  <th>所属门店</th>
                  <th>下单会员</th>
                  <th>订单状态</th>
                  <th>订单金额</th>
                  <th>下单时间</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $v['order_id']; ?></td>
                  <td><?php echo $v['order_number']; ?></td>
                  <td><?php echo $v['store_name']; ?></td>
                  <td><a tabindex="0" role="button" data-toggle="popover" data-title="用户信息" data-content="<p>会员编号：<?php echo $v['member_id']; ?></p><p>电话：<?php echo $v['member_phone']; ?></p><p>姓名：<?php echo $v['member_realname']; ?></p><p>注册时间：<?php echo date('Y-m-d',$v['member_createtime']); ?></p>"><?php echo $v['member_phone']; ?></a></td>
                  <td><a tabindex="0" role="button" data-toggle="popover" data-title="订单记录" data-content="<?php if(is_array($v['order_record']) || $v['order_record'] instanceof \think\Collection || $v['order_record'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['order_record'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><p>时间：{date('Y-m-d H:i:s',$v1['order_record_time'])}  操作：<?php echo get_orderrecord_type($v1['order_record_type']); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>"><?php echo get_order_status($v['order_status']); if($v['order_status'] == '10'): ?> - <?php echo get_order_refundstatus($v['order_refundstatus']); endif; ?></a></td>
                  <td><?php if(in_array(($v['order_status']), explode(',',"2,3,4,10"))): ?><?php echo get_order_payway($v['order_payway']); ?> - <?php endif; ?><?php echo $v['order_money']; ?></td>
                  <td><?php echo date('Y-m-d H:i',$v['order_createtime']); ?></td>
                  <td>
                      <?php if($v['order_status'] == '2'): ?><a class="btn btn-xs btn-success">发货</a> <?php endif; if(in_array(($v['order_status']), explode(',',"2,3,4,10"))): ?><a class="btn btn-xs btn-warning" href="<?php echo url('order_refund',['id'=>$v['order_id']]); ?>">退单</a><?php endif; if($v['order_status'] == '1'): ?><a class="btn btn-xs btn-warning" href="<?php echo url('order_cancel',['id'=>$v['order_id']]); ?>">取消</a><?php endif; ?>
                      <a class="btn btn-xs btn-danger" href="<?php echo url('order_del',['id'=>$v['order_id']]); ?>">删除</a>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <a type="button" class="btn btn-success" href="<?php echo url('order_add'); ?>">添加</a>
        <div class="dbf-page"><?php echo $page; ?></div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover({
    html:true,
    placement:'right',
    trigger:'focus',
  });
});
</script>
</body>
</html>