<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/web/yuewu/public_html/application/admin/view/order/organization_order.html";i:1549894542;}*/ ?>
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
                            用户列表
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        <form action="<?php echo url('order/organization_order'); ?>">
                            <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" name="seek" placeholder="请输入用户姓名/手机号" value="<?php echo $seek; ?>" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button> </span>
                            </div>
                        </div>
                        </form>
                        <!-- <input type="hidden" name="file_category" value="1">
                        <input type="submit" id="option1"> -->
                        <!-- <form action="">
                            <div class="col-sm-4 m-b-xs">
                                <div data-toggle="buttons" class="btn-group">
                                    <label class="btn btn-sm btn-white">
                                        <a type="radio" id="option1" href="<?php echo url('file/file_list',['file_category'=>1]); ?>"></a>个人
                                    </label>
                                    <label class="btn btn-sm btn-white">
                                        <a type="radio" id="option2" name="options"></a>教师</label>
                                    <label class="btn btn-sm btn-white">
                                        <a type="radio" id="option3" name="options"></a>机构</label>
                                </div>
                            </div>
                        </form> -->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th width="70px"></th> -->
                                        <th width="130px">
                                        订单编号
                                        </th>
                                        <th width="130px">课程名称</th>
                                        <th width="130px">机构名称</th>
                                        <th width="130px">机构电话</th>
                                        <th width="130px">购买者姓名</th>
                                        <th width="130px">购买者手机</th>
                                        <th width="130px">订单总金额</th>
                                        <th width="130px">优惠金额</th>
                                        <th width="130px">订单实际金额</th>
                                        <th width="130px">订单状态</th>
                                        <th width="130px">
                                        下单时间
                                        </th>
                                        
                                        <!-- <th>操作</th> -->
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($organization_order_list) || $organization_order_list instanceof \think\Collection || $organization_order_list instanceof \think\Paginator): $i = 0; $__LIST__ = $organization_order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td> -->
                                        <td><?php echo $vo['order_number']; ?></td>
                                        <td><?php echo $vo['curriculum_name']; ?></td>
                                        <td><?php echo $vo['organization_name']; ?></td>
                                        <td><?php echo $vo['organization_service']; ?></td>
                                        <td><?php echo $vo['user_name']; ?></td>
                                        <td><?php echo $vo['user_phone']; ?></td>
                                        <td><?php echo $vo['order_amount']; ?></td>
                                        <td><?php echo $vo['order_discount']; ?></td>
                                        <td><?php echo $vo['order_paymoney']; ?></td>

                                        <td>
                                            <?php if($vo['order_status'] == 1): ?>待付款
                                            <?php elseif($vo['order_status'] == 2): ?>value2已付款
                                            <?php elseif($vo['order_status'] == 3): ?>关闭交易
                                            <?php else: ?>退单
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td><?php echo date("Y-m-d H:i:s",$vo['order_createtime']); ?></td>
                                        <!-- <td>
                                        <a type="button" class="btn btn-outline btn-info" href="<?php echo url('user/user_details',['user_id'=>$vo['user_id']]); ?>">详情</a>
                                        <a type="button" class="btn btn-outline btn-info" href="<?php echo url('user/user_edit_show',['user_id'=>$vo['user_id']]); ?>">编辑</a>
                                        <a type="button" class="btn btn-outline btn-danger" href="<?php echo url('user/file_',['user_id'=>$vo['user_id']]); ?>" onClick="return confirm('确定要封停   <<?php echo $vo['user_name']; ?>>   ?')">封停</a>
                                        </td> -->
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <!-- <a href="<?php echo url('Information/videos_add'); ?>" type="button" class="btn btn-outline btn-success">添加</a> -->
                        </div>
                        <div style="align-content: center;" class="btn-group">
                            <?php echo $organization_order_list->render(); ?>
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
