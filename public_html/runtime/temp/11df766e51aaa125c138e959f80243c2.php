<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/web/yuewu/public_html/application/admin/view/discounts/discounts_list.html";i:1549694964;}*/ ?>
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
            <!-- <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>年龄</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>张三</td>
                                    <td>男</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>李四</td>
                                    <td>男</td>
                                    <td>27</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>王麻子</td>
                                    <td>男</td>
                                    <td>65</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> -->
            <!-- <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>斑马纹效果</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>数据</th>
                                    <th>用户</th>
                                    <th>值</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="line">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    </td>
                                    <td>张三</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 40%</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                    </td>
                                    <td>李四</td>
                                    <td class="text-warning"> <i class="fa fa-level-down"></i> -20%</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="line">1,6,3,9,5,9,5,3,9,6,4</span>
                                    </td>
                                    <td>王麻子</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 26%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>边框</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>年龄</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>张三</td>
                                    <td>男</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>李四</td>
                                    <td>男</td>
                                    <td>27</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>王麻子</td>
                                    <td>男</td>
                                    <td>65</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>鼠标经过</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>数据</th>
                                    <th>用户</th>
                                    <th>值</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="line">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    </td>
                                    <td>张三</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 40%</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                    </td>
                                    <td>李四</td>
                                    <td class="text-warning"> <i class="fa fa-level-down"></i> -20%</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="line">1,6,3,9,5,9,5,3,9,6,4</span>
                                    </td>
                                    <td>王麻子</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 26%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>优惠券列表</h5>
                        <!-- <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div> -->
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <!-- <div class="col-sm-5 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline">
                                    <option value="0">请选择</option>
                                    <option value="1">选项1</option>
                                    <option value="2">选项2</option>
                                    <option value="3">选项3</option>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div data-toggle="buttons" class="btn-group">
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option1" name="options">天</label>
                                    <label class="btn btn-sm btn-white active">
                                        <input type="radio" id="option2" name="options">周</label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option3" name="options">月</label>
                                </div>
                            </div> -->
                            <div class="row">
                                <form action="<?php echo url('Discounts/discounts_list'); ?>">
                                <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="seek" placeholder="请输入优惠券名称" value="<?php echo $seek; ?>" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary">搜索</button> </span>
                                </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th width="70px"></th> -->
                                        <th width="100px">优惠券id</th>
                                        <th width="150px">优惠券名称</th>
                                        <th width="150px">优惠条件金额</th>
                                        <th width="150px">优惠价格</th>
                                        
                                        <th width="150px">优惠券数量</th>
                                        <th width="150px">开始时间</th>
                                        <th width="150px">结束时间</th>
                                        <th width="150px">添加时间</th>
                                        <th width="150px">优惠券启用状态</th>
<!--                                         <th>日期</th>
 -->                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($discounts) || $discounts instanceof \think\Collection || $discounts instanceof \think\Paginator): $i = 0; $__LIST__ = $discounts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td> -->
                                        <td><?php echo $vo['discounts_id']; ?></td>
                                        <td><?php echo $vo['discounts_name']; ?>
                                        </td>
                                        <td><?php echo $vo['discounts_full_money']; ?></td>
                                        <td><?php echo $vo['discounts_price']; ?></td>
                                        
                                        <td><?php echo $vo['discounts_number']; ?></td>
                                        <td><?php echo date("Y-m-d",$vo['discounts_starttime']); ?></td>
                                        <td><?php echo date("Y-m-d",$vo['discounts_overtime']); ?></td>
                                        <td><?php echo date("Y-m-d",$vo['discounts_creattime']); ?></td>
                                        <td>
                                        <?php if(strtoupper($vo['discounts_status']) == 1): ?>正常
                                        <?php else: ?>停止
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                        <a type="button" class="btn btn-outline btn-success" href="<?php echo url('Area/area_recover',['discounts_id'=>$vo['discounts_id']]); ?>">恢复</a>
                                        <a type="button" class="btn btn-outline btn-danger" href="<?php echo url('Area/area_forbid',['discounts_id'=>$vo['discounts_id']]); ?>">封停</a>
                                        </td>
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <a href="<?php echo url('Information/videos_add'); ?>" type="button" class="btn btn-outline btn-success">添加</a>

                        </div>

                    </div>
                </div>
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
