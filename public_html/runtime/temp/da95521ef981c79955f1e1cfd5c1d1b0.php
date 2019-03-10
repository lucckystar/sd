<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"/www/web/yuewu/public_html/application/admin/view/information/publicity_list.html";i:1545450975;}*/ ?>
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
                        <h5>入驻宣传图</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="370px">宣传图id</th>
                                        <th width="370px">宣传图名称</th>
                                        <th width="370px">宣传图内容</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($publicity_pic) || $publicity_pic instanceof \think\Collection || $publicity_pic instanceof \think\Paginator): $i = 0; $__LIST__ = $publicity_pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td> -->
                                        <td><?php echo $vo['information_id']; ?></td>
                                        <td><?php echo $vo['information_name']; ?>
                                        </td>
                                        <td><img width="120px" height="225px" class="img-thumbnail" src="/public/uploads/<?php echo $vo['information_content']; ?>"/></td>
                                        <td>
                                        <a type="button" class="btn btn-outline btn-info" href="<?php echo url('Information/publicity_edit_show',['information_id'=>$vo['information_id']]); ?>">编辑</a>
<!--                                         <a type="button" class="btn btn-outline btn-danger" href="<?php echo url('Information/banner_del',['information_id'=>$vo['information_id']]); ?>" onClick="return confirm('删除后将无法恢复,确定要删除   <<?php echo $vo['information_name']; ?>>   ?')">删除</a> -->
                                        </td>
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
<!--                             <a href="<?php echo url('Information/banner_add_show'); ?>" type="button" class="btn btn-outline btn-success">添加</a>
 -->                        </div>
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
<!--     <script src="/public/static/admin/js/plugins/iCheck/icheck.min.js"></script>
 -->
    <!-- Peity -->
<!--     <script src="/public/static/admin/js/demo/peity-demo.js"></script> -->
<!-- 
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script> -->
</body>

</html>
