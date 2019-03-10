<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\wamp\www\backstage/application/admin\view\admin\role.html";i:1541241961;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <!-- 搜索引擎优化相关 -->
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">

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
    <!-- Data Tables -->
    <link href="/public/static/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <script src="/public/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/public/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 自定义js库 -->
    <script src="/public/static/admin/js/extend.js"></script>
</head>
<style>
.dazhu-page-action{overflow:hidden;}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>基本 <small>分类，查找</small></h5>
        </div>
        <div class="ibox-content">
            <form>
                <label>
                    用户名：
                    <input type="search" class="form-control input-sm">
                </label>
                <label>
                    手机号：
                    <input type="search" class="form-control input-sm">
                </label>
                <label>
                    分类：
                    <select class="form-control input-sm">
                        <option>分类1</option>
                        <option>分类2</option>
                        <option>分类3</option>
                    </select>
                </label>
                <label>
                    <button class="btn btn-info" type="button">添加</button>
                </label>
            </form>
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>职位编号</th>
                    <th>职位名称</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                    <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;$nbsp_num = str_repeat('&nbsp;&nbsp;',substr_count($v['admin_role_evalpath'],'-'));?>
                    <tr>
                        <td><?php echo $nbsp_num; ?>L</td>
                        <td><?php echo $nbsp_num; ?><?php echo $v['admin_role_id']; ?></td>
                        <td><?php echo $nbsp_num; ?><?php echo $v['admin_role_name']; ?></td>
                        <td>
                            <?php echo $nbsp_num; ?>
                            <a class="btn btn-xs btn-primary" href="<?php echo url('role_edit',['id'=>$v['admin_role_id']]); ?>">编辑</a>
                            <a class="btn btn-xs btn-danger" href="<?php echo url('role_add',['id'=>$v['admin_role_id']]); ?>">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="dazhu-page-action">
                <div class="col-sm-6" style="margin-left:-12px;">
                    <button class="btn btn-info" type="button">添加</button>
                    <button class="btn btn-danger" type="button">批量删除</button>
                </div>
                <div class="col-sm-6" style="text-align:right;"></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/public/static/admin/js/plugins/jeditable/jquery.jeditable.js"></script>
<!-- 自定义js -->
<script src="/public/static/admin/js/content.js?v=1.0.0"></script>

</body>
</html>