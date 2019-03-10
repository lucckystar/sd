<?php

use think\Model;

use think\Db;



function file_closure($file_id){//user信息

	$file_closure = Db::name('file')->where('file_id',$file_id)->update([

		'file_state'=>2,

	]);

	return $file_closure;

}

function user($user_id){//user信息

	$user = Db::name('user')->where('user_id',$user_id)->find();

	return $user;

}



function organization($organization_id){//user信息

	$organization = Db::name('organization')->where('organization_id',$organization_id)->find();

	return $organization;

}

function user_brief($user_token){//user信息

	$user_brief = Db::name('user')->where('user_token',$user_token)->where('user_false_delete',1)->where('user_status',1)->field('user_name,user_sex,user_signature')->find();

	return $user_brief;

}



// function user($user_token){//user信息

// 	$user = Db::name('user')->where('user_token',$user_token)->where('user_false_delete',1)->where('user_status',1)->find();

// 	return $user;

// }



function user_teacher($user_id){//user信息

	$user_teacher = Db::name('user_teacher')->where('user_id',$user_id)->where('teacher_false_delete',1)->where('teacher_state',1)->find();

	return $user_teacher;

}
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


function user_teacher_file_details($file_id,$user_teacher_id,$file_type){
        $file = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('a.file_id',$file_id)->where('c.user_teacher_id',$user_teacher_id)->find();
        return $file;
    }
function user_file_details($file_id,$user_id,$file_type){
        $file = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('a.file_id',$file_id)->find();
        // var_dump($file);
        return $file;
    }
function organization_file_details($file_id,$organization_id,$file_type){
        $file = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('a.file_id',$file_id)->where('c.organization_id',$organization_id)->find();
        return $file;
    }