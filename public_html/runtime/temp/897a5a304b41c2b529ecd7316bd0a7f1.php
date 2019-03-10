<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\wamp\www\shop/application/admin\view\member\lists.html";i:1529925166;}*/ ?>
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
    <div class="db-header">会员列表</div>
    <div class="db-body">
      <table>
          <thead>
              <tr>
                  <th>会员编号</th>
                  <th>电话</th>
                  <th>姓名</th>
                  <th>性别</th>
                  <th>用户来源</th>
                  <th>注册时间</th>
                  <th>操作</th>
              </tr>
          </thead>
          <tbody>
              <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <tr>
                  <td><?php echo $v['member_id']; ?></td>
                  <td><?php echo $v['member_phone']; ?></td>
                  <td><?php echo $v['member_realname']; ?></td>
                  <td><?php if(!(empty($v['member_sex']) || (($v['member_sex'] instanceof \think\Collection || $v['member_sex'] instanceof \think\Paginator ) && $v['member_sex']->isEmpty()))): if($v['member_sex'] == '1'): ?>男<?php else: ?>女<?php endif; endif; ?></td>
                  <td><?php echo date('Y-m-d H:i',$v['member_createtime']); ?></td>
                  <td>
                    <switch name="v.member_source">
                    <case value="1">微信注册</case>
                    <case value="2">APP注册</case>
                    <case value="3">电脑网站注册</case>
                    <case value="4">移动网站注册</case>
                    <case value="5">后台导入</case>
                    </switch>
                  </td>
                  <td>
                      <a class="btn btn-xs btn-info" href="/admin/member/">重置密码</a>
                      <a class="btn btn-xs btn-info" href="/admin/member/">禁用</a>
                      <a class="btn btn-xs btn-info" href="/admin/member/">启用</a>
                      <a class="btn btn-xs btn-info" href="/admin/member/">发送信息</a>
                  </td>
              </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
    </div>
    <div class="db-footer">
        <a type="button" class="btn btn-success" href="/admin/member/goods_add">添加</a>
        <div class="dbf-page"><?php echo $page; ?></div>
    </div>
  </div>
</div>
</body>
</html>