<?php 
	//宽 高 字母 数字 字母数字混合 干扰线 干扰点 背景色字体颜色
	var_dump(verify());
	function verify($width = 100 , $height = 40 , $sun = 5 , $type = 1){//0-9 a-z
		//1准备画布
		$imgage = imagecreatetruecolor($width,$height);
		//2生成颜色
		
		//3需要什么样的字符
		$string = '';
		switch ($type) {
			case 1:
				$str = '0123456789';
				$string = substr(str_shuffle($str),0,5);
				break;
			case 2:
				$arr = range('a','z');
				shuffle($arr);
				$tmp = array_slice($arr,0,5);
				$string = join('',$tmp);
			case 3:
				//0-9 a-z A-Z
				$str = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
				$string = substr(str_shuffle($str),0,5);
				break;
		}
		//4开始写字
		//5干扰线(点)
		//6制定输出类型
		//7准备输出图片
		//8销毁
		echo $string;
	}

	function lightColor(){//浅色
		return imagecolorallocate($image,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));//0-255
	}

	function deepColor(){//深色
		return imagecolorallocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));//0-255
	}

 ?>