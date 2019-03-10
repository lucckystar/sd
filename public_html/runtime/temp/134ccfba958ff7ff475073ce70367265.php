<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\wamp\www\backstage/application/admin\view\index\index.html";i:1541237714;}*/ ?>
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

    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 自定义js库 -->
    <script src="/public/static/admin/js/extend.js"></script>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">乐舞总控</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">乐舞</div>
                    </li>

                    <?php if(is_array($AdminMenu_list) || $AdminMenu_list instanceof \think\Collection || $AdminMenu_list instanceof \think\Paginator): $i = 0; $__LIST__ = $AdminMenu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a class="J_menuItem" href="<?php if(empty($v['admin_menu_url']) || (($v['admin_menu_url'] instanceof \think\Collection || $v['admin_menu_url'] instanceof \think\Paginator ) && $v['admin_menu_url']->isEmpty())): ?>javascript:;<?php else: ?><?php echo url($v['admin_menu_url']); endif; ?>">
                            <?php if(!(empty($v['admin_menu_icon']) || (($v['admin_menu_icon'] instanceof \think\Collection || $v['admin_menu_icon'] instanceof \think\Paginator ) && $v['admin_menu_icon']->isEmpty()))): ?><i class="fa <?php echo $v['admin_menu_icon']; ?>"></i><?php endif; ?>
                            <span><?php echo $v['admin_menu_name']; ?></span>
                            <!-- <i class="fa fa-table"></i> -->
                            <!-- <span class="nav-label">表格</span> -->
                            <?php if(!(empty($v['menu_menu']) || (($v['menu_menu'] instanceof \think\Collection || $v['menu_menu'] instanceof \think\Paginator ) && $v['menu_menu']->isEmpty()))): ?>
                            <span class="fa arrow"></span>
                            <?php endif; ?>
                        </a>
                        <?php if(!(empty($v['menu_menu']) || (($v['menu_menu'] instanceof \think\Collection || $v['menu_menu'] instanceof \think\Paginator ) && $v['menu_menu']->isEmpty()))): ?>
                        <ul class="nav nav-second-level">
                            <?php if(is_array($v['menu_menu']) || $v['menu_menu'] instanceof \think\Collection || $v['menu_menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['menu_menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a class="J_menuItem" href="<?php if(empty($v1['admin_menu_url']) || (($v1['admin_menu_url'] instanceof \think\Collection || $v1['admin_menu_url'] instanceof \think\Paginator ) && $v1['admin_menu_url']->isEmpty())): ?>javascript:;<?php else: ?><?php echo url($v1['admin_menu_url']); endif; ?>">
                                    <?php if(!(empty($v1['admin_menu_icon']) || (($v1['admin_menu_icon'] instanceof \think\Collection || $v1['admin_menu_icon'] instanceof \think\Paginator ) && $v1['admin_menu_icon']->isEmpty()))): ?><i class="fa <?php echo $v1['admin_menu_icon']; ?>"></i><?php endif; ?>
                                    <span><?php echo $v1['admin_menu_name']; ?></span>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    

                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-user"></i><span class="label label-primary">y</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-cog fa-fw"></i> 修改密码
                                            <span class="pull-right text-muted small">Set Pass</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-user fa-fw"></i> 退出登录
                                            <span class="pull-right text-muted small">Login Out</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe id="J_iframe" width="100%" height="100%" src="homepage.html?v=4.0" frameborder="0" data-id="homepage.html" seamless></iframe>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="/public/static/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/public/static/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/public/static/admin/js/plugins/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="/public/static/admin/js/hAdmin.js?v=4.1.0"></script>
    <script type="text/javascript" src="/public/static/admin/js/index.js"></script>

    <!-- 第三方插件 -->
    <script src="/public/static/admin/js/plugins/pace/pace.min.js"></script>

</body>

</html>
