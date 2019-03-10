<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:101:"/www/web/yuewu/public_html/application/area/view/curriculum/organization_closure_curriculum_list.html";i:1548948394;}*/ ?>
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
                            被封停机构课程列表
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        <form action="<?php echo url('Curriculum/organization_curriculum_list'); ?>">
                            <div class="col-sm-3">
                            <div class="input-group">
                                <input type="hidden" value="" name="">
                                <input type="text" name="seek" placeholder="请输入课程名称" value="<?php echo $seek; ?>" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button> </span>
                            </div>
                        </div>
                        </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="150px">
                                            课程id
                                        </th>
                                        <th width="150px">
                                            课程名称
                                        </th>
                                        <th width="150px">
                                            课程负责人
                                        </th>
                                        <th width="150px">
                                            收藏数
                                        </th>
                                        <th width="150px">
                                            有效时间
                                        </th>
                                        <th width="150px">
                                            最大人数
                                        </th>
                                        <th width="150px">
                                            课程状态
                                        </th>
                                        <th width="150px">
                                            舞蹈种类
                                        </th>
                                        <th width="150px">
                                            课程价格
                                        </th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($organization_closure_curriculum_list) || $organization_closure_curriculum_list instanceof \think\Collection || $organization_closure_curriculum_list instanceof \think\Paginator): $i = 0; $__LIST__ = $organization_closure_curriculum_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td><?php echo $vo['curriculum_id']; ?></td>
                                        <td><?php echo $vo['curriculum_name']; ?></td>
                                        <td><?php echo $vo['organization_name']; ?></td>
                                        <td><?php echo $vo['curriculum_collect']; ?></td>
                                        <td>
                                        <?php if(strtoupper($vo['curriculum_effective']) == 1): ?>长期有效
                                        <?php else: ?><?php echo date("Y-m-d H:m:s",$vo['curriculum_start_time']); ?>至<?php echo date("Y-m-d H:m:s",$vo['curriculum_over_time']); endif; ?>
                                        </td>
                                        <td><?php echo $vo['now_people_number']; ?></td>
                                        <td>
                                        <?php if(strtoupper($vo['curriculum_state']) == 1): ?>正常
                                        <?php else: ?>停止
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo $vo['dance_type_name']; ?></td>
                                        <td><?php echo $vo['curriculum_actual_price']; ?></td>
                                        <td>
                                        <a type="button" class="btn btn-outline btn-info" href="<?php echo url('Curriculum/organization_curriculum_details',['curriculum_id'=>$vo['curriculum_id']]); ?>">详情</a>
                                        <!-- <a type="button" class="btn btn-outline btn-info" href="<?php echo url('Curriculum/',['curriculum_id'=>$vo['curriculum_id']]); ?>">修改</a> -->
                                        <a type="button" class="btn btn-outline btn-success" href="<?php echo url('Curriculum/curriculum_recover',['curriculum_id'=>$vo['curriculum_id']]); ?>" onClick="return confirm('确定要封停   <<?php echo $vo['curriculum_name']; ?>>   ?')">恢复</a>
                                        </td>
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
<!--                             <a href="<?php echo url('Information/videos_add'); ?>" type="button" class="btn btn-outline btn-success">添加</a>
 -->                        </div>
                        <div style="align-content: center;" class="btn-group">
                            <?php echo $organization_closure_curriculum_list->render(); ?>
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
