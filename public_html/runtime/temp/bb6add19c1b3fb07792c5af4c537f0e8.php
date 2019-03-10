<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\wamp\www\shop/application/admin\view\index\index.html";i:1537029956;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>达竹电商宝</title>
  <!-- jquery -->
  <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>
  <!-- bootstarp -->
  <link rel="stylesheet" href="/public/static/common/bootstarp/bootstrap.css">
  <script src="/public/static/common/bootstarp/bootstrap.js"></script>
  <!-- 字体库 -->
  <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">
  <!-- 图片上传插件 -->
  <link rel="stylesheet" href="/public/static/common/uploadify/uploadify.css">
  <script src="/public/static/common/uploadify/jquery.uploadify.min.js"></script>
  <!-- 图片截取插件 -->
  <link rel="stylesheet" href="/public/static/common/cropper/cropper.min.css">
  <script src="/public/static/common/cropper/cropper.min.js"></script>
  <!-- 颜色版插件 -->
  <!-- <link rel="stylesheet" href="/public/static/common/colpick/css/normalize.css" type="text/css"/> -->
  <!-- <link rel="stylesheet" href="/public/static/common/colpick/css/style.css" type="text/css"/> -->
  <!-- <link rel="stylesheet" href="/public/static/common/colpick/css/colpick.css" type="text/css"/> -->
  <script src="/public/static/common/colpick/js/colpick.js"></script>
  <script src="/public/static/common/colpick/js/plugin.js"></script>
  <!-- 自定义 -->
  <link rel="stylesheet" href="/public/static/admin/css/index.css">
  <link rel="stylesheet" href="/public/static/admin/css/index03.css">
  <script src="/public/static/admin/js/common.js"></script>
