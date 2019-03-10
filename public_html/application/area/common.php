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