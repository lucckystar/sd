<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/web/yuewu/public_html/application/admin/view/file/videos_details.html";i:1545561382;}*/ ?>
<!doctype html>

<head>

   <!-- player skin -->
   <link rel="stylesheet" href="/public/static/flowplayer20160415/skin/functional.css">

   <!-- site specific styling -->
   <style>
   body { font: 12px "Myriad Pro", "Lucida Grande", sans-serif; text-align: center; padding-top: 5%; }
   .flowplayer { width: 80%; }
   </style>

   <!-- for video tag based installs flowplayer depends on jQuery 1.7.2+ -->
   <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>

   <!-- include flowplayer -->
   <script src="/public/static/flowplayer20160415/flowplayer.min.js"></script>

</head>

<body>

   <!-- the player -->
   <div class="flowplayer" data-swf="/public/static/flowplayer20160415/flowplayer.swf" data-ratio="0.4167">
      <video>
        
         <source type="video/mp4" src="/public/uploads/<?php echo $videos_find['file_content']; ?>">
      </video>
   </div>

</body>
