<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\wamp\www\shop/application/admin\view\goods\type.html";i:1529925130;}*/ ?>
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
      <table>
          <thead>
              <tr>
                  <th>分类编号</th>
                  <th>分类名称</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $v['goods_type_id']; ?></td>
                  <td><?php echo $v['goods_type_name']; ?></td>
                  <td>
                      <a class="btn btn-xs btn-primary" href="<?php echo url('type_edit',['id'=>$v['goods_type_id']]); ?>">编辑</a>
                      <a class="btn btn-xs btn-danger" href="<?php echo url('type_del',['id'=>$v['goods_type_id']]); ?>">删除</a>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <a type="button" class="btn btn-success" href="<?php echo url('type_add'); ?>">添加</a>
        <div class="dbf-page"></div>
    </div>
  </div>
</div>
</body>
</html>