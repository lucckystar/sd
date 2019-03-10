<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\shop/application/admin\view\store\store.html";i:1529925378;}*/ ?>
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
    <div class="db-header">门店列表</div>
    <div class="db-body">
      <div class="dbb-search">
        <form action="<?php echo url('store'); ?>" method="get">
            <div class="dr-pr-3">
                <div class="input-group">
                    <span class="input-group-addon">门店名称</span>
                    <input type="text" class="form-control" name="name" value="<?php echo \think\Request::instance()->get('name'); ?>">
                </div>
            </div>
            <div class="dr-pr-3">
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> 搜索</button>
            </div>
        </form>
      </div>
      <table>
          <thead>
              <tr>
                  <th>门店编号</th>
                  <th>门店名称</th>
                  <th>创建时间</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $v['store_id']; ?></td>
                  <td><?php echo $v['store_name']; ?></td>
                  <td><?php echo date('Y-m-d H:i',$v['store_createtime']); ?></td>
                  <td>
                      <a class="btn btn-xs btn-primary" href="<?php echo url('store_edit',['id'=>$v['store_id']]); ?>">编辑</a>
                      <a class="btn btn-xs btn-danger" href="<?php echo url('store_del',['id'=>$v['store_id']]); ?>">删除</a>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <a type="button" class="btn btn-success" href="<?php echo url('store_add'); ?>">添加</a>
    </div>
  </div>
</div>
</body>
</html>