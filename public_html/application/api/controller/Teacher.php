<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;


class Teacher extends Controller{//用户教师控制器
    
    public function teacher_list(){//1.06.01授课老师
        $teacher_seek = input('post.');
        $teacher_list['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();
        $limit = 10;
        $paging = ($teacher_seek['paging']-1)*$limit;
        $teacher_list['teacher'] = Db::name('user_teacher')->where('teacher_false_delete',1)->where('teacher_state',1)->order('teacher_level desc')->where('district_id',$teacher_seek['district_id'])->where('teacher_name','like','%'.$teacher_seek['teacher_seek'].'%')->where('teacher_master','like','%'.$teacher_seek['dance_type_name'].'%')->field('user_teacher_id,user_id,teacher_portrait,teacher_name,teacher_level,teacher_master,teacher_intro')->limit($paging,$limit)->select();
        return returnJson(1,'',$teacher_list);//正常,'',机构列表
    }

    public function teacher_details(){//1.06.02授课老师-详情
        $user_teacher_details = input('post.');
        // if (empty($user_teacher_details['user_token'])) {
        //     return returnJson(-1,'请登录...');//判断登录
        // }

        // if (!$user_find = Db::name('user')->where('user_token',$user_teacher_details['user_token'])->field('user_id,user_name,user_sex
        //     ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
        //     return returnJson(-1,'请登录...');//用户查询
        // }

        // if ($user_find['user_false_delete'] == 2) {
        //     return returnJson(0,'用户不存在...');//用户已被删除
        // }

        // if ($user_find['user_status'] == 2) {
        //     return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        // }
        // $user = user($user_teacher_details['user_token']);
        $teacher_verify = teacher_verify_own($user_teacher_details['user_token'],$user_teacher_details['user_teacher_id']);
        if ($teacher_verify == 1) {
            $teacher_find['attention_state'] = 1;
        }
        if ($teacher_verify == 2) {
            $teacher_find['attention_state'] = 2;
        }
        // $teacher_find['attention_state'] = Db::name('attention')->where('fid',$user_teacher_details['user_teacher_id'])->where('uid',$user_find['user_id'])->where('attention_identity',1)->find();//关注状态如果有记录就代表有返回1没有重新设定为2

        // if ($teacher_find['attention_state']) {
        //     $teacher_find['attention_state'] = 1;
        // }
        // if (!$teacher_find['attention_state']) {
        //     $teacher_find['attention_state'] = 2;
        // }
        // $teacher_find['information'] = Db::name('user_teacher')->alias('a')->join('curriculum_teacher b','a.user_teacher_id = b.user_teacher_id','left')->join('curriculum c','b.curriculum_id = c.curriculum_id','left')->field('a.user_teacher_id,a.teacher_portrait,a.teacher_phone,a.teacher_name,a.schooltime,a.teacher_site,a.teacher_level,a.teacher_master,a.teacher_intro,a.teacher_video,c.curriculum_id,c.curriculum_admin,c.curriculum_name,c.curriculum_actual_price,c.curriculum_difficulty,c.curriculum_start_time,c.curriculum_over_time,c.curriculum_effective')->where('curriculum_state',1)->where('a.user_teacher_id',$user_teacher_details['user_teacher_id'])->order('c.curriculum_collect desc')->limit(2)->select();
        $teacher_find['information'] = Db::name('user_teacher')->alias('a')->join('curriculum_teacher b','a.user_teacher_id = b.user_teacher_id','left')->join('curriculum c','b.curriculum_id = c.curriculum_id','left')->field('a.user_teacher_id,a.teacher_portrait,a.teacher_phone,a.teacher_name,a.schooltime,a.teacher_site,a.teacher_level,a.teacher_master,a.teacher_intro')->where('curriculum_state',1)->where('a.user_teacher_id',$user_teacher_details['user_teacher_id'])->order('c.curriculum_collect desc')->find();


        $teacher_find['curriculum'] = Db::name('user_teacher')->alias('a')->join('curriculum_teacher b','a.user_teacher_id = b.user_teacher_id','left')->join('curriculum c','b.curriculum_id = c.curriculum_id','left')->field('c.curriculum_id,c.curriculum_admin,c.curriculum_name,c.curriculum_actual_price,c.curriculum_difficulty,c.curriculum_start_time,c.curriculum_over_time,c.curriculum_effective')->where('curriculum_state',1)->where('a.user_teacher_id',$user_teacher_details['user_teacher_id'])->order('c.curriculum_collect desc')->limit(2)->select();


        // $teacher_find['teacher_information'] = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_details['user_teacher_id'])->field('user_teacher_id,user_id,teacher_portrait,teacher_phone,teacher_name,schooltime,teacher_site,teacher_master,teacher_level')->find();//教师信息
        $teacher_find['show_video'] = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_details['user_teacher_id'])->field('teacher_video_cover,teacher_video')->find();//视频介绍

        // $teacher_find['teacher_intro'] = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_details['user_teacher_id'])->field('teacher_intro')->find();//文案介绍

        $teacher_find['teacher_video'] = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->join('dance_type e','a.dance_type_id = e.dance_type_id','left')->where('teacher_state',1)->where('teacher_false_delete',1)->where('c.user_teacher_id',$user_teacher_details['user_teacher_id'])->order('file_collection desc')->limit(2)->field('a.file_id,a.file_cover,a.file_name,a.file_collection,c.teacher_portrait,e.dance_type_name,c.teacher_portrait,c.teacher_name')->select();
        return returnJson(1,'',$teacher_find);//正常,'',机构列表
    }

