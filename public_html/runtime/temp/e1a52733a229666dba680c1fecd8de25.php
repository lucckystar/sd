<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/web/yuewu/public_html/application/area/view/teacher/teacher_check_list.html";i:1548948401;}*/ ?>
 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基础表格</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/public/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>
                            教师申请列表
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        <form action="<?php echo url('Teacher/teacher_check_list'); ?>">
                            <div class="col-sm-3">
                            <div class="input-group">
                                <input type="hidden" value="" name="">
                                <input type="text" name="seek" placeholder="请输入教师名称" value="<?php echo $seek; ?>" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button> </span>
                            </div>
                        </div>
                        </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th width="70px"></th> -->
                                        <th width="170px">
                                            申请教师id
                                        </th>
                                        <th width="170px">
                                            教师头像
                                        </th>
                                        <th width="170px">
                                            教师名称
                                        </th>
                                        <th width="170px">申请用户</th>
                                        <th width="186px">
                                            申请账号
                                        </th>
                                        <th width="150px">
                                            所属地区
                                        </th>
                                        <th width="170px">
                                            教师状态
                                        </th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($teacher_check_list) || $teacher_check_list instanceof \think\Collection || $teacher_check_list instanceof \think\Paginator): $i = 0; $__LIST__ = $teacher_check_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td> -->
                                        <td><?php echo $vo['user_teacher_id']; ?></td>
                                        <td ><img width="55" height="55" alt="头像" src="/public/uploads/<?php echo $vo['teacher_portrait']; ?>"/></td>
                                        <!-- <td><?php echo $vo['teacher_attention']; ?></td> -->
                                        <td><?php echo $vo['teacher_name']; ?></td>
                                        <td><?php echo $vo['user_name']; ?></td>
                                        <td><?php echo $vo['user_phone']; ?></td>
                                        <td><?php echo $vo['district_name']; ?></td>
                                        <td>
                                        <?php if(strtoupper($vo['teacher_state']) == 1): ?>正常
                                        <?php elseif(strtoupper($vo['teacher_state']) == 2): ?>封停
                                        <?php elseif(strtoupper($vo['teacher_state']) == 3): ?>待审核
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                        <a type="button" class="btn btn-outline btn-info" href="<?php echo url('Teacher/teacher_apply_details',['user_teacher_id'=>$vo['user_teacher_id']]); ?>">详情</a>
                                        <a type="button" class="btn btn-outline btn-success" href="<?php echo url('Teacher/teacher_pass',['user_teacher_id'=>$vo['user_teacher_id']]); ?>">通过</a>
                                        <a type="button" class="btn btn-outline btn-danger" href="<?php echo url('Teacher/teacher_reject',['user_teacher_id'=>$vo['user_teacher_id']]); ?>" onClick="return confirm('确定要封停   <<?php echo $vo['teacher_name']; ?>>   ?')">驳回</a>
                                        </td>
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
<!--                             <a href="<?php echo url('Information/videos_add'); ?>" type="button" class="btn btn-outline btn-success">添加</a>
 -->                        </div>
                        <div style="align-content: center;" class="btn-group">
                            <?php echo $teacher_check_list->render(); ?>
                        </div>
                    </div>
                </div>
                
                
                <!-- <div class="btn-group">
                    <button type="button" class="btn btn-white"><i class="fa fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-white">1</button>
                    <button class="btn btn-white">2</button>
                    <button class="btn btn-white">3</button>
                    <button class="btn btn-white">4</button>
                    <button type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i>
                    </button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/public/static/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/public/static/admin/js/bootstrap.min.js?v=3.3.6"></script>



    <!-- Peity -->
    <script src="/public/static/admin/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- 自定义js -->
    <script src="/public/static/admin/js/content.js?v=1.0.0"></script>


    <!-- iCheck -->
    <script src="/public/static/admin/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Peity -->
    <script src="/public/static/admin/js/demo/peity-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    
    

</body>

</html>
