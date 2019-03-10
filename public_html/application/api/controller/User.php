<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class User extends Controller{//用户控制器
    
    // public function attention_teacher_list(){//2.01.01关注-关注教师-列表
    //     $attention_data = input('post.');
    //     $teacher_list = Db::name('collect')->where()->
    //     return returnJson(1,'',$user_datum);//正常,'',用户信息
    // }

    public function user_centre(){//用户中心
        $receive = input('post.');

        if (empty($receive['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find['user'] = Db::name('user')->where('user_token',$receive['user_token'])->field('user_id,user_name,user_sex,user_role,user_portrait,user_signature')->where('user_status',1)->where('user_false_delete',1)->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        // if ($user_find['user']['user_false_delete'] == 2) {
        //     return returnJson(0,'用户不存在...');//用户已被删除
        // }

        // if ($user_find['user']['user_status'] == 2) {
        //     return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        // }
        if ($user_find['user'] == null) {
            return returnJson(-1,'用户身份异常，请联系客服！');//用户查询
        }

        if ($user_find['user']['user_role'] == 2) {
            $user_find['user_teacher_id'] = Db::name('user_teacher')->where('user_id',$user_find['user']['user_id'])->field('user_teacher_id')->find();
        }
        if ($user_find['user']['user_role'] == 3) {
            $user_find['organization_id'] = Db::name('organization')->where('user_id',$user_find['user']['user_id'])->field('organization_id')->find();
        }
        
        // $user_find['chat_unread'] = Db::name('chat')->where('chat_fid',$user_find['user']['user_id'])->where('chat_state',2)->count();

        // if ($user_find['chat_unread'] <> 0 || $user_find['chat_unread'] >= 1) {
        //     return returnJson(0,'信息服务器正忙...');//用户中心信息条数查询
        // }
        // $user = Db::name('user')->where('user_token',$receive['user_token'])->field('user_phone')->find();
        // var_dump($user_phone);exit();
        // $user_find['JM_show'] = JM_show($user['user_phone']);
        if (!$user_find['discounts'] = Db::name('user_discounts')->alias('a')->join('user b','a.user_id = b.user_id','left')->where('a.user_id',$user_find['user']['user_id'])->where('user_discounts_read_state',2)->count()) {
        }

        return returnJson(1,'',$user_find);//正常,'',用户信息
    }


    public function user_chat(){//用户中心
        $receive = input('post.');

        if (empty($receive['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find['user'] = Db::name('user')->where('user_token',$receive['user_token'])->field('user_id,user_name,user_sex,user_role,user_portrait,user_signature,user_false_delete,user_status')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user']['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user']['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        if ($user_find['user']['user_role'] == 2) {
            $user_find['user_teacher_id'] = Db::name('user_teacher')->where('user_id',$user_find['user']['user_id'])->field('user_teacher_id')->find();
        }
        if ($user_find['user']['user_role'] == 3) {
            $user_find['organization_id'] = Db::name('organization')->where('user_id',$user_find['user']['user_id'])->field('organization_id')->find();
        }
        
        // $user_find['chat_unread'] = Db::name('chat')->where('chat_fid',$user_find['user']['user_id'])->where('chat_state',2)->count();

        // if ($user_find['chat_unread'] <> 0 || $user_find['chat_unread'] >= 1) {
        //     return returnJson(0,'信息服务器正忙...');//用户中心信息条数查询
        // }
        $user = Db::name('user')->where('user_token',$receive['user_token'])->field('user_phone')->find();
        // var_dump($user_phone);exit();
        $user_find = JM_show($user['user_phone']);
        return returnJson(1,'',$user_find);//正常,'',用户信息
    }

    public function user_datum_update(){//3.02.01修改个人资料
        $token = input('user_token');
        $user_datum = Db::name('user')->where('user_token',$token)->where('user_status',1)->where('user_false_delete',1)->field('user_name,user_sex,user_portrait,user_signature')->find();
        if ($user_datum == null) {
            return returnJson(0,'用户信息查询失败');
        }
        return returnJson(1,'',$user_datum);//正常,'',用户信息
    }

    public function affirm_update(){//3.02.02确认修改
        $user_data = input('post.');
        $user_datum = Db::name('user')->where('user_token',$user_data['user_token'])->where('user_status',1)->where('user_false_delete',1)->find();
        if ($user_datum == null) {
            return returnJson(0,'用户信息查询失败');
        }
            $datum_update = Db::name('user')->update([
                'user_id'=>$user_datum['user_id'],
                'user_name'=>$user_data['user_name'],
                'user_portrait'=>$user_data['user_portrait'],
                'user_signature'=>$user_data['user_signature'],
                'user_sex'=>$user_data['user_sex'],
            ]);
            if ($datum_update == 0) {
                return returnJson(1,'未修改');//正常,'',用户信息
            }
            if ($datum_update == 1) {
                $datum_modification = Db::name('user')->where('user_id',$user_datum['user_id'])->where('user_status',1)->where('user_false_delete',1)->field('user_token,user_name,user_portrait,user_signature,user_sex,user_phone')->find();
                JM_update_information($datum_modification['user_phone'],$user_data['user_name'],$user_data['user_portrait']);
                return returnJson(1,'修改成功');//正常,'',用户信息
            }else{
                return returnJson(0,'修改失败,服务器正忙。。。');//正常,'',用户信息
            }
    }

    public function user_collect_videos(){//3.03.02我的收藏-收藏视频
        $receive = input('post.');

        if (empty($receive['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find['user'] = Db::name('user')->where('user_token',$receive['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user']['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user']['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $limit = 10;
        $paging = ($receive['paging']-1)*$limit;

        $collect_videos_list['user'] = user_brief($receive['user_token']);
        $collect_videos_list['videos'] = Db::name('collect_file')->alias('a')->join('file b','a.file_id = b.file_id','left')->join('yw_dance_type c','b.dance_type_id = c.dance_type_id','left')->where('a.user_id',$user_find['user']['user_id'])->where('file_false_delete',1)->field('collect_id,a.file_id,file_cover,file_name,file_type,file_category,file_state,dance_type_name,file_collection')->limit($paging,$limit)->order('a.collect_creattime desc')->select();
        foreach ($collect_videos_list['videos'] as $k => $v) {
            if ($collect_videos_list['videos'][$k]['file_category'] == 1) {
                $user = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('a.file_id',$v['file_id'])->find();
                $collect_videos_list['videos'][$k]['file_portrait'] = $user['user_portrait'];
                $collect_videos_list['videos'][$k]['file_writer'] = $user['user_name'];
            }
            if ($collect_videos_list['videos'][$k]['file_category'] == 2) {
                $user_teacher = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('a.file_id',$v['file_id'])->find();
                $collect_videos_list['videos'][$k]['file_portrait'] = $user_teacher['teacher_portrait'];
                $collect_videos_list['videos'][$k]['file_writer'] = $user_teacher['teacher_name'];
            }
            if ($collect_videos_list['videos'][$k]['file_category'] == 3) {
                $organization = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('a.file_id',$v['file_id'])->find();
                $collect_videos_list['videos'][$k]['file_portrait'] = $organization['organization_portrait'];
                $collect_videos_list['videos'][$k]['file_writer'] = $organization['organization_name'];
            }
        }
        return returnJson(1,'',$collect_videos_list);//正常,'',收藏信息
    }

// field('a.collect_id,b.file_id,a.collect_creattime,b.file_cover,b.file_name,b.file_type,b.file_category,b.file_state')->
// 
// 
// 
    // public function user_collect_curriculum(){//3.03.01我的收藏-收藏课程
    //     $receive = input('post.');

    //     if (empty($receive['user_token'])) {
    //         return returnJson(-1,'请登录...');//判断登录
    //     }

    //     if (!$user_find = Db::name('user')->where('user_token',$receive['user_token'])->field('user_id,user_name,user_sex
    //         ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
    //         return returnJson(-1,'请登录...');//用户查询
    //     }

    //     if ($user_find['user_false_delete'] == 2) {
    //         return returnJson(0,'用户不存在...');//用户已被删除
    //     }

    //     if ($user_find['user_status'] == 2) {
    //         return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
    //     }

    //     $limit = 10;
    //     $paging = ($receive['paging']-1)*$limit;

    //     $collect_curriculum['user'] = Db::name('user')->where('user_token',$receive['user_token'])->field('user_name,user_name,user_sex,user_role,user_portrait,user_signature')->where('user_false_delete',1)->where('user_status',1)->find();

    //     $collect_curriculum['teacher_curriculum'] = Db::name('collect')->alias('a')->join('curriculum b','a.curriculum_id = b.curriculum_id','right')->where('user_id',$user_find['user_id'])->field('collect_id,b.curriculum_id,curriculum_admin,curriculum_name,curriculum_photo,curriculum_actual_price,curriculum_difficulty,curriculum_identity_type,curriculum_state,curriculum_false_delete')->where('curriculum_identity_type',1)->order('collect_creattime desc')->limit($paging,$limit)->select();
    //     // var_dump($collect_curriculum['curriculum']);exit();

    //     // if ($collect_curriculum['curriculum'][$k]['curriculum_identity_type'] == 1) {
    //         foreach ($collect_curriculum['teacher_curriculum'] as $k => $v) {
    //             $user_teacher_portrait = Db::name('curriculum')->alias('a')->join('curriculum_teacher b','a.curriculum_id = b.curriculum_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->field('c.teacher_portrait')->where('a.curriculum_id',$v['curriculum_id'])->find();
    //             // var_dump($user_teacher_portrait);exit();
    //             $collect_curriculum['teacher_curriculum'][$k]['curriculum_photo'] = $user_teacher_portrait['teacher_portrait'];
    //         }

    //         $collect_curriculum['organization_curriculum'] = Db::name('collect')->alias('a')->join('curriculum b','a.curriculum_id = b.curriculum_id','right')->where('user_id',$user_find['user_id'])->field('collect_id,b.curriculum_id,curriculum_admin,curriculum_name,curriculum_photo,curriculum_actual_price,curriculum_difficulty,curriculum_identity_type,curriculum_state,curriculum_false_delete')->where('curriculum_identity_type',2)->order('collect_creattime desc')->limit($paging,$limit)->select();
    //     // }
    //     // if ($collect_curriculum['curriculum']['curriculum_identity_type'] == 2) {
    //         foreach ($collect_curriculum['organization_curriculum'] as $k => $v) {
    //             $organization_portrait = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.organization_id = c.organization_id','left')->field('c.organization_portrait')->where('a.curriculum_id',$v['curriculum_id'])->find();
    //             $collect_curriculum['organization_curriculum'][$k]['curriculum_photo'] = $organization_portrait['organization_portrait'];
    //         }
    //     // }
    //     return returnJson(1,'',$collect_curriculum);//正常,'',收藏信息
    // }
    
    public function user_collect_curriculum(){//3.03.01我的收藏-收藏课程
        $receive = input('post.');

        if (empty($receive['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$receive['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }

        $limit = 10;
        $paging = ($receive['paging']-1)*$limit;

        $collect_curriculum['user'] = Db::name('user')->where('user_token',$receive['user_token'])->field('user_name,user_name,user_sex,user_portrait,user_signature')->where('user_false_delete',1)->where('user_status',1)->find();

        $collect_curriculum['curriculum'] = Db::name('collect_curriculum')->alias('a')->join('curriculum b','a.curriculum_id = b.curriculum_id','left')->where('a.user_id',$user_find['user_id'])->field('collect_id,b.curriculum_id,curriculum_admin,curriculum_name,curriculum_photo,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time,curriculum_state')->order('collect_creattime desc')->limit($paging,$limit)->select();

        return returnJson(1,'',$collect_curriculum);//正常,'',收藏信息
    }

    public function verify(){//3.06.00免费入驻-判断状态接口
        $verify_data = input('post.');
        $user = user($verify_data['user_token']);

        if ($verify_data['verify_type'] == 1) {//当verify_type为1验证教师
            $teacher_verify = Db::name('user_teacher')->where('user_id',$user['user_id'])->field('teacher_state')->find();
        if ($teacher_verify == null) {
           return returnJson(1,'正常');//
        }
        if ($teacher_verify['teacher_state'] == 3) {
            return returnJson(3,'审核中...');//审核中
            }
        if ($teacher_verify['teacher_state'] == 4) {
            if ($teacher_verify = Db::name('user_teacher')->where('user_id',$user['user_id'])->delete()) {
                return returnJson(4,'审核失败...');//审核失败
                }
            }
        // if ($teacher_verify['teacher_state'] == 2) {
        //     return returnJson(2,'被封停...');//审核失败
        //     }
        // if ($teacher_verify['teacher_state'] == 1) {
        //     return returnJson(1,'正常...');//正常
        // }
        return returnJson(0,'服务器正忙...');//正常
        }
        if ($verify_data['verify_type'] == 2) {
            $organization_verify = Db::name('organization')->where('user_id',$user['user_id'])->field('organization_state')->find();
            if ($organization_verify == null) {
                return returnJson(1,'正常');
            }
            if ($organization_verify['organization_state'] == 3) {
            return returnJson(3,'审核中...');//审核中
            }
            if ($organization_verify['organization_state'] == 4) {
                if ($organization_verify = Db::name('organization')->where('user_id',$user['user_id'])->delete()) {
                return returnJson(4,'审核失败...');//审核失败
                }
            }
            // if ($organization_verify['organization_state'] == 2) {
            //     return returnJson(2,'被封停...');//被封停
            // }
            // if ($organization_verify['organization_state'] == 1) {
            //     return returnJson(1,'正常...');//正常
            // }
            return returnJson(0,'服务器正忙...');//正常
        }
    }
    public function status_upgrade(){//3.06.01会员中心-免费入驻
        $status_upgrade = input('post.');
        // $teacher_portrait = request()->file('teacher_portrait');
        // $organization_portrait = request()->file('organization_portrait');
        // $organization_cover = request()->file('organization_cover');
        if (empty($status_upgrade['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find['user'] = Db::name('user')->where('user_token',$status_upgrade['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user']['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user']['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        if ($status_upgrade['enter_type'] == 1) {
            $prevent_repetition_teacher = Db::name('user_teacher')->where('user_id',$user_find['user']['user_id'])->find();
            if ($prevent_repetition_teacher['teacher_state'] == 1) {
                return returnJson(0,'您已经是教师');
            }
            if ($prevent_repetition_teacher['teacher_state'] == 2) {
                return returnJson(0,'您的教师身份已经被封停');
            }
            if ($prevent_repetition_teacher['teacher_state'] == 3) {
                return returnJson(1,'正在审核。。。');
            }
            if ($prevent_repetition_teacher['teacher_state'] == 4) {
                return returnJson(0,'申请失败,请联系平台');
            }
        }
        if ($status_upgrade['enter_type'] == 1) {//当enter_type为1是入驻成为用户教师

            // $info = $teacher_portrait->move(ROOT_PATH . 'public' . DS . 'uploads');
            // $save_portrait = $info->getSaveName();
            // 
            
            $insert = [
                'user_id'=>$user_find['user']['user_id'],
                'teacher_name'=>$status_upgrade['teacher_name'],
                'district_id'=>$status_upgrade['district_id'],
                'teacher_portrait'=>$status_upgrade['teacher_portrait'],
                'teacher_site'=>$status_upgrade['teacher_site'],
                'teacher_phone'=>$status_upgrade['teacher_phone'],
                'schooltime'=>$status_upgrade['schooltime'],
                'teacher_intro'=>$status_upgrade['teacher_intro'],
                'teacher_video_cover'=>$status_upgrade['teacher_video_cover'],
                'teacher_video'=>$status_upgrade['teacher_video'],
                'teacher_master'=>$status_upgrade['teacher_master'],//擅长舞蹈类型思考
                'teacher_state'=>3,
            ];
            $user_teacher_insert = Db::name('user_teacher')->insertGetId($insert);
            $application_status = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_insert)->where('user_id',$user_find['user']['user_id'])->where('teacher_state',3)->find();
            if ($application_status) {
                return returnJson(1,'提交成功');//正常,'',收藏信息
            }
                return returnJson(0,'教师服务器正忙。。。');//正常,'',收藏信息
        }
        if ($status_upgrade['enter_type'] == 2) {
            $prevent_repetition_organization = Db::name('organization')->where('user_id',$user_find['user']['user_id'])->find();
            // var_dump($prevent_repetition_organization);exit();
            if ($prevent_repetition_organization['organization_state'] == 1) {
                return returnJson(1,'您已经是教师');
            }
            if ($prevent_repetition_organization['organization_state'] == 2) {
                return returnJson(1,'您的机构已经被封停');
            }
            if ($prevent_repetition_organization['organization_state'] == 3) {
                return returnJson(1,'1正在审核。。。');
            }
            if ($prevent_repetition_organization['organization_state'] == 4) {
                return returnJson(1,'申请失败');
            }
        }
        if ($status_upgrade['enter_type'] == 2) {//当enter_type为2是入驻成为机构

            // $info = $organization_portrait->move(ROOT_PATH . 'public' . DS . 'uploads');
            // $save_portrait = $info->getSaveName();
            // $cover = $organization_cover->move(ROOT_PATH . 'public' . DS . 'uploads');
            // $organization_cover = $cover->getSaveName();
            $insert = [
                'user_id'=>$user_find['user']['user_id'],
                'organization_portrait'=>$status_upgrade['organization_portrait'],
                'organization_cover'=>$status_upgrade['organization_cover'],
                'organization_name'=>$status_upgrade['organization_name'],
                'organization_site'=>$status_upgrade['organization_site'],
                'organization_facility'=>$status_upgrade['organization_facility'],
                'organization_business_hours'=>$status_upgrade['organization_business_hours'],
                'organization_synopsis'=>$status_upgrade['organization_synopsis'],
                'organization_type'=>$status_upgrade['organization_type'],
                'organization_service'=>$status_upgrade['organization_service'],
                'promotional_video'=>$status_upgrade['promotional_video'],
                'promotional_cover'=>$status_upgrade['promotional_cover'],
                'organization_state'=>3,
                'organization_level'=>3,
            ];
            $organization_insert = Db::name('organization')->insert($insert);
            if ($organization_insert == 1) {
                return returnJson(1,'提交成功');//正常,'',收藏信息
            }
                return returnJson(1,'机构服务器正忙。。。');//正常,'',收藏信息
        }
    }

    public function user_videos(){//3.08.01会员中心-我的视频
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
        $user_videos['user_data'] = Db::name('user')->where('user_id',$user_find['user_id'])->field('user_name,user_sex,user_signature,user_portrait')->find();
        $user_videos['videos'] = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('c.user_id',$user_find['user_id'])->field('a.file_id,d.dance_type_name,a.file_cover,a.file_name,a.file_collection,a.file_type,c.user_name,c.user_portrait')->where('file_category',1)->where('file_state',1)->where('file_false_delete',1)->order('a.file_creattime desc')->select();

        return returnJson(1,'',$user_videos);//正常,'',收藏信息
    }

    public function user_videos_delete(){//3.08.01会员中心-删除我的作品
        $file_data = input('post.');

        if (empty($file_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$file_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $file_verify = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('a.file_id',$file_data['file_id'])->find();
        if ($user_find['user_id'] == $file_verify['user_id']) {
            $file_update = Db::name('file')->where('file_id',$file_data['file_id'])->update([
                'file_false_delete'=>2,
            ]);
            if ($file_update == 1) {
                return returnJson(1,'删除成功!');
            }
            if ($file_update == 0) {
                return returnJson(1,'已删除!');
            }else{
                return returnJson(0,'删除失败!');
            }
        }else{
            return returnJson(0,'非法操作！');
        }
    }

    public function user_videos_details(){//3.08.01会员中心-我的视频
        $user_videos_details = input('post.');

        if (empty($user_videos_details['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$user_videos_details['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        // $user_videos_details['user_data'] = Db::name('user')->where('user_id',$user_find['user_id'])->field('user_name,user_sex,user_signature,user_role')->find();
        // 
        
        $user_videos_details['videos'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('a.file_id',$user_videos_details['file_id'])->field('file_id,dance_type_name,file_content,file_name,file_collection')->order('a.file_creattime desc')->where('file_state',1)->where('file_false_delete',1)->find();


        $user_videos_details['comments'] = Db::name('comments')->alias('a')->join('user b','a.user_id = b.user_id','left')->where('a.file_id',$user_videos_details['file_id'])->field('a.comments_content,b.user_name,b.user_portrait,a.comments_creattime')->order('a.comments_creattime desc')->select();
        return returnJson(1,'',$user_videos_details);//正常,'',收藏信息
    }

    public function user_videos_comments(){//3.08.02会员中心-我的视频-查看视频-发送评论
        $user_videos_comments = input('post.');

        if (empty($user_videos_comments['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$user_videos_comments['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $insert = [
            'user_id'=>$user_find['user_id'],
            'file_id'=>$user_videos_comments['file_id'],
            'comments_content'=>$user_videos_comments['comments_content'],
            'comments_creattime'=>time(),
        ];
        $comments_insert = Db::name('comments')->insert($insert);
        if ($comments_insert == 1) {
            return returnJson(1,'发送成功!');
        }
    }

    public function user_attention_teacher(){//3.09.01会员中心-我的关注-关注教师
        $user_attention_teacher = input('post.');

        if (empty($user_attention_teacher['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$user_attention_teacher['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        
        $attention_teacher_select = Db::name('attention')->alias('a')->join('user_teacher b','a.fid = b.user_teacher_id','left')->where('uid',$user_find['user_id'])->where('attention_identity',1)->field('attention_id,user_teacher_id,teacher_portrait,teacher_name,teacher_master,teacher_level,teacher_intro')->select();
            return returnJson(1,'1',$attention_teacher_select);
    }

    public function cancel_attention_teacher(){//3.09.02会员中心-我的关注-取消关注教师
        $cancel_data = input('post.');

        if (empty($cancel_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$cancel_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        
        $cancel_attention_teacher = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$cancel_data['user_teacher_id'])->where('attention_identity',1)->delete();
        if ($cancel_attention_teacher == 1) {
            return returnJson(1,'取消成功!');
        }
        if ($cancel_attention_teacher == 0) {
            return returnJson(1,'取消成功!');
        }
    }

    public function user_attention_organization(){//3.09.04会员中心-我的关注-关注的机构（OK）
        $user_attention_organization = input('post.');

        if (empty($user_attention_organization['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$user_attention_organization['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        
        $attention_organization_select = Db::name('attention')->alias('a')->join('organization b','a.fid = b.organization_id','left')->where('uid',$user_find['user_id'])->where('attention_identity',2)->field('attention_id,organization_id,organization_name,organization_cover,organization_site,organization_type,organization_level')->select();
            return returnJson(1,'1',$attention_organization_select);

    }

    public function cancel_attention_organization(){//3.09.05会员中心-我的关注-取消关注机构
        $cancel_organization_data = input('post.');

        if (empty($cancel_organization_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$cancel_organization_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $cancel_organization_delete = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$cancel_organization_data['organization_id'])->where('attention_identity',2)->delete();
        if ($cancel_organization_delete == 1) {
            return returnJson(1,'取消成功');
        }
        if ($cancel_organization_delete == 0) {
            return returnJson(1,'取消成功');
        }
        return returnJson(0,'关注服务器正忙。。。');
    }

    public function user_teacher_affirm_edit(){//3.13.02会员中心-老师中心-老师信息-确认修改
        $affirm_edit_data = input('post.');
        // $teacher_portrait = request()->file('teacher_portrait');
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
        $user_teacher = user_teacher_find($user_find['user_id']);
            // $info = $teacher_portrait->move(ROOT_PATH . 'public' . DS . 'uploads');
            // $save_portrait = $info->getSaveName();
            $affirm_edit = Db::name('user_teacher')->update([
                'teacher_portrait'=>$affirm_edit_data['teacher_portrait'],
                'teacher_name'=>$affirm_edit_data['teacher_name'],
                'teacher_intro'=>$affirm_edit_data['teacher_intro'],
                'teacher_master'=>$affirm_edit_data['teacher_master'],
                'teacher_site'=>$affirm_edit_data['teacher_site'],
                'teacher_phone'=>$affirm_edit_data['teacher_phone'],
                'schooltime'=>$affirm_edit_data['schooltime'],
                'user_teacher_id'=>$user_teacher['user_teacher_id'],
                'teacher_video_cover'=>$affirm_edit_data['teacher_video_cover'],
                'teacher_video'=>$affirm_edit_data['teacher_video'],
            ]);
            if ($affirm_edit == 1) {
                JM_update_information($user_find['user_phone'],$affirm_edit_data['teacher_name'],$affirm_edit_data['teacher_portrait']);
                $curriculum_select = Db::name('curriculum')->where('id',$user_teacher['user_teacher_id'])->where('curriculum_identity_type',1)->select();
                foreach ($curriculum_select as $k => $v) {
                    $curriculum_photo = Db::name('curriculum')->where('curriculum_id',$v['curriculum_id'])->update([
                        'curriculum_photo'=>$affirm_edit_data['teacher_portrait'],
                    ]);
                }
                return returnJson(1,'修改成功');//修改成功
            }
            if ($affirm_edit == 0) {
                return returnJson(1,'未修改');//修改成功
            }
    }



    public function organization_information_edit(){//3.20.02会员中心-机构中心-机构信息-确认修改
        $cancel_organization_data = input('post.');

        if (empty($cancel_organization_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$cancel_organization_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $cancel_organization_delete = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$cancel_organization_data['organization_id'])->where('attention_identity',2)->delete();
        if ($cancel_organization_delete == 1) {
            return returnJson(1,'取消成功');
        }
        return returnJson(0,'关注服务器正忙。。。');
    }

    public function user_organization_find(){//3.20.01会员中心-机构中心-机构信息

        $user_token = input('user_token');//接受区域id

        if (empty($user_token)) {
            return returnJson(0,'会员标识为空...');//人员token
        }

        $user = Db::name('user')->where('user_token',$user_token)->find();//用户信息
        $user_organization = Db::name('organization')->where('user_id',$user['user_id'])->find();//用户机构信息

        if (!$organization_find['basic'] = Db::name('organization')->where('organization_state',1)->where('organization_false_delete',1)->where('organization_id',$user_organization['organization_id'])->field('organization_id,organization_name,organization_cover,organization_site,organization_facility,organization_business_hours,organization_level,organization_district_id,organization_synopsis')->find()) {
            return returnJson(0,'机构详情服务器正忙...');//机构详情服务器查询
        }

        if (!$organization_find['video'] = Db::name('organization')->alias('a')->join('file_organization b','a.organization_id = b.organization_id','left')->join('file c','b.file_id = c.file_id','left')->where('c.file_state',1)->where('c.file_false_delete',1)->where('a.organization_id',$organization_find['basic']['organization_id'])->field('c.file_content')->find()) {
            return returnJson(0,'机构视频服务器正忙...');//机构展示视频查询
        }

        if (!$organization_find['invitation'] = Db::name('invitation')->where('invitation_organization_id',$organization_find['basic']['organization_id'])->field('invitation_organization_id,invitation_interview_site,invitation_interview_time,invitation_dance_type,invitation_age_demand,invitation_explain,invitation_organization_picture,invitation_organization_picture2')->find()) {
            return returnJson(0,'机构邀请服务器正忙...');//机构邀请函服务器查询
        }

        if (!$organization_find['curriculum'] = Db::name('organization')->alias('a')->join('organization_curriculum b','a.organization_id = b.organization_id','left')->join('curriculum c','b.curriculum_id = c.curriculum_id','left')->where('a.organization_id',$organization_find['basic']['organization_id'])->where('c.curriculum_show',1)->field('c.curriculum_id,c.curriculum_photo,c.curriculum_name,c.curriculum_admin,c.curriculum_difficulty,c.curriculum_state')->select()) {//查询curriculum表curriculum_show字段
            return returnJson(0,'机构课程服务器正忙...');//机构课程服务器查询
        }
        
        if (!$organization_find['organization_teacher'] = Db::name('organization_teacher')->where('organization_id',$organization_find['basic']['organization_id'])->where('teacher_show',1)->field('organization_teacher_id,organization_id,teacher_photo,teacher_name,teacher_level,teacher_master,teacher_intro')->select()) {
            return returnJson(0,'机构教师服务器正忙...');//机构教师服务器查询
        }
        // if (!empty($district_data['user_token'])) {
        //     $user_id = Db::name('user')->where('user_token',$district_data['user_token'])->field('user_id')->find();
        //     $organization_find['unread'] = Db::name('chat')->where('chat_fid',$user_id['user_id'])->where('chat_state',2)->count();
        //     return returnJson(1,'',$organization_find);//正常,'',机构列表
        // }
        return returnJson(1,'',$organization_find);//正常,'',机构列表
    }

    public function organization_send_videos(){//3.17.01会员中心-机构中心-发送视频
        $parm = input('post.');
        // $file_cover = request()->file('file_cover');
        // $file_content = request()->file('file_content');
        if (empty($parm)) {
            return returnJson(0,'文件为空...');
        }

        $user = Db::name('user')->where('user_token',$parm['user_token'])->find();//用户信息
        $user_organization = Db::name('organization')->where('user_id',$user['user_id'])->find();//用户机构信息

        // $file_cover = $file_cover->move(ROOT_PATH . 'public' . DS . 'uploads');
        //     $videos_data['file_cover'] = $file_cover->getSaveName();
        // $file_content = $file_content->move(ROOT_PATH . 'public' . DS . 'uploads');
        //     $videos_data['file_content'] = $file_content->getSaveName();
        if ($parm['file_type'] == 3) {
            $parm['file_cover'] = $parm['file_content'];
        }
        $insert = [
            'file_cover'=>$parm['file_cover'],
            'file_content'=>$parm['file_content'],
            'file_type'=>$parm['file_type'],
            'file_category'=>3,
            'file_state'=>1,
            'file_false_delete'=>1,
            'file_collection'=>0,
            'file_name'=>$parm['file_name'],
            'dance_type_id'=>$parm['dance_type_id'],
            'district_id'=>$parm['district_id'],
            'file_creattime'=>time(),
        ];
        $upload_videos = Db::name('file')->insertGetId($insert);
        $file_organization_data = [
            'organization_id'=>$user_organization['organization_id'],
            'file_id'=>$upload_videos,
        ];
        $file_organizationx = Db::name('file_organization')->insert($file_organization_data);
            if ($file_organizationx !== 1) {
                return returnJson(0,'视频服务器正忙。。。');//正常,'',用户信息
        };
        return returnJson(1,'添加成功');//正常,'',机构列表
    }

    public function user_teacher_send_video(){//3.10.01会员中心-老师中心-发送视频(未完)
        $parm = input('post.');
        $user = user($parm['user_token']);
        // var_dump($user);
        $user_teacher = user_teacher_find($user['user_id']);
        // var_dump($user_teacher);exit();
        if ($parm['file_type'] == 3) {
            $parm['file_cover'] = $parm['file_content'];
        }
        $video_data = [
            'district_id'=>$parm['district_id'],
            'dance_type_id'=>$parm['dance_type_id'],
            'file_cover'=>$parm['file_cover'],
            'file_content'=>$parm['file_content'],
            'file_name'=>$parm['file_name'],
            'file_creattime'=>time(),
            'file_collection'=>0,
            'file_type'=>$parm['file_type'],
            'file_category'=>2,
        ];
        $video_insert = Db::name('file')->insertGetId($video_data);
        $file_user_teacher = Db::name('file_user_teacher')->insert([
                'user_teacher_id'=>$user_teacher['user_teacher_id'],
                'file_id'=>$video_insert,
            ]);
        if ($file_user_teacher == 1) {
           return returnJson(1,'添加成功');
        }
    }

    public function user_kkk(){
        $jmphone = input('jmphone');
        $u = JM_user($jmphone);
        return returnJson(1,'',$u);
    }

    public function JM_blacklist(){
        $jmphone = input('jmphone');
        $blacklist = JM_blacklist($jmphone);
        return returnJson(1,'',$blacklist);
    }
}