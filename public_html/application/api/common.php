<?php

use think\Model;
use think\Db;

function user_brief($user_token){//user信息
	$user_brief = Db::name('user')->where('user_token',$user_token)->where('user_false_delete',1)->where('user_status',1)->field('user_name,user_sex,user_signature')->find();
	return $user_brief;
}

function user($user_token){//user信息
	$user = Db::name('user')->where('user_token',$user_token)->where('user_false_delete',1)->where('user_status',1)->find();
	return $user;
}
function user_id($user_id){//user信息
	$user = Db::name('user')->where('user_id',$user_id)->where('user_false_delete',1)->where('user_status',1)->find();
	return $user;
}
function user_teacher($user_teacher_id){//user信息
	$user_teacher = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->where('teacher_false_delete',1)->where('teacher_state',1)->find();
	return $user_teacher;
}

function user_teacher_find($user_id){//user信息
	$user_teacher = Db::name('user_teacher')->where('user_id',$user_id)->where('teacher_false_delete',1)->where('teacher_state',1)->find();
	return $user_teacher;
}

function user_organization($user_id){//user信息
	$user_organization = Db::name('organization')->where('user_id',$user_id)->where('organization_false_delete',1)->where('organization_state',1)->find();
	return $user_organization;
}

function teacher_curriculum_find($teacher_id,$curriculum_id){//查询课程的拥有者id
	$teacher_curriculum_find = Db::name('curriculum')->alias('a')->join('user_teacher c','a.id = c.user_teacher_id','left')->where('teacher_state',1)->where('teacher_false_delete',1)->where('curriculum_identity_type',1)->where('a.id',$teacher_id)->where('a.curriculum_id',$curriculum_id)->find();
	return $teacher_curriculum_find;
}
function organization_curriculum_find($user_id){//查询课程的拥有者id
	$organization_curriculum_find = Db::name('curriculum')->alias('a')->join('organization c','a.id = c.organization_id','left')->where('c.user_id',$user_id)->where('c.organization_state',1)->where('organization_false_delete',1)->find();
	return $organization_curriculum_find;
}

function organization_curriculum($organization_id,$curriculum_id){//查询课程的拥有者id
	$organization_curriculum_find = Db::name('curriculum')->alias('a')->join('organization c','a.id = c.organization_id','left')->where('a.id',$organization_id)->where('a.curriculum_id',$curriculum_id)->where('c.organization_state',1)->where('organization_false_delete',1)->where('curriculum_identity_type',1)->find();
	return $organization_curriculum_find;
}

function file_find($file_id){//查询文件的信息以及拥有者
	$file_find = Db::name('file')->where('file_id',$file_id)->find();
	if ($file_find['file_category'] == 1) {
		$file = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('a.file_id',$file_find['file_id'])->find();
		return $file;
	}
	if ($file_find['file_category'] == 2) {
		$file = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('a.file_id',$file_find['file_id'])->find();
		return $file;
	}
	if ($file_find['file_category'] == 3) {
		$file = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('a.file_id',$file_find['file_id'])->find();
		return $file;
	}
}
function organization_work_find($user_token,$file_id){//机构文件查询(用于机构删除文件的验证)
	$user = user($user_token);
	$user_organization = user_organization($user['user_id']);
	$organization_file = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('c.organization_id',$user_organization['organization_id'])->where('a.file_id',$file_id)->where('a.file_state',1)->where('a.file_false_delete',1)->find();
	if ($organization_file == null) {
		$work_verify = 2;
		return $work_verify;
	}elseif ($organization_file == 1) {
		$work_verify = 1;
		return $work_verify;
	}
}


function file_play_verify_own($user_token,$file_id){//视频播放接口3-1文件播放，检测是否为自己的视频
	$user = user($user_token);
	$user_file = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user['user_id'])->where('a.file_id',$file_id)->find();
	if ($user_file == null) {
		$file_verify = 2;
		return $file_verify;
	}else{
		$file_verify = 1;
		return $file_verify;
	}
}

function teacher_verify_own($user_token,$teacher_id){//查询是否关注教师
	$user = user($user_token);
	$teacher_attention = Db::name('attention')->where('uid',$user['user_id'])->where('fid',$teacher_id)->where('attention_identity',1)->find();
	if ($teacher_attention == null) {
		$teacher_verify = 2;
		return $teacher_verify;
	}else{
		$teacher_attention = 1;
		return $teacher_verify;
	}
}

function find_organization_id($user_token){//10-1令牌查询机构id
	// $user_token = input('user_token');
	$user = user($user_token);
	$organization = user_organization($user['user_id']);
	$organization_id = $organization['organization_id'];
	return $organization_id;
}
