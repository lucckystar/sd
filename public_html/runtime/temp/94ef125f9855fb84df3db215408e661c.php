<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/www/web/yuewu/public_html/application/admin/view/file/file_closure_list.html";i:1547376487;}*/ ?>
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
                            被举报文件列表
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        <form action="<?php echo url('file/file_closure_list'); ?>">
                            <div class="col-sm-3">
                            <div class="input-group">
                                <input type="hidden" value="" name="file_type">
                                <input type="text" name="seek" placeholder="请输入文件名称" value="<?php echo $seek; ?>" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button> </span>
                            </div>
                        </div>
                        </form>
                        <!-- <input type="hidden" name="file_category" value="1">
                        <input type="submit" id="option1"> -->
<!--                         <form action="">
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
                                        <th width="170px">
                                        文件id
                                        </th>
                                        <th width="170px">文件名称</th>
                                        
                                        <th width="170px">文件地区</th>
                                        <th width="170px">文件种类</th>
                                            <!-- <th width="170px">文件封面</th> -->
                                        <th width="200px">文件所属</th>
                                        <th width="200px">举报数</th>
                                        <th width="200px">文件状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if(is_array($file_closure_list) || $file_closure_list instanceof \think\Collection || $file_closure_list instanceof \think\Paginator): $i = 0; $__LIST__ = $file_closure_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" class="i-checks" name="input[]">
                                        </td> -->
                                        <td><?php echo $vo['file_id']; ?></td>
                                        <td><?php echo $vo['file_name']; ?></td>
                                        <td><?php echo $vo['district_name']; ?></td>
                                        <td>
                                            <?php if(strtoupper($vo['file_type']) == 1): ?>视频
                                            <?php elseif(strtoupper($vo['file_type']) == 2): ?>音乐
                                            <?php else: ?>图片
                                            <?php endif; ?>
                                        </td>
                                        <!-- <td ><img width="175" height="120" alt="视频封面" src="/public/uploads/<?php echo $vo['file_cover']; ?>"/></td> -->
                                        <td>
                                        <?php if(strtoupper($vo['file_category']) == 1): ?>个人
                                        <?php elseif(strtoupper($vo['file_category']) == 2): ?>教师
                                        <?php else: ?>机构
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo $vo['report_number']; ?></td>
                                        <td>
                                            <?php if(strtoupper($vo['file_state']) == 1): ?>正常
                                            <?php elseif(strtoupper($vo['file_state']) == 2): ?>封停
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        <a type="button" class="btn btn-outline btn-success" href="<?php echo url('/',['file_id'=>$vo['file_id']]); ?>">恢复</a>
                                        </td>
                                    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
<!--                             <a href="<?php echo url('Information/videos_add'); ?>" type="button" class="btn btn-outline btn-success">添加</a>
 -->                        </div>
                        <div style="align-content: center;" class="btn-group">
                            <?php echo $file_closure_list->render(); ?>
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