    public function user_teacher_videos_list(){//1.06.03授课老师-详情-老师视频-更多(文档)
        $user_teacher_id = input('user_teacher_id');
        $user_token = input('user_token');
        $user = user($user_token);
        $teacher_find = user_teacher_find($user['user_id']);
        $teacher_list['teacher']['user_teacher_id'] = $teacher_find['user_teacher_id'];
        $teacher_list['teacher']['teacher_sex'] = $user['user_sex'];
        $teacher_list['teacher']['teacher_portrait'] = $teacher_find['teacher_portrait'];
        $teacher_list['teacher']['teacher_name'] = $teacher_find['teacher_name'];
        $teacher_list['teacher']['user_signature'] = $user['user_signature'];

        $teacher_list['file'] = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('c.user_teacher_id',$teacher_find['user_teacher_id'])->where('a.file_type',1)->where('a.file_state',1)->where('a.file_false_delete',1)->field('a.file_id,d.dance_type_name,a.file_cover,a.file_name,a.file_collection,teacher_portrait,d.dance_type_name,a.file_type')->order('a.file_collection desc')->select();
        foreach ($teacher_list['file'] as $k => $v) {
            $teacher_list['file'][$k]['teacher_portrait'] = $teacher_find['teacher_portrait'];
        }
        return returnJson(1,'',$teacher_list);//正常,'',机构列表
    }

    public function teacher_videos_list(){//1.06.03授课老师-详情-老师视频-更多(待验证)
        $user_teacher_id = input('user_teacher_id');
        if (empty($user_teacher_id)) {
            return returnJson(0,'教师身份非法！');
        }
        $user_token = input('user_token');
        $user = user($user_token);
        $teacher_list['file'] = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('c.user_teacher_id',$user_teacher_id)->where('a.file_type',1)->where('a.file_state',1)->where('a.file_false_delete',1)->field('a.file_id,d.dance_type_name,a.file_cover,a.file_name,a.file_collection,teacher_portrait,d.dance_type_name,a.file_type,c.user_teacher_id')->order('a.file_collection desc')->select();
        foreach ($teacher_list['file'] as $k => $v) {
            $teacher = user_teacher($teacher_list['file'][$k]['user_teacher_id']);
            $teacher_list['file'][$k]['teacher_portrait'] = $teacher['teacher_portrait'];
        }
        return returnJson(1,'',$teacher_list);//正常,'',机构列表
    }

