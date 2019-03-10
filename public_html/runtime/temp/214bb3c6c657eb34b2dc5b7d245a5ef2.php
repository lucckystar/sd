<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\shop/application/admin\view\goods\goods.html";i:1534479956;}*/ ?>
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
    <div class="db-header">商品列表</div>
    <div class="db-body">
      <table>
          <thead>
              <tr>
                  <th>商品编号</th>
                  <th>名称</th>
                  <th>封面</th>
                  <th>货号</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $v['goods_id']; ?></td>
                  <td><img class="img-thumbnail" src="/public/uploads/<?php echo $v['file_path']; ?>"/></td>
                  <td><?php echo $v['goods_name']; ?></td>
                  <td><?php echo $v['goods_style']; ?></td>
                  <td>
                    <a class="btn btn-xs btn-success" href="<?php echo url('goods_putaway',['id'=>$v['goods_id']]); ?>">上架</a>
                    <a class="btn btn-xs btn-danger" href="<?php echo url('goods_soldout',['id'=>$v['goods_id']]); ?>">下架</a>
                    <a class="btn btn-xs btn-primary" href="<?php echo url('goods_edit',['id'=>$v['goods_id']]); ?>">编辑</a>
                    <a class="btn btn-xs btn-danger ajax-commit" href="<?php echo url('goods_del',['id'=>$v['goods_id']]); ?>">删除</a>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <a type="button" class="btn btn-success" href="<?php echo url('goods_add'); ?>">添加</a>
        <div class="dbf-page"><?php echo $page; ?></div>
    </div>
  </div>
</div>
</body>
</html>