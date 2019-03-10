var dazhu = {};
//验证输入框
dazhu.verify = function(th){
    if (!th.is(':visible')) {
        return true;
    }
    if (th.hasClass('verify')) {
        if (th.val()=='' || th.val()==null || th.val()==undefined) {
            th.addClass('error');
            th.nextAll('.help-block').text(th.attr('errMsg')?th.attr('errMsg'):'请输入内容');
            return false;
        }else{
            th.removeClass('error');
            th.nextAll('.help-block').text('');
        }
    }
    if (th.val()!='' && th.val()!=null && th.val()!=undefined) {
        var matarr = new Array();
        matarr[0]= new Array('phoneNumber',/^(0|86|17951)?((1[3|4|5|7|8][0-9]{1})+\d{8})$/,'请输入正确手机号'); //手机正则
        matarr[1]= new Array('telNumber',/^1\d{10}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,9}(-\d{1,8})?$/,'请输入正确手机号或座机号');   //手机座机正则
        matarr[2]= new Array('passWord',/^(\w){6,20}$/,'请输入6-20个字母、数字、下划线');
        matarr[3]= new Array('userName',/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/,'请输入5-20个以字母开头、可带数字、“_”、“.”的内容');
        matarr[4]= new Array('timeYmd',/^(\d{4})-(0\d{1}|1[0-2])-(0\d{1}|[12]\d{1}|3[01])$/,'请输入（如：1970-01-01）格式的内容');
        matarr[5]= new Array('timeHis',/^(0\d{1}|1\d{1}|2[0-3]):[0-5]\d{1}:([0-5]\d{1})$/,'请输入（如：00:00:00）格式的内容');
        for (var i=0; i<matarr.length; i++) {
            if (th.hasClass(matarr[i][0])) {
                if (!th.val().match(matarr[i][1])) {
                    th.addClass('error');
                    th.nextAll('.help-block').text(th.attr('errMsg')?th.attr('errMsg'):matarr[i][2]);
                    return false;
                }else{
                    th.removeClass('error');
                    th.nextAll('.help-block').text('');
                }
            }
        }
    }
    return true;
}
//弹出警告框
dazhu.msg_alert = function (msg,type){
    msg = msg?msg:'';
    type = type?type:'success';
    $('#mgs-alert').remove();
    $('body').append('<div class="alert alert-'+type+' alert-dismissible" role="alert" id="mgs-alert" style="display:none;width:100%;position:fixed;left:0;top:0;z-index:9999;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+msg+'</div>');
    $('#mgs-alert').slideDown(500);
}
//ajax访问请求
dazhu.ajax_frame = function (url,method,data,success_callback){
    method = method?method:'get';
    data = data?data:'';
    if (!success_callback) {
        success_callback = function(data){
          data.msg=(data.msg?('<b>'+data.msg+'</b>'):'');
          if (data.url){ 
            data.msg = data.msg+'<span style="float:right;">页面将在<b msg-alert="time">'+data.wait+'</b>秒钟后跳转~~~&nbsp;&nbsp;<a href="'+data.url+'">立即跳转</a></span>';
            var IntervalId = setInterval(function(){data.wait--;$('b[msg-alert="time"]').text(data.wait);if(data.wait<=0){clearInterval(IntervalId);}},1000);
            setTimeout(function(){location.href=data.url;},data.wait*1000);}
          if (data.msg) {if(data.code == 1){ dazhu.msg_alert(data.msg,'success');}else{ dazhu.msg_alert(data.msg,'danger');}}
        }
    }
    $.ajax({
        url:url,
        type:method,
        data:data,
        processData: false,  // 告诉jQuery不要去处理发送的数据
        contentType: false,  // 告诉jQuery不要去设置Content-Type请求头
        success:function(data){
            success_callback(data);
        },
        error:function(){alert('失败.请检查网络.若网络正常请联系管理员.');},
        complete:function(){},
    });
}


//图片截取上传方法
$(document).on('change','.cropper-file,.cropper-fileone',function(){
  if ($(this).next('.cropper').length <= 0) {
    $(this).after('<div class="cropper"><div class="cropper-choose"><img src=""></div><div class="cropper-preview img-thumbnail"></div><div class="cropper-operation">\n<button type="button" class="btn btn-primary cropper-search-minus"><span class="fa fa-search-minus"></span></button>\n<button type="button" class="btn btn-primary cropper-search-plus"><span class="fa fa-search-plus"></span></button>\n<button type="button" class="btn btn-primary cropper-arrow-left"><span class="fa fa-arrow-left"></span></button>\n<button type="button" class="btn btn-primary cropper-arrow-right"><span class="fa fa-arrow-right"></span></button>\n<button type="button" class="btn btn-primary cropper-arrow-up"><span class="fa fa-arrow-up"></span></button>\n<button type="button" class="btn btn-primary cropper-arrow-down"><span class="fa fa-arrow-down"></span></button>\n<button type="button" class="btn btn-primary cropper-arrows-h"><span class="fa fa-arrows-h"></span></button>\n<button type="button" class="btn btn-primary cropper-arrows-v"><span class="fa fa-arrows-v"></span></button>\n<button type="button" class="btn btn-primary cropper-refresh">重置</button>\n<button type="button" class="btn btn-primary cropper-upload">上传</button></div></div>');      
  }
  $(this).next('.cropper').find('.cropper-choose>img').cropper({
      'aspectRatio': 3/2,
      'preview': '.cropper-preview',
      'autoCropArea' : 1,
      'Number' : 1,
  });
  let files = $(this);
  let fileObj = files[0];
  let windowURL = window.URL || window.webkitURL;
  if (!fileObj || !fileObj.files || !fileObj.files[0]) {
    return false;
  }
  let dataURL = windowURL.createObjectURL(fileObj.files[0]);
  $(this).next('.cropper').find('.cropper-choose>img').cropper('replace',dataURL);
  $(this).next('.cropper').show();
});
$(document).on('click','.cropper-search-minus',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('zoom',-0.1);
});
$(document).on('click','.cropper-search-plus',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('zoom',0.1);
});
$(document).on('click','.cropper-arrow-left',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('move',-10,0);
});
$(document).on('click','.cropper-arrow-right',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('move',10,0);
});
$(document).on('click','.cropper-arrow-up',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('move',0,-10);
});
$(document).on('click','.cropper-arrow-down',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('move',0,10);
});
$(document).on('click','.cropper-arrows-h',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('scaleX',-1);
});
$(document).on('click','.cropper-arrows-v',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('scaleY',-1);
});
$(document).on('click','.cropper-refresh',function(){
  $(this).parents('.cropper').find('.cropper-choose>img').cropper('reset');
});
$(document).on('click','.cropper-upload',function(){
  var th = $(this);
  var cropperObj = th.parents('.cropper');
  cropperObj.find('.cropper-choose>img').cropper('getCroppedCanvas').toBlob(function(Blob){
    th.text('上传中...');
    var formData = new FormData();
    formData.append('Filedata',Blob,'cropper.png');
    $.ajax({
        type: 'POST',
        url: cropperObj.prev('.cropper-file,.cropper-fileone').attr('upload'),
        data: formData,
        contentType: false, //必须
        processData: false, //必须
        cache:false,
        success: function(data){
            if (data.status != 1) {
              alert(data.msg);
              return false;
            }
            var add_html = '<div><img class="img-thumbnail" src="/public/uploads/'+data.list.path+'"/><input type="hidden" name="'+cropperObj.prev('.cropper-file,.cropper-fileone').attr('field')+'" value="'+data.list.id+'"/><button class="btn btn-danger" type="button">&times;</button></div>';
            if (cropperObj.prev('.cropper-file,.cropper-fileone').hasClass('cropper-fileone')) {
                cropperObj.nextAll('.imglist').html(add_html);
            }else{
                cropperObj.nextAll('.imglist').append(add_html);
            }
            cropperObj.remove();
        },
        error : function() {
            alert('请联系管理员');
        }
    });
  });
});

