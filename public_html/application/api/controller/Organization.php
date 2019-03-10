<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class Organization extends Controller {//机构控制器

	// public function organization_list(){//1.03.01舞蹈机构(未添加下拉分页)

 //        $district_data = input('post.');//接受区域id

 //        if (empty($district_data['district_id'])) {
 //            return returnJson(0,'机构标识为空...');//机构id
 //        }
 //        if (empty($attention_teacher['paging'])) {
 //            $attention_teacher['paging'] = 1;
 //        }
 //        $limit = 10;
 //        $paging = ($attention_teacher['paging']-1)*$limit;

 //        $organization_list['organization'] = Db::name('organization')->where('organization_state',1)->where('organization_false_delete',1)->where('organization_district_id',$district_data['district_id'])->where('organization_type','like','%'.$district_data['dance_type_id'].'%')->where('organization_name','like','%'.$district_data['organization_name'].'%')->field('organization_id,organization_name,organization_cover,organization_site,organization_facility,organization_business_hours,organization_level,organization_district_id,organization_type')->limit($paging,$limit)->order('organization_level desc')->select();
 //        if (!empty($district_data['user_token'])) {
 //            $user_id = Db::name('user')->where('user_token',$district_data['user_token'])->field('user_id')->find();
 //            $organization_list['unread'] = Db::name('chat')->where('chat_fid',$user_id['user_id'])->where('chat_state',2)->count();
 //            return returnJson(1,'',$organization_list);//正常,'',机构列表
 //        }
        
 //        return returnJson(1,'',$organization_list);//正常,'',机构列表
 //    }

    public function organization_list(){//1.03.01舞蹈机构(未添加下拉分页)

        $district_data = input('post.');//接受区域id

        if (empty($district_data['district_id'])) {
            return returnJson(0,'地区表示为空...');//机构id
        }
        if (empty($district_data['paging'])) {
            $district_data['paging'] = 1;
        }
        $limit = 10;
        $paging = ($district_data['paging']-1)*$limit;
        $organization_list['seek'] = $district_data['seek'];
        $organization_list['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();
        $organization_list['organization'] = Db::name('organization')->where('organization_state',1)->where('organization_false_delete',1)->where('organization_name','like','%'.$district_data['seek'].'%')->where('organization_type','like','%'.$district_data['dance_type_name'].'%')->field('organization_id,organization_name,organization_cover,organization_site,organization_level,organization_type')->where('organization_district_id',$district_data['district_id'])->limit($paging,$limit)->order('organization_level desc')->select();

        // if (!empty($district_data['user_token'])) {
            // $user_id = Db::name('user')->where('user_token',$district_data['user_token'])->field('user_id')->find();
/*            $organization_list['unread'] = Db::name('chat')->where('chat_fid',$user_id['user_id'])->where('chat_state',2)->count();
*/            return returnJson(1,'',$organization_list);//正常,'',机构列表
        // }
        
        return returnJson(1,'',$organization_list);//正常,'',机构列表
    }

	public function organization_find(){//1.03.02机构详情

		$organization_id = input('organization_id');//接受机构id
        $user_token = input('user_token');
		if (empty($organization_id)) {
			return returnJson(0,'机构标识为空...');//机构id
		}

        $user = Db::name('user')->where('user_token',$user_token)->find();

		$organization_find = Db::name('attention')->where('uid',$user['user_id'])->where('fid',$organization_id)->where('attention_identity',2)->find();
        if ($organization_find) {
            $organization_find['attention_state'] = 1;
        }else{
            $organization_find['attention_state'] = 2;
        }
		if (!$organization_find['basic'] = Db::name('organization')->where('organization_state',1)->where('organization_false_delete',1)->field('organization_id,organization_name,organization_portrait,organization_site,organization_facility,organization_business_hours,organization_level,organization_district_id,organization_synopsis,organization_service,organization_facility,organization_type')->where('organization_id',$organization_id)->find()) {
			return returnJson(0,'机构详情服务器正忙...');//机构详情服务器查询
		}

		$organization_find['video'] = Db::name('organization')->alias('a')->join('file_organization b','a.organization_id = b.organization_id','left')->join('file c','b.file_id = c.file_id','left')->where('c.file_state',1)->where('c.file_false_delete',1)->where('a.organization_id',$organization_find['basic']['organization_id'])->field('c.file_content,a.promotional_cover')->find();


		$organization_find['invitation'] = Db::name('invitation')->where('invitation_organization_id',$organization_find['basic']['organization_id'])->field('invitation_id,invitation_dance_type')->find();
        $organization_find['invitation']['invitation_title'] = $organization_find['basic']['organization_name'].'聘请函';

		$organization_find['curriculum'] = Db::name('organization')->alias('a')->join('organization_curriculum b','a.organization_id = b.organization_id','left')->join('curriculum c','b.curriculum_id = c.curriculum_id','left')->where('c.id',$organization_find['basic']['organization_id'])->where('c.curriculum_show',1)->field('c.curriculum_id,c.curriculum_admin,c.curriculum_difficulty,c.curriculum_actual_price,c.curriculum_start_time,c.curriculum_over_time,c.curriculum_name')->select();//查询curriculum表curriculum_show字段
			// return returnJson(0,'机构课程服务器正忙...');
		
		
        $organization_find['organization_teacher'] = Db::name('organization_teacher')->where('organization_id',$organization_find['basic']['organization_id'])->where('teacher_show',1)->field('organization_teacher_id,teacher_name,teacher_master,teacher_intro')->select();
        // if (!$organization_find['videos'] = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id')->join('organization c','b.organization_id = c.organization_id')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->field('a.file_id,a.file_cover,c.organization_portrait,c.organization_name,a.file_collection,dance_type_name,file_name')->order('file_collection desc')->limit('0,2')->select()) {
        //     return returnJson(0,'机构视频服务器正忙...');//机构教师服务器查询
        // }
        
        if (!$organization_find['videos'] = Db::name('organization')->alias('a')->join('yw_file_organization b','a.organization_id = b.organization_id','left')->join('file c','b.file_id = c.file_id','left')->join('dance_type d','c.dance_type_id = d.dance_type_id','left')->field('c.file_id,c.file_cover,a.organization_portrait,c.file_collection,dance_type_name,file_name')->order('file_collection desc')->limit('0,2')->select()) {
            return returnJson(0,'机构视频服务器正忙...');//机构教师服务器查询
        }

		// if (!empty($district_data['user_token'])) {
		// 	$user_id = Db::name('user')->where('user_token',$district_data['user_token'])->field('user_id')->find();
		// 	$organization_find['unread'] = Db::name('chat')->where('chat_fid',$user_id['user_id'])->where('chat_state',2)->count();
		// 	return returnJson(1,'',$organization_find);//正常,'',机构列表
		// }
        // $organization_find['attention'] = Db::name('attention')->where('uid',$user['user_id'])->where('fid',$organization_id)->where('attention_identity',2)->find();
        // if ($organization_find['attention'] == null) {
        //     $organization_find['attention'] = 2;
        // }else{
        //     $organization_find['attention'] = 1;
        // }
		return returnJson(1,'',$organization_find);//正常,'',机构列表
	}

	public function organization_invitation(){//1.05.03机构详情-聘请函查看
		$invitation_id = input('invitation_id');
        $organization_id = input('organization_id');
        $organization_name = Db::name('organization')->where('organization_id',$organization_id)->field('organization_name')->find();
		$invitation_find['invitation'] = Db::name('invitation')->where('invitation_id',$invitation_id)->where('invitation_organization_id',$organization_id)->order('invitation_creattime desc')->field('invitation_id,invitation_title,invitation_contact,invitation_phone,invitation_interview_site,invitation_interview_time,invitation_dance_type,invitation_age_demand,invitation_explain,invitation_organization_picture,invitation_organization_picture2')->find();
        $invitation_find['invitation']['invitation_title'] = $organization_name['organization_name'].'聘请函';
		return returnJson(1,'',$invitation_find);//正常,'',机构邀请函结果集
	}

	public function organization_teacher(){//1.05.05机构详情-舞蹈教师更多
		$organization_id = input('organization_id');
		$teacher_select = Db::name('organization_teacher')->where('organization_id',$organization_id)->field('organization_teacher_id,teacher_name,teacher_master,teacher_intro')->where('teacher_false_delete',1)->select();
		return returnJson(1,'',$teacher_select);//正常,'',机构教师结果集
	}

	public function organization_videos(){//1.05.06机构详情-机构视频更多
		$organization_id = input('organization_id');
        $paging = input('paging');
        $limit = 10;
        $paging = ($paging-1)*$limit;
		$videos_select = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('b.organization_id',$organization_id)->field('a.file_id,d.dance_type_name,a.file_cover,a.file_name,a.file_type,a.file_creattime,a.file_collection,organization_portrait,organization_name')->where('a.file_state',1)->where('a.file_false_delete',1)->where('a.file_category',3)->order('a.file_collection desc')->limit($paging,$limit)->select();
		return returnJson(1,'',$videos_select);//正常,'',机构视频结果集
	}

    public function organization_curriculum(){//1.05.07机构详情-精品课程更多
        $organization_id = input('organization_id');

        // $organization_curriculum['curriculum'] = Db::name('organization')->alias('a')->join('organization_curriculum b','a.organization_id = b.organization_id','left')->join('curriculum c','b.curriculum_id = c.curriculum_id','left')->join('dance_type d','c.dance_type_id = d.dance_type_id','left')->where('a.organization_id',$organization_id)->field('c.curriculum_id,curriculum_admin,curriculum_name,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time')->select();//未变动课程表表结构前的写法

        $organization_curriculum['curriculum'] = Db::name('curriculum')->where('curriculum_identity_type',2)->where('id',$organization_id)->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time')->select();
        foreach ($organization_curriculum['curriculum'] as $k => $v) {
            $organization_curriculum['curriculum'][$k]['organization_id'] = $organization_id;
        }
        // $organization_curriculum['curriculum']['organization_id'] = $organization_id;


        return returnJson(1,'',$organization_curriculum);//正常,'',机构课程结果集
    }

    public function organization_teacher_details(){
        $organization_data = input('post.');
        $organization_teacher_details = Db::name('organization')->alias('a')->join('organization_teacher b','a.organization_id = b.organization_id','left')->where('a.organization_id',$organization_data['organization_id'])->where('organization_teacher_id',$organization_data['organization_teacher_id'])->field('b.organization_teacher_id,teacher_phone,teacher_name,teacher_master,teacher_intro,teacher_office_time')->order('teacher_creattime desc')->find();
        return returnJson(1,'',$organization_teacher_details);//正常,'',机构课程结果集
    }

    public function organization_curriculum_select(){//1.05.08机构详情-精品课程搜索栏查询
        $data = input('post.');
        $organization_curriculum['organization'] = Db::name('organization')->where('organization_id',$data['organization_id'])->field('organization_id,organization_name,organization_portrait,organization_site,organization_service,organization_level')->find();
        $organization_curriculum['curriculum'] = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.organization_id = c.organization_id','left')->order('curriculum_creattime desc')->where('a.curriculum_false_delete',1)->where('a.curriculum_state',1)->where('c.organization_id',$data['organization_id'])->where('a.dance_type_id',$data['dance_type_id'])->where('curriculum_name','like','%'.$data['seek'].'%')->field('a.curriculum_id,a.curriculum_admin,a.curriculum_name,a.curriculum_actual_price,a.curriculum_difficulty,a.curriculum_collect,a.curriculum_effective,a.curriculum_start_time,a.curriculum_over_time')->select();
        return returnJson(1,'',$organization_curriculum);//正常,'',机构课程结果集
    }

	public function organization_invitation_find(){//3.14.01会员中心-机构中心-我要招聘
		$user_token = input('post.');
		if (empty($user_token['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$user_token['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $organization_invitation = Db::name('invitation')->alias('a')->join('organization b','a.invitation_organization_id = b.organization_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user_find['user_id'])->field('invitation_id,invitation_contact,invitation_phone,invitation_interview_site,invitation_interview_time,invitation_dance_type,invitation_age_demand,invitation_explain,invitation_organization_picture,invitation_age_demand,invitation_organization_picture2')->find();
        if (empty($organization_invitation)) {
            $organization_invitation = new \stdClass;
            $organization_invitation =  (object)[];
        	return returnJson(2,'没有邀请函。。。',$organization_invitation);
        }
		return returnJson(1,'',$organization_invitation);
	}

	public function organization_invitation_edit(){//3.14.01会员中心-机构中心-我要招聘
		$invitation_data_edit = input('post.');
		if (empty($invitation_data_edit['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$invitation_data_edit['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $invitation_verify = Db::name('invitation')->where('invitation_id',$invitation_data_edit['invitation_id'])->find();
        $organization = Db::name('organization')->where('user_id',$user_find['user_id'])->find();
        if ($invitation_verify['invitation_organization_id'] !== $organization['user_id']) {
            return returnJson(0,'非法操作!');//用户账户封停
        }
        $organization_invitation_edit = Db::name('invitation')->update([
        	'invitation_id'=>$invitation_data_edit['invitation_id'],
        	'invitation_contact'=>$invitation_data_edit['invitation_contact'],
        	'invitation_phone'=>$invitation_data_edit['invitation_phone'],
        	'invitation_interview_site'=>$invitation_data_edit['invitation_interview_site'],
        	'invitation_interview_time'=>$invitation_data_edit['invitation_interview_time'],
        	'invitation_dance_type'=>$invitation_data_edit['invitation_dance_type'],
        	'invitation_age_demand'=>$invitation_data_edit['invitation_age_demand'],
        	'invitation_explain'=>$invitation_data_edit['invitation_explain'],
        	'invitation_organization_picture'=>$invitation_data_edit['invitation_organization_picture'],
        	'invitation_organization_picture2'=>$invitation_data_edit['invitation_organization_picture2'],
        ]);
        $new = Db::name('invitation')->where('invitation_id',$invitation_data_edit['invitation_id'])->find();
        if ($organization_invitation_edit == 1) {
            return returnJson(1,'修改成功！',$new);
        }
        if ($organization_invitation_edit == 0) {
            return returnJson(1,'未修改');
        }
	}

	public function organization_invitation_add(){//3.14.01会员中心-机构中心-我要招聘-添加招聘
		$invitation_data_edit = input('post.');
		// $invitation_organization_picture = request()->file('invitation_organization_picture');
  //       $invitation_organization_picture2 = request()->file('invitation_organization_picture2');
		if (empty($invitation_data_edit['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$invitation_data_edit['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        if ($user_find['user_role'] !== 3) {
            return returnJson(0,'非法操作!');
        }
        $organization_find = Db::name('organization')->where('user_id',$user_find['user_id'])->field('organization_id')->find();
        $invitation_verify = Db::name('invitation')->where('invitation_organization_id',$organization_find['organization_id'])->find();
        if ($invitation_verify !== null) {
            return returnJson(0,'非法操作!');
        }

        // $invitation_organization_picture = $invitation_organization_picture->move(ROOT_PATH . 'public' . DS . 'uploads');
        // $invitation_organization_picture = $invitation_organization_picture->getSaveName();
        // $invitation_organization_picture2 = $invitation_organization_picture2->move(ROOT_PATH . 'public' . DS . 'uploads');
        // $invitation_organization_picture2 = $invitation_organization_picture2->getSaveName();
        // $organization_find = Db::name('organization')->where('user_id',$user_find['user_id'])->field('organization_id')->find();
        $organization_invitation_add = Db::name('invitation')->insert([
        	'invitation_organization_id'=>$organization_find['organization_id'],
        	'invitation_contact'=>$invitation_data_edit['invitation_contact'],
        	'invitation_phone'=>$invitation_data_edit['invitation_phone'],
        	'invitation_interview_site'=>$invitation_data_edit['invitation_interview_site'],
        	'invitation_interview_time'=>$invitation_data_edit['invitation_interview_time'],
        	'invitation_dance_type'=>$invitation_data_edit['invitation_dance_type'],
        	'invitation_age_demand'=>$invitation_data_edit['invitation_age_demand'],
        	'invitation_explain'=>$invitation_data_edit['invitation_explain'],
        	'invitation_organization_picture'=>$invitation_data_edit['invitation_organization_picture'],
        	'invitation_organization_picture2'=>$invitation_data_edit['invitation_organization_picture2'],
        	'invitation_creattime'=>time(),
        ]);
        $new_invitation = Db::name('invitation')->where('invitation_organization_id',$organization_find['organization_id'])->find();
        if ($organization_invitation_add == 1) {
        	return returnJson(2,'添加成功！',$new_invitation);
        }
	}

	public function organization_teacher_manage(){//3.15.01会员中心-机构中心-老师管理
        $invitation_data_edit = input('post.');
        if (empty($invitation_data_edit['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$invitation_data_edit['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $organization_find = Db::name('organization')->where('user_id',$user_find['user_id'])->field('organization_id')->find();

        $organization_teacher['organization_recommend_teacher'] = Db::name('organization_teacher')->where('organization_id',$organization_find['organization_id'])->where('teacher_show',1)->count();

        $organization_teacher['teacher'] = Db::name('organization_teacher')->where('organization_id',$organization_find['organization_id'])->field('organization_teacher_id,teacher_name,teacher_master,teacher_intro,teacher_show')->where('teacher_false_delete',1)->select();
        return returnJson(1,'',$organization_teacher);
    }

    public function organization_teacher_find(){//3.15.01会员中心-机构中心-老师管理
        $organization_teacher_find = input('post.');
        if (empty($organization_teacher_find['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_teacher_find['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系客服...');//用户账户封停
        }
        $organization_find = Db::name('organization')->where('user_id',$user_find['user_id'])->field('organization_id')->find();
        // $organization_teacher['organization_recommend_teacher'] = Db::name('organization_teacher')->where('organization_id',$organization_find['organization_id'])->where('teacher_show',1)->count();

        // $organization_teacher['teacher'] = Db::name('organization_teacher')->where('organization_teacher_id',$organization_teacher_find['organization_teacher_id'])->field('organization_teacher_id,teacher_phone,teacher_name,teacher_master,teacher_intro,teacher_office_time,teacher_office_time,teacher_show')->where('teacher_false_delete',1)->find();
        // 
        $organization_teacher['teacher'] = Db::name('organization_teacher')->where('organization_teacher_id',$organization_teacher_find['organization_teacher_id'])->where('organization_id',$organization_find['organization_id'])->where('organization_teacher_id',$organization_teacher_find['organization_teacher_id'])->field('organization_teacher_id,teacher_phone,teacher_name,teacher_master,teacher_intro,teacher_office_time,teacher_office_time,teacher_show')->where('teacher_false_delete',1)->find();

        return returnJson(1,'',$organization_teacher);
    }

	public function organization_teacher_delete(){//3.15.01会员中心-机构中心-老师管理-删除老师
		$organization_teacher_delete_data = input('post.');
		if (empty($organization_teacher_delete_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_teacher_delete_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $organization_find = Db::name('organization')->where('user_id',$user_find['user_id'])->field('organization_id')->find();
        $organization_teacher_delete = Db::name('organization_teacher')->where('organization_teacher_id',$organization_teacher_delete_data['organization_teacher_id'])->update([
        	'teacher_false_delete'=>2,
        ]);
        if ($organization_teacher_delete == 1) {
        	return returnJson(1,'删除成功!');
        }
        if ($organization_teacher_delete == 0) {
            return returnJson(1,'已删除!');
        }else{
            return returnJson(1,'删除失败!');
        }
	}

    public function organization_teacher_add(){//3.15.04会员中心-机构中心-老师管理-添加老师
        $organization_teacher_delete_data = input('post.');
        if (empty($organization_teacher_delete_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_teacher_delete_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $user = user($organization_teacher_delete_data['user_token']);
        $user_organization = user_organization($user['user_id']);
        $organization_teacher_data = [
            'teacher_name'=>$organization_teacher_delete_data['teacher_name'],
            'teacher_phone'=>$organization_teacher_delete_data['teacher_phone'],
            'teacher_master'=>$organization_teacher_delete_data['teacher_master'],
            'teacher_intro'=>$organization_teacher_delete_data['teacher_intro'],
            'organization_id'=>$user_organization['organization_id'],
            'teacher_office_time'=>$organization_teacher_delete_data['teacher_office_time'],
        ];
        $organization_teacher_insert = Db::name('organization_teacher')->insert($organization_teacher_data);
        if ($organization_teacher_insert == 1) {
            return returnJson(1,'添加成功');
        }
        return returnJson(0,'添加失败');
    }

	public function organization_teacher_recommend(){//3.15.01会员中心-机构中心-老师管理-设为推荐
		$organization_teacher_recommend = input('post.');
		if (empty($organization_teacher_recommend['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_teacher_recommend['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $teacher_recommend = Db::name('organization_teacher')->where('organization_teacher_id',$organization_teacher_recommend['organization_teacher_id'])->update([
        	'teacher_show'=>1,
        ]);
        if ($teacher_recommend == 1) {
            return returnJson(1,'设定成功!');
        }
        if ($teacher_recommend == 0) {
            return returnJson(1,'设定成功!');
        }
	}

	public function organization_teacher_cancel_recommend(){//3.15.01会员中心-机构中心-老师管理-取消推荐
		$organization_teacher_recommend = input('post.');
		if (empty($organization_teacher_recommend['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_teacher_recommend['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $teacher_recommend = Db::name('organization_teacher')->where('organization_teacher_id',$organization_teacher_recommend['organization_teacher_id'])->update([
        	'teacher_show'=>2,
        ]);
        if ($teacher_recommend == 1) {
            return returnJson(1,'取消成功!');
        }
        if ($teacher_recommend == 0) {
            return returnJson(1,'取消成功!');
        }
	}

	public function organization_information_edit(){//3.16.01会员中心-机构中心-机构编辑
		$organization_information_edit = input('post.');
		if (empty($organization_information_edit['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_information_edit['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $organization_find = Db::name('organization')->where('organization_id',$organization_information_edit['organization_id'])->field('organization_id,organization_name,organization_portrait,organization_cover,organization_site,organization_facility,organization_business_hours,organization_synopsis,organization_service,promotional_video,promotional_cover,organization_type,organization_creattime')->where('organization_false_delete',1)->where('organization_state',1)->find();
        return returnJson(1,'',$organization_find);//用户账户封停
	}

	public function organization_affirm_edit(){//3.16.02会员中心-机构中心-机构编辑-确认修改
		$affirm_edit_data = input('post.');
        // $organization_portrait = request()->file('organization_portrait');
        // $organization_cover = request()->file('organization_cover');
		if (empty($affirm_edit_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$affirm_edit_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete,user_phone')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        // if ($organization_portrait !== NULL && $organization_cover == NULL) {
        //     $info = $organization_portrait->move(ROOT_PATH . 'public' . DS . 'uploads');
        //     $save_portrait = $info->getSaveName();
        //     $affirm_edit = Db::name('organization')->update([
        //         'user_id'=>$user_find['user_id'],
        //         'organization_portrait'=>$save_portrait,
        //         'organization_name'=>$affirm_edit_data['organization_name'],
        //         'organization_site'=>$affirm_edit_data['organization_site'],
        //         'organization_facility'=>$affirm_edit_data['organization_facility'],
        //         'organization_business_hours'=>$affirm_edit_data['organization_business_hours'],
        //         'organization_synopsis'=>$affirm_edit_data['organization_synopsis'],
        //         'organization_type'=>$affirm_edit_data['organization_type'],
        //         'organization_id'=>$affirm_edit_data['organization_id'],
        //     ]);
        // }
        // if ($organization_portrait == NULL && $organization_cover !== NULL) {
        //     $cover = $organization_cover->move(ROOT_PATH . 'public' . DS . 'uploads');
        //     $organization_cover = $cover->getSaveName();
        //     $affirm_edit = Db::name('organization')->update([
        //         'user_id'=>$user_find['user_id'],
        //         'organization_cover'=>$organization_cover,
        //         'organization_name'=>$affirm_edit_data['organization_name'],
        //         'organization_site'=>$affirm_edit_data['organization_site'],
        //         'organization_facility'=>$affirm_edit_data['organization_facility'],
        //         'organization_business_hours'=>$affirm_edit_data['organization_business_hours'],
        //         'organization_synopsis'=>$affirm_edit_data['organization_synopsis'],
        //         'organization_type'=>$affirm_edit_data['organization_type'],
        //         'organization_id'=>$affirm_edit_data['organization_id'],
        //     ]);
        // }



            // $info = $organization_portrait->move(ROOT_PATH . 'public' . DS . 'uploads');
            // $save_portrait = $info->getSaveName();
            // $cover = $organization_cover->move(ROOT_PATH . 'public' . DS . 'uploads');
            // $organization_cover = $cover->getSaveName();
            $user = user($affirm_edit_data['user_token']);
            $user_organization = user_organization($user['user_id']);
            $affirm_edit = Db::name('organization')->update([
                'user_id'=>$user_find['user_id'],
                'organization_portrait'=>$affirm_edit_data['organization_portrait'],
                'organization_cover'=>$affirm_edit_data['organization_cover'],
                'organization_name'=>$affirm_edit_data['organization_name'],
                'organization_site'=>$affirm_edit_data['organization_site'],
                'organization_facility'=>$affirm_edit_data['organization_facility'],
                'organization_business_hours'=>$affirm_edit_data['organization_business_hours'],
                'organization_synopsis'=>$affirm_edit_data['organization_synopsis'],
                'organization_type'=>$affirm_edit_data['organization_type'],
                'organization_id'=>$user_organization['organization_id'],
                'promotional_video'=>$affirm_edit_data['promotional_video'],
                'promotional_cover'=>$affirm_edit_data['promotional_cover'],
                'organization_service'=>$affirm_edit_data['organization_service'],
            ]);
            if ($affirm_edit == 1) {
                JM_update_information($user_find['user_phone'],$affirm_edit_data['organization_name'],$affirm_edit_data['organization_portrait']);
                return returnJson(1,'成功');
            }
            if ($affirm_edit == 0) {
                return returnJson(1,'未修改');
            }else{
                return returnJson(0,'修改失败');
            }


        // if ($organization_portrait == NULL && $organization_cover == NULL) {
        //     $affirm_edit = Db::name('organization')->update([
        //         'user_id'=>$user_find['user_id'],
        //         'organization_name'=>$affirm_edit_data['organization_name'],
        //         'organization_site'=>$affirm_edit_data['organization_site'],
        //         'organization_facility'=>$affirm_edit_data['organization_facility'],
        //         'organization_business_hours'=>$affirm_edit_data['organization_business_hours'],
        //         'organization_synopsis'=>$affirm_edit_data['organization_synopsis'],
        //         'organization_type'=>$affirm_edit_data['organization_type'],
        //         'organization_id'=>$affirm_edit_data['organization_id'],
        //     ]);
        // }
        return returnJson(1,'修改成功');//修改成功
	}

	public function organization_curriculum_manage(){//3.18.01会员中心-机构中心-课程管理
        $user_token = input('user_token');
        if (empty($user_token)) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$user_token)->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $user = user($user_token);
        $user_organization = user_organization($user['user_id']);
        // $curriculum_select['organization'] = Db::name('organization')->where('organization_id',$user_organization['organization_id'])->field('organization_id,organization_name,organization_portrait,organization_site,organization_service')->where('organization_false_delete',1)->where('organization_state',1)->find();
        $curriculum_select['curriculum'] = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.organization_id = c.organization_id','left')->field('a.curriculum_id,a.curriculum_admin,a.curriculum_name,a.curriculum_actual_price,a.curriculum_difficulty,a.curriculum_state')->where('c.organization_id',$user_organization['organization_id'])->where('curriculum_state',1)->where('curriculum_false_delete',1)->order('curriculum_creattime desc')->select();

        return returnJson(1,'',$curriculum_select);//用户账户封停
    }

    public function organization_cease_curriculum(){//3.18.01机构中心-课程管理-已下架(新验证)
        $user_token = input('user_token');
        if (empty($user_token)) {
            return returnJson(-1,'请登录...');//判断登录
        }
        if (!$user_find = Db::name('user')->where('user_token',$user_token)->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }
        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }
        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $user = user($user_token);
        $user_organization = user_organization($user['user_id']);
        // $curriculum_select['organization'] = Db::name('organization')->where('organization_id',$user_organization['organization_id'])->field('organization_id,organization_name,organization_portrait,organization_site,organization_service')->where('organization_false_delete',1)->where('organization_state',1)->find();
        $curriculum_select['curriculum'] = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.organization_id = c.organization_id','left')->field('a.curriculum_id,a.curriculum_admin,a.curriculum_name,a.curriculum_actual_price,a.curriculum_difficulty,a.curriculum_state')->where('c.organization_id',$user_organization['organization_id'])->where('curriculum_state',2)->where('curriculum_false_delete',1)->order('curriculum_creattime desc')->select();

        return returnJson(1,'',$curriculum_select);//用户账户封停
    }

    public function organization_curriculum_state_update(){//3.18.01机构中心-课程管理-上下架操作(新验证)
        $curriculum_data = input('post.');
        $user = user($curriculum_data['user_token']);
        $curriculum = organization_curriculum_find($user['user_id']);
        
        $curriculum_find = 
        var_dump($user);exit();
        if ($curriculum == null) {
            return returnJson(0,'信息查询失败');
        }
        if ($curriculum_data['type'] == 1) {
            $curriculum_update = Db::name('curriculum')->where('curriculum_id',$curriculum_data['curriculum_id'])->update([
                    'curriculum_state'=>1,
                ]);
            if ($curriculum_update == 1) {
                return returnJson(1,'上架成功!');
            }
            if ($curriculum_update == 0) {
                return returnJson(1,'已上架!');
            }else{
                return returnJson(0,'上架失败,服务器正忙。。。');
            }
        }
        if ($curriculum_data['type'] == 2) {
            $curriculum_update = Db::name('curriculum')->where('curriculum_id',$curriculum_data['curriculum_id'])->update([
                    'curriculum_state'=>2,
            ]);
            if ($curriculum_update == 1) {
                return returnJson(1,'下架成功!');
            }
            if ($curriculum_update == 0) {
                return returnJson(1,'已下架!');
            }else{
                return returnJson(0,'下架失败,服务器正忙。。。');
            }
        }
    }

    public function organization_curriculum_add(){//3.18.02会员中心-机构中心-课程管理-课程添加
        $organization_curriculum_data = input('post.');

        if (empty($organization_curriculum_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_curriculum_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        if ($user_find['user_role'] !== 3) {
            return returnJson(0,'非法操作');//用户账户封停
        }
        $user = user($organization_curriculum_data['user_token']);
        $user_organization = user_organization($user['user_id']);
        if ($user_organization['organization_state'] !== 1) {
            return returnJson(0,'机构状态异常!');//用户账户封停
        }
        
        $curriculum_data = [
            'curriculum_admin'=> $organization_curriculum_data['curriculum_admin'],
            'curriculum_name'=> $organization_curriculum_data['curriculum_name'],
            'curriculum_introduce_picture'=> $organization_curriculum_data['curriculum_introduce_picture'],
            'curriculum_details'=> $organization_curriculum_data['curriculum_details'],
            'curriculum_video'=> $organization_curriculum_data['curriculum_video'],
            'curriculum_actual_price'=> $organization_curriculum_data['curriculum_actual_price'],
            'curriculum_difficulty'=> $organization_curriculum_data['curriculum_difficulty'],
            'curriculum_creattime'=> time(),
            'curriculum_effective'=> $organization_curriculum_data['curriculum_effective'],
            'curriculum_start_time'=> $organization_curriculum_data['curriculum_start_time'],
            'curriculum_over_time'=> $organization_curriculum_data['curriculum_over_time'],
            'dance_type_id'=> $organization_curriculum_data['dance_type_id'],
            // 'max_people_number'=> $organization_curriculum_data['max_people_number'],
            'curriculum_identity_type'=>2,
            'curriculum_photo'=>$user_organization['organization_portrait'],
        ];

        $curriculum_insert = Db::name('curriculum')->insertGetId($curriculum_data);
        $organization_curriculum = Db::name('organization_curriculum')->insert([
                'organization_id'=>$user_organization['organization_id'],
                'curriculum_id'=>$curriculum_insert,
            ]);
        if ($organization_curriculum == 1) {
            return returnJson(1,'添加成功');//添加成功
        }
        return returnJson(0,'添加失败');//添加成功
    }

    public function organization_curriculum_del(){//3.18.03会员中心-机构中心-课程管理-课程删除
        $organization_curriculum_del = input('post.');

        if (empty($organization_curriculum_del['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$organization_curriculum_del['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $user = user($organization_curriculum_del['user_token']);
        $user_organization = user_organization($user['user_id']);

        $organization_curriculum = Db::name('curriculum')->update([
                'curriculum_false_delete'=>2,
                'curriculum_id'=>$organization_curriculum_del['curriculum_id'],
            ]);
        if ($organization_curriculum == 1) {
            return returnJson(1,'删除成功');//添加成功
        }
        if ($organization_curriculum == 0) {
            return returnJson(1,'已删除');//添加成功
        }
        return returnJson(0,'删除失败');//添加成功
    }

	// public function organization_curriculum_add(){//3.18.02会员中心-机构中心-课程管理-课程添加
	// 	$curriculum_add = input('post.');
	// 	if (empty($curriculum_add['user_token'])) {
 //            return returnJson(-1,'请登录...');//判断登录
 //        }

 //        if (!$user_find = Db::name('user')->where('user_token',$curriculum_add['user_token'])->field('user_id,user_name,user_sex
 //            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
 //            return returnJson(-1,'请登录...');//用户查询
 //        }

 //        if ($user_find['user_false_delete'] == 2) {
 //            return returnJson(0,'用户不存在...');//用户已被删除
 //        }

 //        if ($user_find['user_status'] == 2) {
 //            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
 //        }
 //        if ($curriculum_add['curriculum_effective'] == 1) {

 //        	$insert = [
 //        	'curriculum_admin'=>$curriculum_add['curriculum_admin'],
 //        	'curriculum_name'=>$curriculum_add['curriculum_name'],
 //        	'curriculum_introduce_picture'=>$curriculum_add['curriculum_introduce_picture'],
 //        	'curriculum_photo'=>$curriculum_add['curriculum_photo'],
 //        	'curriculum_details'=>$curriculum_add['curriculum_details'],
 //        	'curriculum_video'=>$curriculum_add['curriculum_video'],
 //        	'curriculum_actual_price'=>$curriculum_add['curriculum_actual_price'],
 //        	'curriculum_former_price'=>$curriculum_add['curriculum_former_price'],
 //        	'curriculum_difficulty'=>$curriculum_add['curriculum_difficulty'],
 //        	'curriculum_effective'=>$curriculum_add['curriculum_effective'],
 //        	'curriculum_start_time'=>$curriculum_add['curriculum_start_time'],
 //        	'curriculum_over_time'=>$curriculum_add['curriculum_over_time'],
 //        	'curriculum_admin'=>$curriculum_add['curriculum_admin'],
 //        	'curriculum_admin'=>$curriculum_add['curriculum_admin'],
 //        	];
 //        }
        
        

 //        return returnJson(1,'',$);//用户账户封停
	// }


	public function attention_organization(){//3.19.01会员中心-机构中心-机构粉丝
		$attention_organization = input('post.');
		if (empty($attention_organization['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$attention_organization['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        if (empty($attention_teacher['paging'])) {
            $attention_teacher['paging'] = 1;
        }
        $limit = 10;
        $paging = ($attention_teacher['paging']-1)*$limit;

        $user_organization = Db::name('organization')->where('user_id',$user_find['user_id'])->find();

        $organization_attention_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait,b.user_signature')->where('fid',$user_organization['organization_id'])->where('attention_identity',2)->limit($paging,$limit)->select();
        // $organization_attention_select['videos'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('file_state',1)->where('file_false_delete',1)->limit($paging,$limit)->limit($paging,$limit)->field('file_id,dance_type_name,file_cover,file_name,file_collection,file_type,file_category')->select();

         // $organization_attention_select['videos'] = Db::name('organization')->alias('a')->join('file_organization b','a.organization_id = b.organization_id','left')->join('file c','b.file_id = c.file_id','left')->join('dance_type k','c.dance_type_id = k.dance_type_id','left')->where('c.file_type',1)->where('c.file_state',1)->where('c.file_false_delete',1)->order('c.file_creattime desc')->limit($paging,$limit)->field('c.file_id,k.dance_type_name,c.file_cover,c.file_name,c.file_collection,k.dance_type_name,a.organization_portrait,a.organization_id')->select();
        return returnJson(1,'',$organization_attention_select);//用户账户封停
	}

    public function organization_play_videos(){//播放视频
        $videos_data = input('post.');
        
        $video_list['comments'] = Db::name('file')->alias('a')->join('comments b','a.file_id = b.file_id','left')->where('a.file_id',$videos_data['file_id'])->field('a.file_id,file_cover,file_content,file_name,file_collection')->where('file_state',1)->where('file_false_delete',1)->limit(0,10)->select();
        $video_list['video'] = Db::name('file')->where('file_id',$videos_data['file_id'])->find();
        return returnJson(1,'',$video_list);//用户账户封停
    }

    public function file_play(){//播放文件
        $videos_data = input('post.');
        $video_list['video'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('file_id',$videos_data['file_id'])->field('file_cover,file_content,file_name,dance_type_name')->find();
        
        
        if (!empty($videos_data['user_token'])) {
            $user = user($videos_data['user_token']);
            $collect = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$videos_data['file_id'])->find();
            if ($collect == null) {
                $collect = 2;//没有收藏
            }else{
                $collect = 1;//已经收藏
            }
            $file = file_find($videos_data['file_id']);
            // var_dump($file);exit();
            if ($file['user_id'] == $user['user_id']) {
                $my_file = 1;
            }else{
                $my_file = 2;
            }
        }






        foreach ($video_list['video'] as $k => $v) {
                $video_list['video']['collect'] = $collect;
                $video_list['video']['my_file'] = $my_file;
            }
        return returnJson(1,'',$video_list);//用户账户封停
    }

    public function file_play_comments(){//播放文件评论分页
        $videos_data = input('post.');

        $comments = Db::name('comments')->where('file_id',$videos_data['file_id'])->find();
        if ($comments == null) {
            $video_list['comments'] = [];
            return returnJson(1,'',$video_list);//用户账户封停
        }
        $limit = 10;
        $paging = ($videos_data['paging']-1)*$limit;

        $video_list['comments'] = Db::name('file')->alias('a')->join('comments b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('a.file_id',$videos_data['file_id'])->field('comments_id,comments_content,comments_creattime,user_portrait,c.user_name')->where('file_state',1)->where('file_false_delete',1)->limit($paging,$limit)->select();

        return returnJson(1,'',$video_list);//用户账户封停
    }



    public function file_collect(){//文件收藏处理
        $file_data = input('post.');
        $user = user($file_data['user_token']);
        // var_dump($user);exit();
        if ($user == null) {
            return returnJson(-1,'请登录。。。');//用户账户封停
        }
        if ($file_data['type'] == 1) {//1收藏
                $collect_find = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->find();
            if ($collect_find == null) {
                $collect_insert = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->insert([
                    'user_id'=>$user['user_id'],
                    'file_id'=>$file_data['file_id'],
                    'collect_creattime'=>time(),
                ]);
                if ($collect_insert == 1) {
                    return returnJson(1,'收藏成功');//用户账户封停
                }elseif($collect_insert == 0){
                    return returnJson(1,'已收藏');//用户账户封停
                }else{
                    return returnJson(0,'收藏失败');//用户账户封停
                }
            }
            return returnJson(1,'收藏成功');//用户账户封停
        }if ($file_data['type'] == 2) {
            $collect_find = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->find();
            if ($collect_find !== null) {
                $collect_insert = Db::name('collect_file')->delete($collect_find['collect_id']);
                if ($collect_insert == 1) {
                    return returnJson(1,'取消收藏成功');//用户账户封停
                }elseif($collect_insert == 0){
                    return returnJson(1,'已取消收藏');//用户账户封停
                }else{
                    return returnJson(0,'取消收藏失败');//用户账户封停
                }
            }
            return returnJson(0,'取消收藏成功');//用户账户封停
        }
    }


    // public function file_collect(){//文件收藏
    //     $file_data = input('post.');
    //     $user = user($file_data['user_token']);
    //     if ($user == null) {
    //         return returnJson(-1,'请登录。。。');//用户账户封停
    //     }
    //     $collect_find = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->find();
    //     if ($collect_find == null) {
    //         $collect_insert = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->insert([
    //             'user_id'=>$user['user_id'],
    //             'file_id'=>$file_data['file_id'],
    //             'collect_creattime'=>time(),
    //         ]);
    //         if ($collect_insert == 1) {
    //             return returnJson(1,'收藏成功');//用户账户封停
    //         }else{
    //             return returnJson(0,'收藏失败');//用户账户封停
    //         }
    //     }
    //     return returnJson(1,'收藏成功');//用户账户封停
    // }

    // public function file_cancel_collect(){//文件取消收藏
    //     $file_data = input('post.');
    //     $user = user($file_data['user_token']);
    //     if ($user == null) {
    //         return returnJson(-1,'请登录。。。');//用户账户封停
    //     }
    //     $collect_find = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->find();
    //     if ($collect_find !== null) {
    //         $collect_insert = Db::name('collect_file')->where('user_id',$user['user_id'])->where('file_id',$file_data['file_id'])->delete();
    //         if ($collect_insert == 1) {
    //             return returnJson(1,'取消收藏成功');//用户账户封停
    //         }else{
    //             return returnJson(0,'取消收藏失败');//用户账户封停
    //         }
    //     }
    //     return returnJson(0,'取消收藏成功');//用户账户封停
    // }

    public function curriculum_collect(){//收藏课程合并
        $curriculum_data = input('post.');
        $user = user($curriculum_data['user_token']);
        if ($user == null) {
            return returnJson(-1,'请登录。。。');//用户账户封停
        }
        if ($curriculum_data['type'] == 1) {//1收藏
                $collect_find = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
                
                if ($collect_find == null) {
                $collect_insert = Db::name('collect_curriculum')->insert([
                    'user_id'=>$user['user_id'],
                    'curriculum_id'=>$curriculum_data['curriculum_id'],
                    'collect_creattime'=>time(),
                ]);
                if ($collect_insert == 1) {
                    return returnJson(1,'收藏成功');//用户账户封停
                }elseif($collect_insert == 0){
                    return returnJson(1,'已经收藏');//用户账户封停
                }else{
                    return returnJson(0,'收藏失败');//用户账户封停
                }
            }else{
                return returnJson(1,'已经收藏');//用户账户封停
            }
        }
        if ($curriculum_data['type'] == 2) {//2取消收藏
                $collect_find = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
                // var_dump($collect_find);
                if ($collect_find !== null) {
                $collect_insert = Db::name('collect_curriculum')->delete($collect_find['collect_id']);
                if ($collect_insert == 1) {
                    return returnJson(1,'取消收藏成功');//用户账户封停
                }elseif($collect_insert == 0){
                    return returnJson(1,'已取消收藏');//用户账户封停
                }else{
                    return returnJson(0,'取消收藏失败');//用户账户封停
                }
            }
            return returnJson(1,'已取消收藏');//用户账户封停
        }
    }








    // public function curriculum_collect(){//课程收藏
    //     $curriculum_data = input('post.');
    //     $user = user($curriculum_data['user_token']);
    //     if ($user == null) {
    //         return returnJson(-1,'请登录。。。');//用户账户封停
    //     }
    //     $collect_find = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
    //     if ($collect_find == null) {
    //         $collect_insert = Db::name('collect_curriculum')->insert([
    //             'user_id'=>$user['user_id'],
    //             'curriculum_id'=>$curriculum_data['curriculum_id'],
    //             'collect_creattime'=>time(),
    //         ]);
    //         if ($collect_insert == 1) {
    //             return returnJson(1,'收藏成功');//用户账户封停
    //         }else{
    //             return returnJson(0,'收藏失败');//用户账户封停
    //         }
    //     }
    //     return returnJson(0,'取消收藏成功');//用户账户封停
    // }

    // public function curriculum_cancel_collect(){//文件取消收藏
    //     $curriculum_data = input('post.');
    //     $user = user($curriculum_data['user_token']);
    //     if ($user == null) {
    //         return returnJson(-1,'请登录。。。');//用户账户封停
    //     }
    //     $collect_find = Db::name('collect_file')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
    //     if ($collect_find !== null) {
    //         $collect_insert = Db::name('collect_file')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->delete();
    //         if ($collect_insert == 1) {
    //             return returnJson(1,'取消收藏成功');//用户账户封停
    //         }else{
    //             return returnJson(0,'取消收藏失败');//用户账户封停
    //         }
    //     }
    //     return returnJson(0,'取消收藏成功');//用户账户封停
    // }

    public function attention_teacher(){//关注教师
        $attention_teacher_data = input('post.');

        if (empty($attention_teacher_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$attention_teacher_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        // var_dump($user_find['user_id']);exit();
        $attention_find = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$attention_teacher_data['user_teacher_id'])->where('attention_identity',1)->find();
        if ($attention_find == null) {
            $attention_insert = [
            'uid'=>$user_find['user_id'],
            'fid'=>$attention_teacher_data['user_teacher_id'],
            'attention_identity'=>1,
            'attention_creattime'=>time(),
            ];
            $attention_insert = Db::name('attention')->insert($attention_insert);
            if ($attention_insert == 1) {
                return returnJson(1,'关注成功!');
            }else{
                return returnJson(0,'关注失败!');
            }
        }
        return returnJson(1,'关注成功!');
    }

    public function organization_attention(){//关注机构
        $attention_organization = input('post.');

        if (empty($attention_organization['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$attention_organization['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $attention_find = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$attention_organization['organization_id'])->where('attention_identity',2)->find();
        if ($attention_find == null) {
            $attention_insert = [
            'uid'=>$user_find['user_id'],
            'fid'=>$attention_organization['organization_id'],
            'attention_identity'=>2,
            'attention_creattime'=>time(),
            ];
            $attention_insert = Db::name('attention')->insert($attention_insert);
            if ($attention_insert == 1) {
                return returnJson(1,'关注成功!');
            }else{
                return returnJson(0,'关注失败!');
            }
        }
        return returnJson(1,'关注成功!');
    }


    public function organization_cancel_attention(){//取消关注机构
        $attention_organization = input('post.');

        if (empty($attention_organization['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$attention_organization['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $attention_delete = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$attention_organization['organization_id'])->where('attention_identity',2)->delete();
        if ($attention_delete == 1) {
            return returnJson(1,'取消关注成功');//精品课程列表
        }
        return returnJson(1,'取消关注成功');//精品课程列表
    }

    public function organization_delete_work(){//删除我的作品
        $delete_work_data = input('post.');

        if (empty($delete_work_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$delete_work_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $organization = user_organization($user_find['user_id']);
        $organization_file = Db::name('File')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('c.organization_id',$organization['organization_id'])->where('a.file_id',$delete_work_data['file_id'])->where('file_false_delete',1)->find();
        // var_dump($organization_file);exit();
        if ($organization_file == null) {
            return returnJson(1,'文件已被删除');//用户账户封停
        }
        if ($organization_file !== null) {
            $organization_file_update = Db::name('File')->where('file_id',$delete_work_data['file_id'])->update([
                'file_false_delete'=>2,
            ]);
            if ($organization_file_update == 1) {
                return returnJson(1,'文件已删除');//用户账户封停
            }
        }
        // $file_work = organization_work_find($delete_work_data['user_token'],$delete_work_data['file_id']);
        // if ($file_work == 1) {
        //     $file_update = Db::name('file')->where('file_id',$delete_work_data['file_id'])->update([
        //             'file_false_delete'=>2,
        //     ]);
        //     if ($file_update == 1) {
        //         return returnJson(1,'删除成功!');//精品课程列表
        //     }
        //     if ($file_update == 0) {
        //         return returnJson(1,'已经删除');//精品课程列表
        //     }else{
        //         return returnJson(0,'删除失败,服务器正忙。。。');//精品课程列表
        //     }
        // }
        // if ($file_work == 2) {
        //     return returnJson(0,'查询文件失败。。。');//精品课程列表
        // }
    }



    public function curriculum_delete(){//3.11.02会员中心-老师中心-课程管理-删除课程
        $curriculum_information = input('post.');

        if (empty($curriculum_information['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$curriculum_information['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $user = user($curriculum_information['user_token']);
        $curriculum = organization_curriculum_find($user['user_id']);
        // var_dump($curriculum);exit();
        if ($curriculum['user_id'] == $user['user_id'] && $curriculum['curriculum_id'] == $curriculum_information['curriculum_id']) {
            $curriculum_update = Db::name('curriculum')->where('curriculum_id',$curriculum_information['curriculum_id'])->update([
                'curriculum_false_delete'=>2,
            ]);
            if (!$curriculum_update) {
            return returnJson(0,'课程服务器正忙...');
            }
        }
        return returnJson(1,'删除成功!');
    }

    public function organization_curriculum_details(){//机构课程详情
        $curriculum_data = input('post.');
        $user = user($curriculum_data['user_token']);
        $collect_inquire = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
        if ($collect_inquire == null) {
            $curriculum_find['collect_state'] = 2;
        }else{
            $curriculum_find['collect_state'] = 1;
        }



        // $curriculum_find['curriculum'] = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('a.curriculum_id',$curriculum_data['curriculum_id'])->where('a.id',$curriculum_data['organization_id'])->field('a.curriculum_id,a.curriculum_name,a.curriculum_admin,a.curriculum_introduce_picture,a.curriculum_photo,a.curriculum_details,a.curriculum_video,a.curriculum_actual_price,curriculum_difficulty,curriculum_state,curriculum_false_delete,curriculum_effective,curriculum_start_time,curriculum_over_time,dance_type_name,a.curriculum_buy_number,id')->find();


        $curriculum_find['curriculum'] = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('id',$curriculum_data['organization_id'])->field('curriculum_id,curriculum_name,curriculum_admin,curriculum_introduce_picture,curriculum_photo,curriculum_details,curriculum_video,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time,dance_type_name,curriculum_buy_number,id')->find();






        $organization = Db::name('organization')->where('organization_id',$curriculum_data['organization_id'])->find();
        $curriculum_find['curriculum']['organization_service'] = $organization['organization_service'];
        // var_dump($curriculum_find['curriculum']);exit();
        $organization = Db::name('organization')->where('organization_id',$curriculum_find['curriculum']['id'])->find();
            $curriculum_find['jmphone'] = Db::name('user')->where('user_id',$organization['user_id'])->field('user_phone')->find();
        return returnJson(1,'',$curriculum_find);//精品课程列表
    }

    // public function organization_curriculum_details(){//机构课程详情
    //     $curriculum_data = input('post.');
    //     $user = user($curriculum_data['user_token']);
    //     $collect_inquire = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
    //     if ($collect_inquire == null) {
    //         $curriculum_find['collect_state'] = 2;
    //     }else{
    //         $curriculum_find['collect_state'] = 1;
    //     }
    //     $curriculum_find['curriculum'] = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.organization_id = c.organization_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('a.curriculum_id',$curriculum_data['curriculum_id'])->field('a.curriculum_id,a.curriculum_name,a.curriculum_admin,a.curriculum_introduce_picture,a.curriculum_photo,a.curriculum_details,a.curriculum_video,a.curriculum_actual_price,curriculum_difficulty,curriculum_state,curriculum_false_delete,curriculum_effective,curriculum_start_time,curriculum_over_time,dance_type_name,c.organization_service,a.curriculum_buy_number')->find();
    //     return returnJson(1,'',$curriculum_find);//精品课程列表
    // }
    // 
    public function organization_file(){
        $user_token = input('user_token');
        $user = user($user_token);

        $videos_select['organization'] = Db::name('organization')->where('user_id',$user['user_id'])->where('organization_state',1)->where('organization_false_delete',1)->field('organization_id,organization_name,organization_portrait,organization_synopsis')->find();


        $videos_select['file'] = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('b.organization_id',$videos_select['organization']['organization_id'])->field('a.file_id,d.dance_type_name,a.file_cover,a.file_name,a.file_type,a.file_creattime,a.file_collection,organization_portrait,organization_name')->where('a.file_state',1)->where('a.file_false_delete',1)->where('a.file_category',3)->order('a.file_collection desc')->select();
        return returnJson(1,'',$videos_select);//正常,'',机构视频结果集
    }
}