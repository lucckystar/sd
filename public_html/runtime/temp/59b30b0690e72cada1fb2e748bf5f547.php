<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/www/web/yuewu/public_html/application/admin/view/file/videos_list.html";i:1545563112;}*/ ?>
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
                        <h5>视频列表</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        <form action="<?php echo url('/'); ?>">
                            <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入视频名称" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary">搜索</button> </span>
                            </div>
                        </div>
                        </form>
                        <form action="">
                            <div class="col-sm-4 m-b-xs">
                                <div data-toggle="buttons" class="btn-group">
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option1" name="options">个人</label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option2" name="options">教师</label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option3" name="options">机构</label>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th width="70px"></th> -->
                                        <th width="170px">视频id</th>
                                        <th width="170px">所属地区</th>
                                        <th width="170px">舞蹈种类</th>
                                        <th width="170px">视频名称</th>
                                        <th width="200px">视频封面</th>
                                        <th width="170px">视频收藏量</th>
                                        <th width="170px">视频所属</th>
                                        <th width="170px">视频状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($file_select) || $file_select instanceof \think\Collection || $file_select instanceof \think\Paginator): $i = 0; $__LIST__ = $file_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td> -->
                                        <td><?php echo $vo['file_id']; ?></td>
                                        <td><?php echo $vo['district_name']; ?></td>
                                        <td><?php echo $vo['dance_type_name']; ?></td>
                                        <td><?php echo $vo['file_name']; ?></td>
                                        <td ><img width="175" height="120" alt="视频封面" src="/public/uploads/<?php echo $vo['file_cover']; ?>"/></td>
                                        <td><?php echo $vo['file_collection']; ?></td>
                                        <td>
                                        <?php if(strtoupper($vo['file_category']) == 1): ?>个人
                                        <?php elseif(strtoupper($vo['file_category']) == 2): ?>教师
                                        <?php else: ?>机构
                                        <?php endif; ?>
<!--                                         <?php echo $vo['file_category']; ?>
 -->                                        </td>

                                        <td>
                                        <?php if(strtoupper($vo['file_state']) == 1): ?>正常
                                        <?php else: ?>封停
                                        <?php endif; ?>
<!--                                         <?php echo $vo['file_state']; ?>
 -->                                        </td>
                                        <td>
                                        <a type="button" class="btn btn-outline btn-info" href="<?php echo url('File/videos_details',['file_id'=>$vo['file_id']]); ?>">详情</a>
                                        <!-- <a type="button" class="btn btn-outline btn-info" href="<?php echo url('Information/banner_edit_show',['file_id'=>$vo['file_id']]); ?>">编辑</a> -->
                                        <a type="button" class="btn btn-outline btn-danger" href="<?php echo url('File/banner_del',['file_id'=>$vo['file_id']]); ?>" onClick="return confirm('删除后将无法恢复,确定要删除   <<?php echo $vo['file_name']; ?>>   ?')">封停</a>
                                        </td>
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <a href="<?php echo url('Information/videos_add'); ?>" type="button" class="btn btn-outline btn-success">添加</a>
                        </div>
                        <div style="align-content: center;" class="btn-group">
                            <?php echo $file_select->render(); ?>
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
