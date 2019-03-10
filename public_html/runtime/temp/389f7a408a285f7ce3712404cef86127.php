<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\wamp\www\backstage/application/admin\view\admin\admin.html";i:1529925231;}*/ ?>
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
    <div class="db-header">员工列表</div>
    <div class="db-body">
      <table>
          <thead>
              <tr>
                  <th>员工编号</th>
                  <th>头像</th>
                  <th>用户名</th>
                  <th>所属职位</th>
                  <th>真实姓名</th>
                  <th>电话</th>
                  <th>状态</th>
                  <th>是否启用</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $v['staff_id']; ?></td>
                  <td><img class="img-thumbnail" src="/public/static/<?php echo $v['file_path']; ?>"/></td>
                  <td><?php echo $v['staff_username']; ?></td>
                  <td><?php echo $v['position_name']; ?></td>
                  <td><?php echo $v['staff_realname']; ?></td>
                  <td><?php echo $v['staff_phone']; ?></td>
                  <td><switch name="v.staff_status"><case value="1">在职</case><case value="2">离职</case><case value="3">休假</case></switch></td>
                  <td><?php if($v['staff_using'] == '1'): ?>是<?php else: ?>否<?php endif; ?></td>
                  <td>
                      <a class="btn btn-xs btn-primary" href="<?php echo url('staff_edit',['id'=>$v['staff_id']]); ?>">编辑</a>
                      <a class="btn btn-xs btn-danger" href="<?php echo url('staff_del',['id'=>$v['staff_id']]); ?>">删除</a>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <a type="button" class="btn btn-success" href="<?php echo url('staff_add'); ?>">添加</a>
        <div class="dbf-page"></div>
    </div>
  </div>
</div>
</body>
</html>