    public function play_videos(){//1.06.04授课老师-详情-老师视频-点击播放视频
        $videos_data = input('post.');
        $play_videos['videos'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('comments c','a.file_id = c.file_id','left')->join('user d','c.user_id = d.user_id','left')->where('a.file_id',$videos_data['file_id'])->where('a.file_state',1)->where('a.file_false_delete',1)->field('a.file_id,b.dance_type_name,a.file_content,a.file_name,d.user_name,d.user_portrait,c.comments_content')->order('c.comments_creattime desc')->select();
        if (!empty($play_video['user_token'])) {
            $user = Db::name('user')->where('user_token',$play_video['user_token'])->find();
            if ($user) {
                $video_information['collect_state'] = Db::name('collect')->where('file_id',$play_video['file_id'])->where('user_id',$user['user_id'])->find();
            }
            if ($video_information['collect_state']) {
                $play_videos['collect_state'] = 1;
                return returnJson(1,'',$video_information);//(状态码1:正常,提示,返回值);
            }
        }
        $play_videos['collect_state'] = 2;
        return returnJson(1,'',$play_videos);//正常,'',机构列表
    }

    public function video_collect(){//1.06.05授课老师-详情-老师视频-播放视频-收藏
        $collect_data = input('post.');
        $user_find = Db::name('user')->where('user_token',$collect_data['user_token'])->where('user_status',1)->where('user_false_delete',1)->find();
        if (empty($user_find)) {
            return returnJson(-1,'请登录。。。');//用户搜索
        }
        $video_information = Db::name('collect')->where('file_id',$collect_data['file_id'])->where('user_id',$user_find['user_id'])->find();//查询记录
        if (!$video_information) {
            $insert = [
            'file_id'=>$collect_data['file_id'],
            'user_id'=>$user_find['user_id'],
            'collect_creattime'=>time(),
            ];
            $collect_insert = Db::name('collect')->insert($insert);
            if ($collect_insert !== 1) {
                return returnJson(0,'收藏服务器正忙。。。');//收藏失败
            }
            return returnJson(1,'收藏成功');//收藏结果
        }
        return returnJson(1,'收藏成功');//收藏结果
    }

    public function video_cancel_collect(){//1.06.06授课老师-详情-老师视频-播放视频-取消收藏
        $collect_data = input('post.');
        $user = Db::name('user')->where('user_token',$collect_data['user_token'])->find();
        if (!$user) {
            return returnJson(-1,'用户未登录');
        }
        $video_information = Db::name('collect')->where('file_id',$collect_data['file_id'])->where('user_id',$user['user_id'])->find();//查询记录
        if (!$video_information) {
            return returnJson(1,'取消收藏成功');//收藏结果
        }
        $collect_delete = Db::name('collect')->delete($video_information['collect_id']);
        if ($collect_delete == 1) {
            return returnJson(1,'取消收藏成功');//收藏结果
        }
    }

    // public function curriculum_more(){//1.06.07授课老师-详情-精品课程-更多
    //     $curriculum_data = input('post.');
    //     $curriculum_data['current_date'] = strtotime($curriculum_data['current_date']);
    //     $curriculum_select = Db::name('curriculum')->alias('a')->join('curriculum_teacher b','a.curriculum_id = b.curriculum_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('c.user_teacher_id',$curriculum_data['user_teacher_id'])->order('a.curriculum_collect desc')->where('a.curriculum_start_time','<=',$curriculum_data['current_date'])->where('a.curriculum_over_time','>=',$curriculum_data['current_date'])->whereOr('curriculum_effective',1)->where('a.curriculum_state',1)->field('a.curriculum_id,a.curriculum_admin,a.curriculum_name,a.curriculum_actual_price,a.curriculum_difficulty,a.curriculum_start_time,a.curriculum_over_time')->select();
    //     return returnJson(1,'',$curriculum_select);//精品课程列表
    // }

    public function curriculum_more(){//1.06.07授课老师-详情-精品课程-更多


        $curriculum_data = input('post.');
        $curriculum_data['current_date'] = strtotime($curriculum_data['current_date']);
        $curriculum_select = Db::name('curriculum')->where('curriculum_identity_type',1)->where('id',$curriculum_data['user_teacher_id'])->order('curriculum_collect desc')->where('curriculum_state',1)->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_actual_price,curriculum_difficulty,curriculum_start_time,curriculum_over_time')->select();
        foreach ($curriculum_select as $k => $v) {
            if ($curriculum_select[$k]['curriculum_over_time'] < time()) {

                $curriculum_id = $curriculum_select[$k]['curriculum_id'];
                Db::name('curriculum')->where('curriculum_id',$curriculum_id)->update([
                    'curriculum_state'=>2,
                ]);
            }
        }

        $curriculum_select = Db::name('curriculum')->where('curriculum_identity_type',1)->where('id',$curriculum_data['user_teacher_id'])->order('curriculum_collect desc')->where('curriculum_state',1)->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_actual_price,curriculum_difficulty,curriculum_start_time,curriculum_over_time,curriculum_effective')->select();
        return returnJson(1,'',$curriculum_select);//精品课程列表
    }

    public function curriculum_details(){//1.06.08授课老师-详情-精品课程-课程详情
        $curriculum_details_data = input('post.');
        if (empty($curriculum_details_data['user_token'])) {
            $curriculum_details_find['collect_state'] = 2;
        }else{
            $user = Db::name('user')->where('user_token',$curriculum_details_data['user_token'])->find();
            $collect = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_details_data['curriculum_id'])->find();
            if ($collect == null) {
                $curriculum_details_find['collect_state'] = 2;
            }else{
                $curriculum_details_find['collect_state'] = 1;
            }
        };
        $user_teacher = user_teacher($curriculum_details_data['user_teacher_id']);
        $curriculum_details_data['current_date'] = strtotime($curriculum_details_data['current_date']);
        $curriculum_details_find['curriculum'] = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('curriculum_id',$curriculum_details_data['curriculum_id'])->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_introduce_picture,curriculum_details,curriculum_video,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time,dance_type_name,curriculum_buy_number')->find();

        $curriculum = Db::name('curriculum')->where('curriculum_id',$curriculum_details_data['curriculum_id'])->field('id')->find();


        // var_dump($curriculum_details_find['curriculum']);exit();
        $curriculum_details_find['curriculum']['user_teacher_service'] = $user_teacher['teacher_phone'];
        $teacher = Db::name('user_teacher')->where('user_teacher_id',$curriculum['id'])->find();
            $curriculum_details_find['jmphone'] = Db::name('user')->where('user_id',$teacher['user_id'])->field('user_phone')->find();


        // if ($curriculum_details_find['curriculum']['curriculum_identity_type'] == 1) {
        //     $teacher = Db::name('user_teacher')->where('user_teacher_id',$curriculum_details_find['curriculum']['id'])->find();
        //     $curriculum_details_find['jmphone'] = Db::name('user')->where('user_id',$teacher['user_id'])->field('user_phone')->find();
        // }elseif ($curriculum_details_find['curriculum']['curriculum_identity_type'] == 2) {
        //     $organization = Db::name('organization')->where('organization_id',$curriculum_details_find['curriculum']['id'])->find();
        //     $curriculum_details_find['jmphone'] = Db::name('user')->where('user_id',$organization['user_id'])->field('user_phone')->find();
        // }
        return returnJson(1,'',$curriculum_details_find);//精品课程列表
    }

