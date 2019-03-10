<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"/www/web/yuewu/public_html/application/admin/view/file/user_file_judge_video.html";i:1551350491;}*/ ?>
<!-- 

<!DOCTYPE>

<html>

    <head>
<meta charset="utf-8">
  <title>Video.js 7.4.1</title>
  <link href="/public/static/admin/video/css/video-js.min.css" rel="stylesheet">
  <style>
body {
  background-color: #191919
}
.m {
  width: 960px;
  height: 400px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 100px;
}
</style>
 
<script src="/public/static/admin/video/video.js" type="text/javascript"></script>
<title>hivideo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/static/admin/video/assets/hivideo.css" />
    <script type="text/javascript" src="/public/static/admin/video/hivideo.js"></script>
    <style type="text/css">
        .main-wrap{
            margin: 0 auto;
            min-width: 320px;
            max-width: 640px;
        }

        .main-wrap video{
            width: 100%;
        }
    </style>




    </head>

<body>

  <div class="m">
      <video id="my-video" class="video-js" controls preload="auto" width="960" height="400"
      poster="m.jpg" data-setup="{}">
        <source src="/public/uploads/<?php echo $videos_find['file_content']; ?>" type="video/mp4">
       <source src="http://vjs.zencdn.net/v/oceans.webm" type="video/webm">
      <source src="http://vjs.zencdn.net/v/oceans.ogv" type="video/ogg">
        <p class="vjs-no-js"> To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a> </p>
      </video>
      <br>
      <a href="<?php echo url('file/file_list',['file_type'=>1]); ?>" type="button">返回</a>
      <script src="/public/static/admin/video/js/video.min.js"></script> 
      <script type="text/javascript">
      //设置中文
      videojs.addLanguage('zh-CN', {
        "Play": "播放",
        "Pause": "暂停",
        "Current Time": "当前时间",
        "Duration": "时长",
        "Remaining Time": "剩余时间",
        "Stream Type": "媒体流类型",
        "LIVE": "直播",
        "Loaded": "加载完毕",
        "Progress": "进度",
        "Fullscreen": "全屏",
        "Non-Fullscreen": "退出全屏",
        "Mute": "静音",
        "Unmute": "取消静音",
        "Playback Rate": "播放速度",
        "Subtitles": "字幕",
        "subtitles off": "关闭字幕",
        "Captions": "内嵌字幕",
        "captions off": "关闭内嵌字幕",
        "Chapters": "节目段落",
        "Close Modal Dialog": "关闭弹窗",
        "Descriptions": "描述",
        "descriptions off": "关闭描述",
        "Audio Track": "音轨",
        "You aborted the media playback": "视频播放被终止",
        "A network error caused the media download to fail part-way.": "网络错误导致视频下载中途失败。",
        "The media could not be loaded, either because the server or network failed or because the format is not supported.": "视频因格式不支持或者服务器或网络的问题无法加载。",
        "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.": "由于视频文件损坏或是该视频使用了你的浏览器不支持的功能，播放终止。",
        "No compatible source was found for this media.": "无法找到此视频兼容的源。",
        "The media is encrypted and we do not have the keys to decrypt it.": "视频已加密，无法解密。",
        "Play Video": "播放视频",
        "Close": "关闭",
        "Modal Window": "弹窗",
        "This is a modal window": "这是一个弹窗",
        "This modal can be closed by pressing the Escape key or activating the close button.": "可以按ESC按键或启用关闭按钮来关闭此弹窗。",
        ", opens captions settings dialog": ", 开启标题设置弹窗",
        ", opens subtitles settings dialog": ", 开启字幕设置弹窗",
        ", opens descriptions settings dialog": ", 开启描述设置弹窗",
        ", selected": ", 选择",
        "captions settings": "字幕设定",
        "Audio Player": "音频播放器",
        "Video Player": "视频播放器",
        "Replay": "重播",
        "Progress Bar": "进度小节",
        "Volume Level": "音量",
        "subtitles settings": "字幕设定",
        "descriptions settings": "描述设定",
        "Text": "文字",
        "White": "白",
        "Black": "黑",
        "Red": "红",
        "Green": "绿",
        "Blue": "蓝",
        "Yellow": "黄",
        "Magenta": "紫红",
        "Cyan": "青",
        "Background": "背景",
        "Window": "视窗",
        "Transparent": "透明",
        "Semi-Transparent": "半透明",
        "Opaque": "不透明",
        "Font Size": "字体尺寸",
        "Text Edge Style": "字体边缘样式",
        "None": "无",
        "Raised": "浮雕",
        "Depressed": "压低",
        "Uniform": "均匀",
        "Dropshadow": "下阴影",
        "Font Family": "字体库",
        "Proportional Sans-Serif": "比例无细体",
        "Monospace Sans-Serif": "单间隔无细体",
        "Proportional Serif": "比例细体",
        "Monospace Serif": "单间隔细体",
        "Casual": "舒适",
        "Script": "手写体",
        "Small Caps": "小型大写字体",
        "Reset": "重启",
        "restore all settings to the default values": "恢复全部设定至预设值",
        "Done": "完成",
        "Caption Settings Dialog": "字幕设定视窗",
        "Beginning of dialog window. Escape will cancel and close the window.": "开始对话视窗。离开会取消及关闭视窗",
        "End of dialog window.": "结束对话视窗"
      });
      
      
      
      
      
      
      var myPlayer = videojs('my-video');
      videojs("my-video").ready(function(){
        var myPlayer = this;
        myPlayer.play();
      });
        
    </script> 
    </div>
  <div class="main-wrap">
        <video ishivideo="true" autoplay="true" isrotate="false" autoHide="true">
            <source src="/public/uploads/<?php echo $videos_find['file_content']; ?>" type="video/mp4">
        </video>
    </div>