</head>
<body>
<div class="wrapper">

  <div class="nav">
    <div class="nav-logo"><a href="">达竹电商宝</a></div>
    <!-- <div class="nav-user">
      <div class="nav-u-img"><img src="/public/static/admin/images/default.jpg"></div>
      <div class="nav-u-right">
        <div class="nav-u-r-name">石智勇</div>
        <div class="nav-u-r-name">超级管理员</div>
      </div>
    </div> -->
    <div class="nav-list">
      <ul>
        <?php if(is_array($menuList) || $menuList instanceof \think\Collection || $menuList instanceof \think\Paginator): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <li class="nav-l-header"><i class="fa fa-search"></i> <?php echo $v['menu_name']; ?></li>
        <?php if(is_array($v['menu_menu']) || $v['menu_menu'] instanceof \think\Collection || $v['menu_menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['menu_menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
        <li>
          <a class="iframe-href" href="<?php if(empty($v1['menu_url']) || (($v1['menu_url'] instanceof \think\Collection || $v1['menu_url'] instanceof \think\Paginator ) && $v1['menu_url']->isEmpty())): ?>javascript:;<?php else: ?><?php echo url($v1['menu_url']); endif; ?>">
            <?php if(!(empty($v1['menu_icon']) || (($v1['menu_icon'] instanceof \think\Collection || $v1['menu_icon'] instanceof \think\Paginator ) && $v1['menu_icon']->isEmpty()))): ?><i class="fa <?php echo $v1['menu_icon']; ?>"></i><?php endif; ?>
            <span><?php echo $v1['menu_name']; ?></span> 
            <?php if(!(empty($v1['menu_menu']) || (($v1['menu_menu'] instanceof \think\Collection || $v1['menu_menu'] instanceof \think\Paginator ) && $v1['menu_menu']->isEmpty()))): ?>
            <span class="nav-lula-right"><i class="fa fa-angle-left"></i></span>
            <?php endif; ?>
          </a>
          <?php if(!(empty($v1['menu_menu']) || (($v1['menu_menu'] instanceof \think\Collection || $v1['menu_menu'] instanceof \think\Paginator ) && $v1['menu_menu']->isEmpty()))): ?>
          <ul>
            <?php if(is_array($v1['menu_menu']) || $v1['menu_menu'] instanceof \think\Collection || $v1['menu_menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['menu_menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
            <li>
              <a class="iframe-href" href="<?php if(empty($v2['menu_url']) || (($v2['menu_url'] instanceof \think\Collection || $v2['menu_url'] instanceof \think\Paginator ) && $v2['menu_url']->isEmpty())): ?>javascript:;<?php else: ?><?php echo url($v2['menu_url']); endif; ?>">
                <?php if(!(empty($v2['menu_icon']) || (($v2['menu_icon'] instanceof \think\Collection || $v2['menu_icon'] instanceof \think\Paginator ) && $v2['menu_icon']->isEmpty()))): ?><i class="fa <?php echo $v2['menu_icon']; ?>"></i><?php endif; ?>
                <span><?php echo $v2['menu_name']; ?></span>
              </a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <?php endif; ?>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </div>

  <div class="details">
    <div class="details-header">
      <!-- <div class="details-h-icon" id="dhn-lfet"><i class="fa fa-align-left"></i></div> -->
      <div class="details-h-right">
        <!-- <div class="details-h-icon"><i class="fa fa-envelope-o"><span class="bg-success">4</span></i></div> -->
        <!-- <div class="details-h-icon"><i class="fa fa-bell-o"><span class="bg-warning">10</span></i></div> -->
        <!-- <div class="details-h-icon"><i class="fa fa-flag-o"><span class="bg-danger">9</span></i></div> -->
        <div class="details-hr-user">
          <img class="details-hru-img" src="/public/static/<?php if(empty($_SESSION['admin']['staff_portrait']) || (($_SESSION['admin']['staff_portrait'] instanceof \think\Collection || $_SESSION['admin']['staff_portrait'] instanceof \think\Paginator ) && $_SESSION['admin']['staff_portrait']->isEmpty())): ?>admin/images/default.jpg<?php else: ?><?php echo $_SESSION['admin']['staff_portrait_url']; endif; ?>">
          <span class="details-hru-name"><?php echo $_SESSION['admin']['staff_username']; ?></span>
          <div class="details-hru-info">
            <div class="details-hrui-header">
              <img src="/public/static/<?php if(empty($_SESSION['admin']['staff_portrait']) || (($_SESSION['admin']['staff_portrait'] instanceof \think\Collection || $_SESSION['admin']['staff_portrait'] instanceof \think\Paginator ) && $_SESSION['admin']['staff_portrait']->isEmpty())): ?>admin/images/default.jpg<?php else: ?><?php echo $_SESSION['admin']['staff_portrait_url']; endif; ?>">
              <span><?php echo $_SESSION['admin']['staff_realname']; ?> - <?php echo $_SESSION['admin']['position_name']; ?></span>
              <p><?php echo $_SESSION['admin']['staff_username']; ?></p>
            </div>
            <div class="details-hrui-body"></div>
            <div class="details-hrui-footer">
              <div class="details-hruif-left"><a class="iframe-href" href="<?php echo url('index/setpass'); ?>">修改密码</a></div>
              <div class="details-hruif-right"><a href="<?php echo url('index/logout'); ?>">退出登录</a></div>
            </div>
          </div>
        </div>
        <div class="details-h-icon details-hr-cog">
          <i class="fa fa-cog"></i>
          <div class="details-hr-c-info">
            <div class="details-hr-c-i-list">
              <div class="details-hr-c-i-l-title">颜色方案</div>
              <div class="details-hr-c-i-l-color">
                <div class="details-hr-c-i-l-list" scheme="1">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案1</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="2">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案2</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="3">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案3</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="4">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案4</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="5">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案5</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="6">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案6</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="7">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案7</div>
                </div>
                <div class="details-hr-c-i-l-list" scheme="8">
                  <div class="details-hr-c-i-l-l-img"><img src="/public/static/admin/images/fangan1.jpg"></div>
                  <div class="details-hr-c-i-l-l-name">方案8</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="details-nav">
      <div class="details-n-list" id="nav-lastpage"><i class="fa fa-angle-double-left"></i></div>
      <span id="nav-pagelist">
        <div class="details-n-list details-nl-hover" id="nav-homepage"><i class="fa fa-desktop"></i></div>
      </span>
      <div class="details-n-right">
        <div class="details-n-list" id="nav-nextpage"><i class="fa fa-angle-double-right"></i></div>
      </div>
    </div>
    <div class="details-html"></div>
  </div>
</div>
</body>
</html>



