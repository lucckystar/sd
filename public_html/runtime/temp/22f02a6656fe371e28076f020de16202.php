<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/www/web/yuewu/public_html/application/admin/view/organization/organization_details.html";i:1551340208;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 个人资料</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body>
    <div>
        <div>
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>机构信息</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right" style="margin-left: 150px;">
                            <img alt="image" class="img-responsive" src="/public/uploads/<?php echo $organization_find['organization_portrait']; ?>" style="height: 250px;border-radius:50%;">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>机构名称</strong></h4>
                            <p><?php echo $organization_find['organization_name']; ?></p>
                            <!-- <h4><strong>用户年龄</strong></h4>
                            <p><?php echo $organization_find['organization_name']; ?></p> -->
                            <!-- <h4><strong>机构头像</strong></h4>
                            <p>
                                <img src="/public/uploads/<?php echo $organization_find['organization_portrait']; ?>" alt="">
                            </p> -->
                            <!-- <h4><strong>机构封面</strong></h4>
                            <p><img src="/public/uploads/<?php echo $organization_find['organization_cover']; ?>" alt=""></p> -->
                            <h4><strong>机构地址</strong></h4>
                            <p><?php echo $organization_find['organization_site']; ?></p>
                            <h4><strong>机构介绍</strong></h4>
                            <p><?php echo $organization_find['organization_synopsis']; ?></p>
                            <h4><strong>机构营业时间</strong></h4>
                            <p><?php echo $organization_find['organization_business_hours']; ?></p>
                            <h4><strong>机构余额</strong></h4>
                            <p><?php echo $organization_find['organization_money']; ?></p>
                            <!-- <h5>
                                    关于我
                                </h5>
                            <p>
                                会点前端技术，div+css啊，jQuery之类的，不是很精；热爱生活，热爱互联网，热爱新技术；有一个小的团队，在不断的寻求新的突破。
                            </p> -->
                            <div class="row m-t-lg">
                                <div class="col-sm-4">
<!--                                     <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
 -->                                    <h3><strong>拥有<?php echo $file_count; ?></strong>文件</h3>
                                </div>
                                <!-- <div class="col-sm-4">
                                    <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                    <h3><strong>关注</strong>用户</h3>
                                </div> -->
                                <div class="col-sm-4">
<!--                                     <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
 -->                                    <h3><strong>粉丝数<?php echo $attention_count; ?></strong></h3>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="<?php echo url('organization/organization_update_show',['organization_id'=>$organization_id]); ?>" type="button" class="btn btn-primary btn-sm btn-block">修改信息</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo url('organization/organization_list'); ?>" type="button" class="btn btn-default btn-sm btn-block">返回</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>发布的视频</h5>
                        <a href="<?php echo url('organization/organization_file_select',['organization_id'=>$organization_id]); ?>"><small class="pull-right text-navy">查看更多</small></a>
                        <div class="ibox-tools" style="width: 740px">
                            <!-- <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="profile.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="profile.html#">选项1</a>
                                </li>
                                <li><a href="profile.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> -->
                        </div>
                    </div>
                    <div class="ibox-content">
                        <!-- <div>
                            <div class="feed-activity-list">
                                <div class="feed-element">
                                    <a href="profile.html#" class="pull-left">
                                        <img alt="image" class="img-circle" src="/public/uploads/">
                                    </a>
                                    <div class="media-body">
                                        
                                        <br>
                                        <img alt="image" class="img-circle"  src="/public/uploads/">
                                        <strong>于发布了</strong>
                                        <br>
                                        <br>
                                        <img alt="image"  src="/public/uploads/" style="width: 125px;">
                                        <br>
                                        <small class="text-muted"></small>
                                        <div class="actions">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> 赞 </a>
                                            <a class="btn btn-xs btn-danger"><i class="fa fa-heart"></i> 收藏</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> 显示更多</button>
                        </div> -->
                        <div class="feed-element">
                        <?php if(is_array($organization_file) || $organization_file instanceof \think\Collection || $organization_file instanceof \think\Paginator): $i = 0; $__LIST__ = $organization_file;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <!-- <a href="profile.html#" class="pull-left"> -->
                                        <!-- <img alt="image" class="img-circle" src="/public/uploads/<?php echo $vo['organization_portrait']; ?>"> -->
                                    <!-- </a> -->
                                    <div class="media-body">
                                        <small class="pull-right"><?php echo date('Y-m-d H:i:s',$vo['file_creattime']); ?></small>
                                        <strong><?php echo $vo['organization_name']; ?></strong>
                                        <br>
                                        <!-- <small class="text-muted">今天 09:27 来自 Koryolink iPhone</small> -->
                                        <div class="well">
                                            <?php echo $vo['organization_name']; ?>于<?php echo date('Y-m-d H:i:s',$vo['file_creattime']); ?>发布了<!-- <a href="<?php echo url('/',['organization_id'=>$vo['organization_id']]); ?>"> --><?php echo $vo['file_name']; ?><!-- </a> -->
                                        </div>
                                        <!-- <div class="pull-right">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> 赞 </a>
                                            <a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> 收藏</a>
                                            <a class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> 评论</a>
                                        </div> -->
                                    </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <!-- <script src="js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>
 -->


    <!-- 自定义js -->
<!--     <script src="js/content.js?v=1.0.0"></script>
 -->

    <!-- Peity -->
<!--     <script src="js/plugins/peity/jquery.peity.min.js"></script>
 -->
    <!-- Peity -->
<!--     <script src="js/demo/peity-demo.js"></script>
 -->
    
    

</body>

</html>
