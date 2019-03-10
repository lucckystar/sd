<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"/www/web/yuewu/public_html/application/area/view/index/index.html";i:1549948845;}*/ ?>
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

    <title>乐舞区域管理</title>

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
                                        <strong class="font-bold">乐舞区域管理</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">乐舞</div>
                    </li>
<!--                     <li>
                        <a href="#">
                            <span class="nav-label">平台信息管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Information/banner_list'); ?>">轮播图管理</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Information/publicity_list'); ?>">入驻平台宣传图管理</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Information/dance_type_list'); ?>">舞种管理</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Information/terrace_data_find'); ?>">平台资料管理</a>
                            </li>
                        </ul>
                    </li> -->
<!--                     <li>
                        <a href="#">
                            <span class="nav-label">地区管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Area/area_list'); ?>">地区列表</a>
                            </li>
                        </ul>
                    </li> -->
<!--                     <li>
                        <a href="#">
                            <span class="nav-label">优惠管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Area/area_list'); ?>">优惠券列表</a>
                            </li>
                        </ul>
                    </li> -->
                    
<!--                     <li>
                        <a href="#">
                            <span class="nav-label">文件管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('File/file_list',['file_type'=>1]); ?>">视频列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('File/file_list',['file_type'=>2]); ?>">音乐列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('File/file_list',['file_type'=>3]); ?>">图片列表</a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="#">
                            <span class="nav-label">机构管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Organization/organization_list'); ?>">机构列表</a>
                            </li>
                            

                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-label">教师管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Teacher/user_teacher_list'); ?>">教师列表</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="#">
                            <span class="nav-label">用户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('User/user_list'); ?>">用户列表</a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="#">
                            <span class="nav-label">课程管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Curriculum/organization_curriculum_list'); ?>">机构课程列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Curriculum/organization_closure_curriculum_list'); ?>">机构课程封停列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Curriculum/teacher_curriculum_list'); ?>">教师课程列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Curriculum/teacher_closure_curriculum_list'); ?>">教师课程封停列表</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-label">审核管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Organization/organization_check_list'); ?>">机构审核</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Teacher/teacher_check_list'); ?>">教师审核</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-label">举报管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('File/file_report'); ?>">被举报文件列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('File/file_closure_list'); ?>">被封停文件列表</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-label">明细管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Organization/organization_check_list'); ?>">机构明细记录</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Organization/organization_check_list'); ?>">教师明细记录</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo url('Organization/organization_check_list'); ?>">用户明细记录</a>
                            </li>
                        </ul>
                    </li>
<!--                     <li>
                        <a href="#">
                            <span class="nav-label">统计管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo url('File/file_report'); ?>">统计列表</a>
                            </li>
                        </ul>
                    </li> -->
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