    public function cancel_attention_teacher_operation(){//1.06.10授课老师-详情-取消关注教师操作
        $cancel_attention_teacher_operation = input('post.');

        if (empty($cancel_attention_teacher_operation['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$cancel_attention_teacher_operation['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $attention_delete = Db::name('attention')->where('uid',$user_find['user_id'])->where('fid',$cancel_attention_teacher_operation['user_teacher_id'])->where('attention_identity',1)->delete();
        if ($attention_delete == 1) {
            return returnJson(1,'取消关注成功');//精品课程列表
        }
        return returnJson(1,'取消关注成功');//精品课程列表
    }

    public function attention_teacher(){//2.01.01关注-关注教师
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

        $attention_insert = [
            'uid'=>$user_find['user_id'],
            'fid'=>$attention_teacher_data['user_teacher_id'],
            'attention_identity'=>1,
            'attention_creattime'=>time(),
        ];
        $attention_insert = Db::name('attention')->insert($attention_insert);
        return returnJson(1,'关注成功!');
    }

    public function teacher_fans(){//3.12.01会员中心-老师中心-我的粉丝(分页待验证)
        $attention_teacher = input('post.');
        if (empty($attention_teacher['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$attention_teacher['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        // var_dump($attention_teacher);exit();
        if ($attention_teacher['request_type'] == '') {
            if ($attention_teacher['number'] == '') {
                $attention_teacher['number'] = 1;
            }
            $limit = 10;
            $number = ($attention_teacher['number']-1)*$limit;
            $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();
            $attention_teacher_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait,user_signature')->where('fid',$user_teacher_find['user_teacher_id'])->where('attention_identity',1)->limit($number,$limit)->select();//查询老师粉丝

            // $attention_teacher_select['videos'] = Db::name('user_teacher')->alias('a')->join('file_user_teacher c','a.user_teacher_id = c.user_teacher_id','left')->join('file d','c.file_id = d.file_id','left')->join('dance_type k','d.dance_type_id = k.dance_type_id','left')->where('d.file_type',1)->where('d.file_state',1)->where('d.file_false_delete',1)->order('d.file_creattime desc')->limit($number,$limit)->field('d.file_id,k.dance_type_name,d.file_cover,d.file_name,d.file_collection,k.dance_type_name,a.teacher_portrait')->select();
            return returnJson(1,'',$attention_teacher_select);//用户账户封停
        }
        if ($attention_teacher['request_type'] == 1) {
            if ($attention_teacher['number'] == '') {
                $attention_teacher['number'] = 1;
            }
            $limit = 10;
            $number = ($attention_teacher['number']-1)*$limit;
            $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();
            $limit = 10;
            $number = ($attention_teacher['number']-1)*$limit;
            $attention_teacher_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait,user_signature')->where('fid',$user_teacher_find['user_teacher_id'])->where('attention_identity',1)->limit($number,$limit)->select();//查询老师粉丝
            return returnJson(1,'',$attention_teacher_select);//用户账户封停
        }
        // if ($attention_teacher['request_type'] == 2) {
        //     if ($attention_teacher['number'] == '') {
        //         $attention_teacher['number'] = 1;
        //     }
        //     $limit = 10;
        //     $number = ($attention_teacher['number']-1)*$limit;
        //     $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();
        //     $limit = 10;
        //     $number = ($attention_teacher['number']-1)*$limit;
        //     $attention_teacher_select['videos'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('file_user_teacher c','a.file_id = c.file_id','left')->join('user_teacher d','c.user_teacher_id = d.user_teacher_id','left')->where('a.file_type',1)->where('a.file_state',1)->where('a.file_false_delete',1)->field('a.file_id,b.dance_type_name,a.file_cover,a.file_name,a.file_collection')->order('a.file_creattime desc')->limit($number,$limit)->select();

        //     $attention_teacher_select['videos'] = Db::name('user_teacher')->alias('a')->join('file_user_teacher c','a.user_teacher_id = c.user_teacher_id','left')->join('file d','c.file_id = d.file_id','left')->join('dance_type k','d.dance_type_id = k.dance_type_id','left')->where('d.file_type',1)->where('d.file_state',1)->where('d.file_false_delete',1)->order('d.file_creattime desc')->limit($number,$limit)->field('d.file_id,k.dance_type_name,d.file_cover,d.file_name,d.file_collection,k.dance_type_name,a.teacher_portrait')->select();
        //     return returnJson(1,'',$attention_teacher_select);//用户账户封停
        // }
        // if (empty($attention_teacher['paging'])) {
        //     $attention_teacher['paging'] = 1;
        // }
        // $limit = 10;
        // $paging = ($attention_teacher['paging']-1)*$limit;
        
        // $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();
        // $attention_teacher_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait')->where('fid',$user_teacher_find['user_teacher_id'])->where('attention_identity',1)->select();//查询老师粉丝

        // $attention_teacher_select['videos'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id')->where('a.file_type',1)->where('a.file_state',1)->where('a.file_false_delete',1)->field('a.file_id,b.dance_type_name,a.file_cover,a.file_name,a.file_collection')->order('a.file_creattime desc')->select();
        // return returnJson(1,'',$attention_teacher_select);//用户账户封停
    }

    // public function teacher_fans_videos(){//3.12.01-1会员中心-老师中心-我的粉丝-下方视频分页
    //     $attention_teacher = input('post.');
    //     if (empty($attention_teacher['user_token'])) {
    //         return returnJson(-1,'请登录...');//判断登录
    //     }

    //     if (!$user_find = Db::name('user')->where('user_token',$attention_teacher['user_token'])->field('user_id,user_name,user_sex
    //         ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
    //         return returnJson(-1,'请登录...');//用户查询
    //     }

    //     if ($user_find['user_false_delete'] == 2) {
    //         return returnJson(0,'用户不存在...');//用户已被删除
    //     }

    //     if ($user_find['user_status'] == 2) {
    //         return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
    //     }
    //     if () {
    //         $limit = 10;
    //         $number = ($attention_teacher['number']-1)*$limit;
    //     }
    //     // if (empty($attention_teacher['number'])) {
    //     //     $attention_teacher['number'] = 1;
    //     // }
    //     $limit = 10;
    //     $number = ($attention_teacher['number']-1)*$limit;
        
    //     $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();
        
    //     $attention_teacher_select['videos'] = Db::name('file')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id')->where('a.file_type',1)->where('a.file_state',1)->where('a.file_false_delete',1)->field('a.file_id,b.dance_type_name,a.file_cover,a.file_name,a.file_collection')->limit($number,$limit)->order('a.file_creattime desc')->select();
    //     return returnJson(1,'',$attention_teacher_select);//用户账户封停
    // }

    // public function teacher_fans_paging(){//3.12.01会员中心-老师中心-我的粉丝(分页待验证)
    //     $attention_teacher = input('post.');
    //     if (empty($attention_teacher['user_token'])) {
    //         return returnJson(-1,'请登录...');//判断登录
    //     }

    //     if (!$user_find = Db::name('user')->where('user_token',$attention_teacher['user_token'])->field('user_id,user_name,user_sex
    //         ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
    //         return returnJson(-1,'请登录...');//用户查询
    //     }

    //     if ($user_find['user_false_delete'] == 2) {
    //         return returnJson(0,'用户不存在...');//用户已被删除
    //     }

    //     if ($user_find['user_status'] == 2) {
    //         return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
    //     }

    //     if (empty($attention_teacher['paging'])) {
    //         $attention_teacher['paging'] = 1;
    //     }
    //     $limit = 10;
    //     $paging = ($attention_teacher['paging']-1)*$limit;
        
    //     $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->find();
    //     $teacher_fans_select['fans'] = Db::name('attention')->alias('a')->join('user b','a.uid = b.user_id','left')->field('b.user_name,b.user_portrait')->where('fid',$user_teacher_find['user_teacher_id'])->where('attention_identity',1)->limit($paging,$limit)->select();//查询老师粉丝
    //     return returnJson(1,'',$teacher_fans_select);//用户账户封停
    // }

    public function teacher_information(){//3.13.01会员中心-老师中心-老师信息
        $teacher_information = input('post.');
        if (empty($teacher_information['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$teacher_information['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        $user_teacher_find = Db::name('user_teacher')->where('user_id',$user_find['user_id'])->field('user_teacher_id,teacher_portrait,teacher_phone,teacher_name,schooltime,teacher_site,teacher_attention,teacher_level,teacher_master,teacher_intro,teacher_video,teacher_video_cover')->where('teacher_state',1)->where('teacher_false_delete',1)->find();
        return returnJson(1,'',$user_teacher_find);//用户账户封停
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
        $curriculum = teacher_curriculum_find($user['user_id']);
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

    // public function teacher_curriculum_list(){//教师课程列表
    //     $user_token = input('user_token');
    //     $user = Db::name('user')->where('user_token',$user_token)->find();  
    //     $curriculum['teacher'] = Db::name('user')->alias('a')->join('user_teacher b','a.user_id = b.user_id','left')->where('a.user_id',$user['user_id'])->field('user_teacher_id,teacher_name,teacher_portrait,user_signature,user_sex,user_role')->find();
    //     $curriculum['curriculum'] = Db::name('curriculum')->alias('a')->join('curriculum_teacher b','a.curriculum_id = b.curriculum_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('c.user_teacher_id',$curriculum['teacher']['user_teacher_id'])->field('a.curriculum_id,curriculum_admin,curriculum_name,curriculum_photo,curriculum_difficulty,curriculum_start_time,curriculum_over_time')->select();
    //     return returnJson(1,'',$curriculum);
    // }

    public function teacher_curriculum_sell_list(){//
        $user_token = input('user_token');
        $user = Db::name('user')->where('user_token',$user_token)->find();

        $teacher = Db::name('user')->alias('a')->join('user_teacher b','a.user_id = b.user_id','left')->where('a.user_id',$user['user_id'])->field('user_teacher_id,teacher_name,teacher_portrait,user_signature,user_sex,user_role')->find();
        // var_dump($teacher['user_teacher_id']);exit();
        // 
        $curriculum['curriculum'] = Db::name('curriculum')->alias('a')->join('user_teacher c','a.id = c.user_teacher_id','left')->where('a.id',$teacher['user_teacher_id'])->field('a.curriculum_id,curriculum_admin,curriculum_name,curriculum_difficulty,a.curriculum_actual_price,curriculum_effective,curriculum_start_time,curriculum_over_time')->where('curriculum_state',1)->where('a.curriculum_identity_type',1)->select();
        // $curriculum['curriculum'] = Db::name('curriculum')->where('id',$teacher['user_teacher_id'])->select();
        // var_dump($curriculum['curriculum']);exit();

        // $curriculum['curriculum']['user_teacher_id'] = $teacher['user_teacher_id'];
        foreach ($curriculum['curriculum'] as $k => $v) {
            $curriculum['curriculum'][$k]['user_teacher_id'] = $teacher['user_teacher_id'];
        }
        return returnJson(1,'',$curriculum);
    }

    public function teacher_curriculum_stop_selling_list(){//下架课程
         $user_token = input('user_token');
        $user = Db::name('user')->where('user_token',$user_token)->find();  
        $teacher = Db::name('user')->alias('a')->join('user_teacher b','a.user_id = b.user_id','left')->where('a.user_id',$user['user_id'])->field('user_teacher_id,teacher_name,teacher_portrait,user_signature,user_sex,user_role')->find();
        $curriculum['curriculum'] = Db::name('curriculum')->alias('a')->join('user_teacher c','a.id = c.user_teacher_id','left')->where('c.user_teacher_id',$teacher['user_teacher_id'])->field('c.user_teacher_id,a.curriculum_actual_price,a.curriculum_id,curriculum_admin,curriculum_name,curriculum_difficulty,curriculum_effective,curriculum_state,curriculum_start_time,curriculum_over_time')->where('curriculum_state',3)->where('a.curriculum_identity_type',1)->select();
        return returnJson(1,'',$curriculum);
    }

    public function teacher_curriculum_add(){//教师课程列表
        $teacher_curriculum_data = input('post.');

        if (empty($teacher_curriculum_data['user_token'])) {
            return returnJson(-1,'请登录...');//判断登录
        }

        if (!$user_find = Db::name('user')->where('user_token',$teacher_curriculum_data['user_token'])->field('user_id,user_name,user_sex
            ,user_role,user_portrait,user_signature,user_token,user_status,user_false_delete')->find()) {
            return returnJson(-1,'请登录...');//用户查询
        }

        if ($user_find['user_false_delete'] == 2) {
            return returnJson(0,'用户不存在...');//用户已被删除
        }

        if ($user_find['user_status'] == 2) {
            return returnJson(0,'当前账户已封停请联系管理员...');//用户账户封停
        }
        if ($user_find['user_role'] !== 2) {
            return returnJson(0,'您不是老师...');//用户账户封停
        }
        $user = user($teacher_curriculum_data['user_token']);
        $user_teacher = user_teacher_find($user['user_id']);
        
        $curriculum_data = [
            'curriculum_admin'=> $teacher_curriculum_data['curriculum_admin'],
            'curriculum_name'=> $teacher_curriculum_data['curriculum_name'],
            'curriculum_introduce_picture'=> $teacher_curriculum_data['curriculum_introduce_picture'],
            'curriculum_details'=> $teacher_curriculum_data['curriculum_details'],
            'curriculum_video'=> $teacher_curriculum_data['curriculum_video'],
            'curriculum_actual_price'=> $teacher_curriculum_data['curriculum_actual_price'],
            'curriculum_difficulty'=> $teacher_curriculum_data['curriculum_difficulty'],
            'curriculum_creattime'=> time(),
            'curriculum_effective'=> $teacher_curriculum_data['curriculum_effective'],
            'curriculum_start_time'=> $teacher_curriculum_data['curriculum_start_time'],
            'curriculum_over_time'=> $teacher_curriculum_data['curriculum_over_time'],
            'dance_type_id'=> $teacher_curriculum_data['dance_type_id'],
            // 'max_people_number'=>$teacher_curriculum_data['max_people_number'],
            'id'=>$user_teacher['user_teacher_id'],
            'curriculum_identity_type'=>1,
            'curriculum_photo'=>$user_teacher['teacher_portrait'],
        ];

        $curriculum_insert = Db::name('curriculum')->insert($curriculum_data);
        if ($curriculum_insert == 1) {
            return returnJson(1,'添加成功');//添加成功
        }
        // $organization_curriculum = Db::name('curriculum_teacher')->insert([
        //         'user_teacher_id'=>$user_teacher['user_teacher_id'],
        //         'curriculum_id'=>$curriculum_insert,
        //     ]);
        // if ($organization_curriculum == 1) {
        //     return returnJson(1,'添加成功');//添加成功
        // }
        return returnJson(0,'添加失败');//添加成功
    }

    public function teacher_file_delete(){//3.01.02老师中心-删除作品
        $user_token = input('user_token');
        $file_id = input('file_id');
        $user = user($user_token);
        $user_teacher = user_teacher_find($user['user_id']);
        $file_find = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('c.user_teacher_id',$user_teacher['user_teacher_id'])->where('a.file_id',$file_id)->where('a.file_state',1)->where('a.file_false_delete',1)->find();
        // var_dump($file_find);exit();
        if ($file_find !== null) {
            $file_update = DB::name('file')->where('file_id',$file_find['file_id'])->update([
                'file_false_delete'=>2,
            ]);
            if ($file_update == 1) {
                return returnJson(1,'删除成功');
            }
        }
        if ($file_find == null) {
            return returnJson(1,'已经删除');
        }
    }
}