$(document).ready(function(){
    //初始化
    $(document).on('input propertychange change blur','input,select,button,textarea',function(){dazhu.verify($(this))});
    //图片删除
    $(document).on('click','.imglist button',function(){
        if (!confirm('是否删除该图片？删除图片后系统还保留图片信息，请前往资源管理删除。')) {
            return false;
        }
        $(this).parent('div').remove();
    });
    //ajax表单提交
    $(document).on('submit','form.ajax-commit',function(){
      event.preventDefault();
      var ys = $(this);
      ys.find('input,select,button,textarea').each(function(){
        dazhu.verify($(this));
      })
      ys.find('.passWord').each(function(){
        var passWord = ys.find('.passWord:first').val();
        if ($(this).val() !== passWord) {
            ys.find('.passWord').addClass('error');
            ys.find('.passWord').nextAll('.help-block').text('密码输入不一致');
        }
      });
      if (ys.find('.error').length>0) {
          return false;
      }
      var fd = new FormData(ys[0]);
      dazhu.ajax_frame(ys.attr('action'),ys.attr('method'),fd);
    });
    //a标签ajax请求
    $(document).on('submit','a.ajax-commit',function(){
      event.preventDefault();
      event.stopPropagation();
      dazhu.ajax_frame($(this).attr('href'));
    });
});