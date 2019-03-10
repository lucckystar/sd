<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"/www/web/yuewu/public_html/application/api/view/user/k.html";i:1544497025;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HTMLjson</title>
</head>
<body>
<form action="<?php echo url('user/c'); ?>" method="post.">
  <p><input type="checkbox" name="vehicle" value="Bike" /> I have a bike</p>
  <p><input type="checkbox" name="vehicle" value="Car" checked="checked" /> I have a car</p>
  <input type="submit" value="Submit" />
</form>
</body>
</html>