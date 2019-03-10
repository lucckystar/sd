<?php

namespace app\api\controller;



use think\Controller;

use think\Db;

use think\Session;

use think\File;

use think\Request;



class Common extends Controller{//上传控制器

    

    public function dance_type_select(){//舞蹈种类查询

        $dance_type = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();

        return returnJson(1,'成功',$dance_type);

    }

    public function find_organization_id(){//舞蹈种类查询
    	$user_token = input('user_token');
        $organization_id = find_organization_id($user_token);
        return returnJson(1,'成功',$organization_id);
    }



    public function fans(){//3.12.01会员中心-老师中心-我的粉丝(分页待验证)

    	$fans_data = input('post.');

    	// var_dump($fans_data);

    	if ($fans_data['type'] == 1) {//type为1是教师粉丝

	    	if (empty($fans_data['user_token'])) {

	            return returnJson(-1,'请登录...');//判断登录

	        }



	        if (!$user_find = Db::name('user')->where('user_token',$fans_data['user_token'])->field('user_id,user_name,user_sex

	            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {

	            return returnJson(-1,'请登录...');//用户查询

	        }



	        if ($user_find['user_false_delete'] == 2) {

	            return returnJson(0,'用户不存在...');//用户已被删除

	        }



	        if ($user_find['user_status'] == 2) {

	            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停

	        }

	        $teacher = user_teacher_find($user_find['user_id']);

	        if ($teacher == null) {

	        	return returnJson(0,'身份非法。。。');//用户账户封停

	        }

	            $limit = 10;

	            $number = ($fans_data['number']-1)*$limit;

	            $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();

	            $attention_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait,user_signature')->where('fid',$user_teacher_find['user_teacher_id'])->where('attention_identity',1)->limit($number,$limit)->select();//查询老师粉丝

	            return returnJson(1,'',$attention_select);//用户账户封停

    	}

    	if ($fans_data['type'] == 2) {//type2是机构粉丝

    		if (empty($fans_data['user_token'])) {

	            return returnJson(-1,'请登录...');//判断登录

	        }



	        if (!$user_find = Db::name('user')->where('user_token',$fans_data['user_token'])->field('user_id,user_name,user_sex

	            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {

	            return returnJson(-1,'请登录...');//用户查询

	        }



	        if ($user_find['user_false_delete'] == 2) {

	            return returnJson(0,'用户不存在...');//用户已被删除

	        }



	        if ($user_find['user_status'] == 2) {

	            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停

	        }



	        $user_organization = user_organization($user_find['user_id']);

	        if ($user_organization == null) {

	        	return returnJson(0,'身份非法。。。');//用户账户封停

	        }

	            $limit = 10;

	            $number = ($fans_data['number']-1)*$limit;

	            $organization_find = Db::name('organization')->where('user_id',$user_find['user_id'])->find();

	            $attention_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait,user_signature')->where('fid',$organization_find['organization_id'])->where('attention_identity',2)->limit($number,$limit)->select();//查询机构粉丝

	            return returnJson(1,'',$attention_select);//用户账户封停

    	}

	}



	public function curriculum_operation(){//管理课程上下架
		$curriculum_data = input('post.');
		if ($curriculum_data['identity_type'] == 1) {//教师课程
			$user = user($curriculum_data['user_token']);
			$user_teacher = user_teacher_find($user['user_id']);
			$teacher_curriculum = teacher_curriculum_find($user_teacher['user_teacher_id'],$curriculum_data['curriculum_id']);
			if ($teacher_curriculum !== null) {
				if ($curriculum_data['operation_type'] == 1) {//上架
					$curriculum_update = Db::name('curriculum')->where('curriculum_id',$teacher_curriculum['curriculum_id'])->update([
						'curriculum_state'=>1,
					]);
					if ($curriculum_update == 1) {
						return returnJson(1,'上架成功');//用户账户封停
					}else{
						return returnJson(0,'上架失败,服务器正忙。。。');//用户账户封停
					}
				}
				if ($curriculum_data['operation_type'] == 2) {//下架
					$curriculum_update = Db::name('curriculum')->where('curriculum_id',$teacher_curriculum['curriculum_id'])->update([
						'curriculum_state'=>3,
					]);
					if ($curriculum_update == 1) {
						return returnJson(1,'下架成功');//用户账户封停
					}else{
						return returnJson(0,'下架失败,服务器正忙。。。');//用户账户封停
					}
				}
			}else{
				return returnJson(0,'服务器正忙。。。');//用户账户封停
			}
		}

		if ($curriculum_data['identity_type'] == 2) {//机构课程
			$user = user($curriculum_data['user_token']);
			$organization = organization_curriculum_find($user['user_id']);
			$organization_curriculum = organization_curriculum($organization_curriculum['organization_id'],$curriculum_data['curriculum_id']);
			if ($organization_curriculum !== null) {
				if ($curriculum_data['operation_type'] == 1) {//上架
					$curriculum_update = Db::name('curriculum')->where('curriculum_id',$organization_curriculum['curriculum_id'])->update([
						'curriculum_state'=>1,
					]);
					if ($curriculum_update == 1) {
						return returnJson(1,'上架成功');//用户账户封停
					}else{
						return returnJson(0,'上架失败,服务器正忙。。。');//用户账户封停
					}
				}
				if ($curriculum_data['operation_type'] == 2) {//下架
					$curriculum_update = Db::name('curriculum')->where('curriculum_id',$organization_curriculum['curriculum_id'])->update([
						'curriculum_state'=>3,
					]);
					if ($curriculum_update == 1) {
						return returnJson(1,'下架成功');//用户账户封停
					}else{
						return returnJson(0,'下架失败,服务器正忙。。。');//用户账户封停
					}
				}
			}else{
				return returnJson(0,'服务器正忙。。。');//用户账户封停
			}
		}
	}

}

