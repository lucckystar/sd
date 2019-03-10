<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"D:\wamp\www\shop/application/admin\view\account\login.html";i:1534476407;}*/ ?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>后台管理系统</title>
  <script src="/public/static/common/jquery/jquery-2.0.0.min.js"></script>
  <link rel="stylesheet" href="/public/static/common/font-awesome/css/font-awesome.min.css">

  <!-- <link rel="stylesheet" href="/public/static/admin/css/login.css"> -->
</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="/public/static/img/logo-invoice.png" />
            </div>
        </div>
         <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">  
                <div class="panel-body">
                    <form role="form">
                        <hr />
                        <h5>Enter Details to Login</h5>
                           <br />
                         <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Username | 用户名" name='username'/>
                         </div>
                         <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password | 密码" />
                         </div>
                         <div class="form-group input-group checkbox">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                                <input class="form-control"  placeholder="验证码" name="verify" type="text" />
                         </div>
                         <div class="form-group input-group checkbox">                                           
                         		<a href="javascript:;" class="js_verify" title="看不清？换一张！" >
                   		 			<img src="<?php echo captcha_src(); ?>" class="verify" />
                   		 		</a>
                         </div>
                       
                         <button type="button" class="btn btn-primary submit">
							<span class="in" style="display: none"><i class="icon-loading"></i>登 录 中 ...</span>
                        	<span class="on">登 录 </span>
						</button>
                    </form>
                </div>
            </div>  
        </div>
    </div>

</body>
</html>
<script type="text/javascript">
var change_verify = function(){$('.verify').prop('src','<?php echo captcha_src(); ?>');};
$('.js_verify').bind('click',function(){
	change_verify();
}).trigger('click');
$(".submit").on("click",function(){    	
    var username = $("input[name=username]").val();
    var pwd = $("input[name=password]").val();
    var verify = $("input[name=verify]").val();
    var errMsg;
    if (!username) {
        errMsg='用户名';
    }
    if (!pwd) {
        errMsg='密码';
    }
    if (!verify) {
        errMsg='验证码';
    }
    if (errMsg) {
        alert('请输入'+errMsg);
        return false;
    }
    $(this).find('.in').show();
    $(this).find('.on').hide();
    $.ajax({
        url:"<?php echo url('Account/loginupdate'); ?>",
        type:"post",
        data:{'username':username, 'pwd':pwd, 'verify':verify},
        dataType:"json",
        success:function(data){
         	if(data.status==0){    
         		alert(data.info);
                change_verify();
         		$(".submit").find('.in').hide();
                $(".submit").find('.on').show();
         	}else{ 
         		location.href = data.url;
         	}
        }
    });
}); 
</script>