<script type="text/javascript">
player('/public/uploads/<?php echo $videos_find['file_content']; ?>',1000,1000,0,'../../../public/static/admin/video/start.jpg');
</script> 

<video width="320" height="240" controls="controls" autoplay="autoplay">
  <object data="/public/uploads/<?php echo $videos_find['file_content']; ?>" width="320" height="240">
    <embed width="320" height="240" src="/public/uploads/<?php echo $videos_find['file_content']; ?>" />
  </object>
</video>

<video width="320" height="240" controls="controls" autoplay="autoplay">
  <source src="/i/movie.ogg" type="video/ogg" />
  <source src="/public/uploads/<?php echo $videos_find['file_content']; ?>" type="video/mp4" />
  <source src="/i/movie.webm" type="video/webm" />
</video>

</body>

</html> -->









<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Violate Responsive Admin Template">
        <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

        <title>Super Admin Responsive Template</title>
            
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/form.css" rel="stylesheet">
        <link href="css/calendar.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/icons.css" rel="stylesheet">
        <link href="css/lightbox.css" rel="stylesheet">
        <link href="css/media-player.css" rel="stylesheet">
        <link href="css/generics.css" rel="stylesheet"> 

        <link rel="shortcut icon" href="favicon.ico"> <link href="/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/public/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    </head>
    <body id="skin-blur-violate">
        
        
        <div class="clearfix"></div>
        
        
            <!-- Content -->
            <section id="content" class="container">
            
                <!-- Messages Drawer -->
                <!-- <hr class="whiter"> -->
                    <div style="padding-left: 0px;margin-left: 370px;"></div>
                <!-- Media Player -->
                <div class="block-area">
                    
                    
                    <!-- Video -->
                    <div class="row" style="margin-top: 100px;">
                            <h3 class="block-title"><?php echo $videos_find['file_name']; ?></h3>                        
                        <div class="col-md-6 m-b-20" style="padding-left: 0px;margin-left: 0px;width: 1000px;object-fit: fill;">
                            <!-- <p>Multi-Codec with no JavaScript fallback player - Cross Browser</p> -->
                            <video style="width: 1000px;  object-fit: fill" width="100%" height="100%" id="multiCodec" poster="/public/uploads/" controls="controls" preload="none" > <!-- id could be any according to you -->
                                <!-- MP4 source must come first for iOS -->
                                <source type="video/mp4" src="/public/uploads/<?php echo $videos_find['file_content']; ?>" />
                                <!-- WebM for Firefox 4 and Opera -->
                                <source type="video/webm" src="media/echohereweare.webm" />
                                <!-- OGG for Firefox 3 -->
                                <source type="video/ogg" src="media/echohereweare.ogv" />
                                <!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
                                <object width="100%" height="100%" type="application/x-shockwave-flash" data="media/flashmediaelement.swf">     
                                        <param name="movie" value="media/flashmediaelement.swf" /> 
                                        <param name="flashvars" value="controls=true&amp;poster=img/media-player/media-player-poster.jpg&amp;file=media/echohereweare.mp4" />     
                                        <!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed -->
                                        <img src="img/media-player/media-player-poster.jpg" width="100%" height="100%" alt="Media" title="No video playback capabilities" />
                                </object>   
                            </video>
                            <a class="btn btn-outline btn-info" href="<?php echo url('user/user_file_select',['user_id'=>$videos_find['user_id']]); ?>">返回</a>
                        </div>
                        
                        
                        <!-- <div class="col-md-6 m-b-20">
                            <p>Youtube Video (Preview in server NOT local)</p>
                            <video id="youtube1" width="100%" height="100%">
                                <source src="http://www.youtube.com/watch?v=2CvtOUqd84o" type="video/youtube" >
                            </video>
                        </div> -->
                    </div>
                        
                    <!-- <p>Audio Player</p> -->
                    <!-- Audio -->
                    <!-- <div class="row m-b-20">
                        <div class="col-md-7">
                            <audio id="audioPlayer" src="media/audio.mp3"></audio>
                        </div>
                    </div> -->
                </div>
                    
                <!-- <hr class="whiter" /> -->
                
                <!-- Carousel -->
                
            </section>
        </section>
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
        <script src="js/jquery-ui.min.js"></script> <!-- jQuery UI -->
        <script src="js/jquery.easing.1.3.js"></script> <!-- jQuery Easing - Requirred for Lightbox -->
        
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        
        <!-- Media -->
        <script src="js/media-player.min.js"></script> <!-- Video Player -->
        <script src="js/pirobox.min.js"></script> <!-- Lightbox -->
        
        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->
        
        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->
        
        
        <!-- All JS functions -->
        <script src="js/functions.js"></script>
        
    </body>
</html>

