<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class Index extends Controller{//首页控制器
    
	public function index(){//1.01乐舞首页

        $index_data = input('post.');
        
        if ($index_data['district_id'] == '' || $index_data['district_id'] == null) {//区域id
            $district = Db::name('district')->where('district_status',1)->order('district_creattime','desc')->field('district_id')->find();//查询地区id的第一条
            $index_data['district_id'] = $district['district_id'];//查询后的区域id赋值给$index_data['district_id']
        }
        if ($index_data['dance_type_id'] == '' || $index_data['dance_type_id'] == null) {//类别id
            $dance_type = Db::name('dance_type')->where('dance_type_status',1)->order('district_creattime','desc')->field('dance_type_id')->find();//查询类别id的第一条
            $index_data['dance_type_id'] = $dance_type['dance_type_id'];
        }
        if ($index_data['order'] == '' || $index_data['order'] == null) {//按类型排序
            $index_data['order'] = 1;
        }
        if ($index_data['order'] == 1) {
            $order = 'file_creattime asc';//时间正序
        }
        if ($index_data['order'] == 2) {
            $order = 'file_creattime desc';//时间倒序
        }
        if ($index_data['order'] == 3) {
            $order = 'file_collection desc';//收藏倒序
        }
        if (!$home_page['current_region'] = Db::name('district')->where('district_status',1)->where('district_id',$index_data['district_id'])->field('district_id,district_name')->find()) {
            return returnJson(0,'区域服务器正忙...');//当前区域类型
        }
        if (!$home_page['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select()) {
            return returnJson(0,'舞蹈服务器正忙...');//舞蹈类型
        }
        if (!$home_page['banner'] = Db::name('banner')->field('banner_content')->select()) {
            return returnJson(0,'轮播图服务器正忙...');//乐舞首页轮播图
        }
        if (!$home_page['district'] = Db::name('district')->where('district_status',1)->field('district_id,district_name')->select()) {
            return returnJson(0,'地区服务器正忙...');//地区分类
        }
        if (!$home_page['information'] = Db::name('information')->where('information_area',0)->field('information_content')->find()) {
            return returnJson(0,'广告服务器正忙...');//乐舞首页广告图
        }
        $home_page['video'] = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id','left')->join('yw_organization c','b.organization_id = c.organization_id','left')->join('yw_file_user_teacher d','a.file_id = d.file_id','left')->join('yw_user_teacher e','d.user_teacher_id = e.user_teacher_id','left')->join('yw_file_user f','a.file_id = f.file_id','left')->join('yw_user g','f.user_id = g.user_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,g.user_name,g.user_id,g.user_portrait,a.file_name,a.file_collection,e.teacher_name,e.user_teacher_id,e.teacher_portrait,c.organization_name,c.organization_portrait,c.organization_id')->where('a.district_id',$index_data['district_id'])->where('a.file_false_delete',1)->where('file_name','like','%'.$index_data['seek'].'%')->order($order)->select();

        //添加用户状态判定以添加消息提示
        return returnJson(1,'',$home_page);//(状态码1:正常,提示,返回值)
    }



    public function index_paging(){//1.01乐舞首页-视频分页

        $index_data = input('post.');
        
        if ($index_data['district_id'] == '' || $index_data['district_id'] == null) {//区域id
            $district = Db::name('district')->where('district_status',1)->field('district_id')->find();//查询地区id的第一条
            $index_data['district_id'] = $district['district_id'];//查询后的区域id赋值给$index_data['district_id']
        }
        if ($index_data['dance_type_id'] == '' || $index_data['dance_type_id'] == null) {//类别id
            $dance_type = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id')->find();//查询类别id的第一条
            $index_data['dance_type_id'] = $dance_type['dance_type_id'];
        }
        if ($index_data['order'] == '' || $index_data['order'] == null) {//按类型排序
            $index_data['order'] = 1;
        }
        if ($index_data['order'] == 1) {
            $order = 'file_creattime desc';//时间倒序
        }
        if ($index_data['order'] == 2) {
            $order = 'file_collection desc';//收藏倒序
        }

        if (empty($attention_teacher['paging'])) {
            $attention_teacher['paging'] = 1;
        }
        $limit = 10;
        $paging = ($index_data['paging']-1)*$limit;

        $home_page['video'] = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id','left')->join('yw_organization c','b.organization_id = c.organization_id','left')->join('yw_file_user_teacher d','a.file_id = d.file_id','left')->join('yw_user_teacher e','d.user_teacher_id = e.user_teacher_id','left')->join('yw_file_user f','a.file_id = f.file_id','left')->join('yw_user g','f.user_id = g.user_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,g.user_name,g.user_id,g.user_portrait,a.file_name,a.file_collection,e.teacher_name,e.user_teacher_id,e.teacher_portrait,c.organization_name,c.organization_portrait,c.organization_id')->where('a.district_id',$index_data['district_id'])->where('a.file_false_delete',1)->where('file_name','like','%'.$index_data['seek'].'%')->order($order)->limit($paging,$limit)->select();







        // if (!$home_page['video'] = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id','left')->join('yw_organization c','b.organization_id = c.organization_id','left')->join('yw_file_user_teacher d','a.file_id = d.file_id','left')->join('yw_user_teacher e','d.user_teacher_id = e.user_teacher_id','left')->join('yw_file_user f','a.file_id = f.file_id','left')->join('yw_user g','f.user_id = g.user_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,g.user_name,g.user_id,g.user_portrait,a.file_name,a.file_collection,e.teacher_name,e.user_teacher_id,e.teacher_portrait,c.organization_name,c.organization_portrait,c.organization_id')->where('a.district_id',$index_data['district_id'])->where('a.file_false_delete',1)->limit($paging,$limit)->where('file_name','like','%'.$index_data['seek'].'%')->order($order)->select()) {//！！！！添加分页
        //     // return returnJson(0,'视频服务器正忙...');//乐舞首页精彩视频(用户教师)
        // }

        //添加用户状态判定以添加消息提示
        return returnJson(1,'',$home_page);//(状态码1:正常,提示,返回值)
    }


    public function index_area(){//1.01乐舞首页

        $index_data = input('post.');
        
        if ($index_data['district_id'] == '' || $index_data['district_id'] == null) {//区域id
            $district = Db::name('district')->where('district_status',1)->field('district_id')->find();//查询地区id的第一条
            $index_data['district_id'] = $district['district_id'];//查询后的区域id赋值给$index_data['district_id']
        }
        if ($index_data['dance_type_id'] == '' || $index_data['dance_type_id'] == null) {//类别id
            $dance_type = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id')->find();//查询类别id的第一条
            $index_data['dance_type_id'] = $dance_type['dance_type_id'];
        }
        if ($index_data['order'] == '' || $index_data['order'] == null) {//按类型排序
            $index_data['order'] = 1;
        }
        if ($index_data['order'] == 1) {
            $order = 'file_creattime desc';//时间倒序
        }
        if ($index_data['order'] == 2) {
            $order = 'file_collection desc';//收藏倒序
        }
        if (!$home_page['current_region'] = Db::name('district')->where('district_status',1)->where('district_id',$index_data['district_id'])->field('district_id,district_name')->find()) {
            return returnJson(0,'区域服务器正忙...');//当前区域类型
        }
        if (!$home_page['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select()) {
            return returnJson(0,'舞蹈服务器正忙...');//舞蹈类型
        }
        if (!$home_page['banner'] = Db::name('banner')->field('banner_content')->select()) {
            return returnJson(0,'轮播图服务器正忙...');//乐舞首页轮播图
        }
        if (!$home_page['district'] = Db::name('district')->where('district_status',1)->field('district_id,district_name')->select()) {
            return returnJson(0,'地区服务器正忙...');//地区分类
        }
        if (!$home_page['information'] = Db::name('information')->where('information_area',0)->field('information_content')->find()) {
            return returnJson(0,'广告服务器正忙...');//乐舞首页广告图
        }
        if (!$home_page['video'] = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id','left')->join('yw_organization c','b.organization_id = c.organization_id','left')->join('yw_file_user_teacher d','a.file_id = d.file_id','left')->join('yw_user_teacher e','d.user_teacher_id = e.user_teacher_id','left')->join('yw_file_user f','a.file_id = f.file_id','left')->join('yw_user g','f.user_id = g.user_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,g.user_name,g.user_id,g.user_portrait,a.file_name,a.file_collection,e.teacher_name,e.user_teacher_id,e.teacher_portrait,c.organization_name,c.organization_portrait,c.organization_id')->where('a.district_id',$index_data['district_id'])->where('a.file_false_delete',1)->order($order)->select()) {//！！！！添加分页
            return returnJson(0,'视频服务器正忙...');//乐舞首页精彩视频(用户教师)
        }

        //添加用户状态判定以添加消息提示
        return returnJson(1,'',$home_page);//(状态码1:正常,提示,返回值)
    }

    public function area(){//1.02.01地区搜索
        $district_select = Db::name('district')->where('district_status',1)->field('district_id,district_name')->where('district_status',1)->select();
        return returnJson(1,'',$district_select);
    }

    // public function curriculum_details(){//课程详情
    //     $curriculum_id = input('curriculum_id');
    //     $user_token = input('user_token');
    //     // var_dump($user_token);exit();
    //     if (empty($curriculum_id)) {
    //         return returnJson(0,'非法操作...');//乐舞首页广告图
    //     }
    //     $curriculum['curriculum'] = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('curriculum_state',1)->where('curriculum_id',$curriculum_id)->where('curriculum_false_delete',1)->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_introduce_picture,curriculum_photo,curriculum_details,curriculum_video,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time,dance_type_name,curriculum_buy_number,id,curriculum_identity_type')->find();
    //     if ($curriculum['curriculum'] == null) {
    //         return returnJson(0,'课程状态错误');
    //     }
    //     if ($curriculum['curriculum']['curriculum_identity_type'] == 1) {
    //         $teacher = Db::name('user_teacher')->where('user_teacher_id',1)->find();
    //         // $teacher['jmphone'] = 
    //         $teacher = Db::name('user_teacher')->where('user_teacher_id',$curriculum['curriculum']['id'])->find();
    //         $curriculum['jmphone'] = Db::name('user')->where('user_id',$teacher['user_id'])->field('user_phone')->find();
    //     }
    //     if ($curriculum['curriculum']['curriculum_identity_type'] == 2) {
    //         $user = user($curriculum_data['user_token']);
    //         $collect_inquire = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum_data['curriculum_id'])->find();
    //         if ($collect_inquire == null) {
    //             $curriculum_find['collect_state'] = 2;
    //         }else{
    //             $curriculum_find['collect_state'] = 1;
    //         }
    //         $curriculum_find['curriculum'] = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('a.curriculum_id',$curriculum_data['curriculum_id'])->where('a.id',$curriculum_data['organization_id'])->field('a.curriculum_id,a.curriculum_name,a.curriculum_admin,a.curriculum_introduce_picture,a.curriculum_photo,a.curriculum_details,a.curriculum_video,a.curriculum_actual_price,curriculum_difficulty,curriculum_state,curriculum_false_delete,curriculum_effective,curriculum_start_time,curriculum_over_time,dance_type_name,a.curriculum_buy_number,id')->find();
    //         $organization = Db::name('organization')->where('organization_id',$curriculum_data['organization_id'])->find();
    //         $curriculum_find['curriculum']['organization_service'] = $organization['organization_service'];

    //         $organization = Db::name('organization')->where('organization_id',$curriculum['curriculum']['id'])->find();
    //         $curriculum['jmphone'] = Db::name('user')->where('user_id',$organization['user_id'])->field('user_phone')->find();
    //     }
    //     if ($user_token == null) {
    //         $curriculum['collect_state'] = 2;
    //     }
    //     if ($user_token !== null) {
    //         $user = user($user_token);
    //         $find = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum['curriculum']['curriculum_id'])->find();
    //         if (empty($find)) {
    //             $curriculum['collect_state'] = 2;
    //         }else{
    //             $curriculum['collect_state'] = 1;
    //         }
    //     }
    //     return returnJson(1,'',$curriculum);
    // }
    // 
    public function curriculum_details(){//课程详情
        $user_token = input('user_token');
        $curriculum_id = input('curriculum_id');
        // var_dump($user_token);
        $curriculum_all = Db::name('curriculum')->where('curriculum_id',$curriculum_id)->where('curriculum_false_delete',1)->where('curriculum_state',1)->find();
        $curriculum['curriculum'] = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->where('curriculum_id',$curriculum_id)->where('curriculum_false_delete',1)->where('curriculum_state',1)->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_introduce_picture,curriculum_photo,curriculum_details,curriculum_video,curriculum_actual_price,curriculum_difficulty,curriculum_effective,curriculum_start_time,curriculum_over_time,curriculum_buy_number,dance_type_name')->find();
        // var_dump($curriculum);
        if ($curriculum == null) {
            return returnJson(0,'该课程已失效');
        }
        if ($curriculum_all['curriculum_identity_type'] == 1) {
            $teacher = teacher($curriculum_all['id']);
            $user = user_id($teacher['user_id']);
            $curriculum['jmphone'] = $user['user_phone'];
            $user = user($user_token);
            $collect = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum['curriculum']['curriculum_id'])->find();
        if ($collect == null) {
            $curriculum['curriculum']['collect_state'] = 2;
            }
        if ($collect !== null) {
            $curriculum['curriculum']['collect_state'] = 1;
            }
        }
        if ($curriculum_all['curriculum_identity_type'] == 2) {
            $organization = user_organization($curriculum_all['id']);
            // var_dump($organization);exit();
            $user = user_id($organization['user_id']);
            $curriculum['curriculum']['jmphone'] = $user['user_phone'];
            $user = user($user_token);
            $collect = Db::name('collect_curriculum')->where('user_id',$user['user_id'])->where('curriculum_id',$curriculum['curriculum']['curriculum_id'])->find();
            if ($collect == null) {
            $curriculum['curriculum']['collect_state'] = 2;
            }
        if ($collect !== null) {
            $curriculum['curriculum']['collect_state'] = 1;
            }
        }

        return returnJson(1,'',$curriculum);
    }

    public function courses(){//1.07.01全部课程(未完待续)
        $seek = input('post.');
        
        if (empty($seek['paging'])) {
            $seek['paging'] = 1;
        }

        if (!$courses_select['information'] = Db::name('information')->where('information_area',0)->field('information_content')->find()) {
            return returnJson(0,'广告服务器正忙...');//乐舞首页广告图
        }
        return returnJson(1,'',$courses_select);
    }

    public function all_courses(){//1.07.01全部课程(未完待续)
        $seek = input('post.');
        
        if (empty($seek['paging'])) {
            $seek['paging'] = 1;
        }
        $limit = 10;
        $paging = ($seek['paging']-1)*$limit;
        $time = strtotime($seek['time']);
        $courses_select['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();
        $courses_select['curriculum'] = Db::name('curriculum')->field('curriculum_id,curriculum_admin,curriculum_name,curriculum_photo,curriculum_actual_price,curriculum_difficulty,curriculum_start_time,curriculum_over_time,curriculum_identity_type,curriculum_effective')->where('curriculum_state',1)->where('curriculum_false_delete',1)->where('curriculum_name','like','%'.$seek['seek'].'%')->where('curriculum_start_time','>=',$time)->where('dance_type_id',$seek['dance_type_id'])->order('curriculum_start_time desc')->limit($paging,$limit)->select();
        return returnJson(1,'',$courses_select);
    }


    public function splendid_video(){//1.08.01精彩视频

        $seek_video = input('post.');//需要:$index_data['district_id']区域id,$index_data['dance_type_id']种类id,$index_data['dance_type_id']种类排序,$index_data['dance_type_id']收藏时间排序;

        $seek = $seek_video['seek'];///搜索内容

        if ($seek_video['district_id'] == '') {//地区id
            $seek_video['district_id'] == 1;
        }
        if ($seek_video['dance_type_id'] == '') {//舞种类型
            $seek_video['dance_type_id'] == 1;
        }
        if ($seek_video['file_category'] == '') {//角色身份1:教师2:机构3:全部4：个人
            $seek_video['file_category'] == 3;
        }
        if ($seek_video['order'] == '' || $seek_video['order'] == null) {//按类型排序
            $seek_video['order'] = 1;
        }
        if ($seek_video['order'] == 1) {
            $order = 'file_creattime desc';//时间倒序
        }
        if ($seek_video['order'] == 2) {
            $order = 'file_creattime';//收藏倒序
        }
        if ($seek_video['order'] == 3) {
            $order = 'file_collection desc';
        }

        if ($seek_video['file_category'] == 1) {//查询教师(user_teacher)类型文件视频
            // $seek_video['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();
            // $seek_video = Db::name('file')->alias('a')->join('yw_file_user_teacher d','a.file_id = d.file_id','left')->join('yw_user_teacher e','d.user_teacher_id = e.user_teacher_id','left')->join('yw_file_user f','a.file_id = f.file_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,a.file_name,a.file_collection,e.teacher_name,e.user_teacher_id,e.teacher_portrait')->where('file_category',1)->where('a.district_id',$seek_video['district_id'])->where('dance_type_id',$seek_video['dance_type_id'])->where('a.file_false_delete',1)->where('a.file_name','like','%'.$seek.'%')->order($order)->select();
            // return returnJson(1,'',$seek_video);//(状态码1:正常,提示,返回值)
            $file = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('a.file_category',1)->find();
            var_dump($file);exit();



        }

        if ($seek_video['file_category'] == 2) {//查询机构(organization)类型文件视频
            $seek_video['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();
            $seek_video = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id','left')->join('yw_organization c','b.organization_id = c.organization_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,a.file_name,a.file_collection,c.organization_name,c.organization_portrait,c.organization_id')->where('file_category',2)->where('a.district_id',$seek_video['district_id'])->where('dance_type_id',$seek_video['dance_type_id'])->where('a.file_false_delete',1)->where('a.file_name','like','%'.$seek.'%')->order($order)->select();
            return returnJson(1,'',$seek_video);//(状态码1:正常,提示,返回值);
        }

        if ($seek_video['file_category'] == 3) {//查询全部(file)类型文件视频
            $seek_video = Db::name('file')->alias('a')->join('yw_file_organization b','a.file_id = b.file_id','left')->join('yw_organization c','b.organization_id = c.organization_id','left')->join('yw_file_user_teacher d','a.file_id = d.file_id','left')->join('yw_user_teacher e','d.user_teacher_id = e.user_teacher_id','left')->join('yw_file_user f','a.file_id = f.file_id','left')->join('yw_user g','f.user_id = g.user_id','left')->field('a.file_id as file_id,a.file_cover,a.file_category,g.user_name,g.user_id,g.user_portrait,a.file_name,a.file_collection,e.teacher_name,e.user_teacher_id,e.teacher_portrait,c.organization_name,c.organization_portrait,c.organization_id')->where('a.district_id',$seek_video['district_id'])->where('a.file_false_delete',1)->where('file_name','like','%'.$seek_video['seek'].'%')->order($order)->select();


            return returnJson(1,'',$seek_video);//(状态码1:正常,提示,返回值);
        }

        if ($seek_video['file_category'] == 4) {//查询个人(user_teacher)类型文件视频
            $seek_video['dance_type'] = Db::name('dance_type')->where('dance_type_status',1)->field('dance_type_id,dance_type_name')->select();
            $seek_video = Db::name('file')->alias('a')->join('yw_file_user b','a.file_id = b.file_id','left')->join('yw_user c','b.user_id = c.user_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('file_category',4)->where('a.district_id',$seek_video['district_id'])->where('a.dance_type_id',$seek_video['dance_type_id'])->where('a.file_false_delete',1)->where('a.file_name','like','%'.$seek.'%')->order($order)->field('a.file_id,dance_type_name,file_cover,file_name,file_collection,c.user_id,user_name,user_portrait')->select();
            return returnJson(1,'',$seek_video);//(状态码1:正常,提示,返回值)
        }
    }


    public function play_video(){//1.08.02视频播放
        $play_video = input('post.');
        $video_information['video'] = Db::name('file')->alias('a')->join('comments b','a.file_id = b.file_id','left')->where('a.file_id',$play_video['file_id'])->field('a.file_id file_id,a.file_content,a.file_name')->find();
        $video_information['comments'] = Db::name('comments')->alias('a')->join('user b','a.user_id = b.user_id','left')->where('a.file_id',$play_video['file_id'])->field('b.user_name,b.user_portrait,a.comments_content,a.comments_creattime')->order('a.comments_creattime desc')->select();
        if (!empty($play_video['user_token'])) {
            $user = Db::name('user')->where('user_token',$play_video['user_token'])->find();
            if ($user) {
                $video_information['collect_state'] = Db::name('collect')->where('file_id',$play_video['file_id'])->where('user_id',$user['user_id'])->find();
            }
            if ($video_information['collect_state']) {
                $video_information['collect_state'] = 1;
                return returnJson(1,'',$video_information);//(状态码1:正常,提示,返回值);
            }
        }
        $video_information['collect_state'] = 2;
        return returnJson(1,'',$video_information);//(状态码1:正常,提示,返回值);
    }

    public function platform(){//1.08合作洽谈

        if (!$information = Db::name('information')->where('information_area',1)->field('information_id,information_name,information_content')->select()) {
            return returnJson(0,'平台信息服务器正忙...');//乐舞首页广告图-详情页
        }
        return returnJson(1,'',$information);//(状态码1:正常,提示,返回值)
    }

    public function index_seek(){//1.03.01搜索栏
        $seek_data = input('post.');
        $seek = $seek_data['seek'];
        $district_id = $seek_data['district_id'];

        $seek_select['hot_user_teacher'] = Db::name('user_teacher')->where('teacher_name','like','%'.$seek.'%')->where('teacher_false_delete',1)->where('teacher_state',1)->where('district_id',$district_id)->order('teacher_attention desc')->field('user_teacher_id,teacher_portrait,teacher_name,teacher_attention,teacher_level,teacher_master,teacher_intro')->limit(0,5)->select();//热度前五教师

        $seek_select['hot_organization'] = Db::name('organization')->where('organization_name','like','%'.$seek.'%')->where('organization_false_delete',1)->where('organization_state',1)->where('organization_district_id',$district_id)->order('organization_attention desc')->field('organization_id,organization_name,organization_cover,organization_portrait,organization_type,organization_level,organization_synopsis')->limit(0,5)->select();//热度前五机构


        $seek_select['user_teacher'] = Db::name('user_teacher')->where('teacher_name','like','%'.$seek.'%')->where('teacher_false_delete',1)->where('teacher_state',1)->where('district_id',$district_id)->order('teacher_attention desc')->field('user_teacher_id,teacher_portrait,teacher_name,teacher_attention,teacher_level,teacher_master,teacher_intro')->select();

        $seek_select['organization'] = Db::name('organization')->where('organization_name','like','%'.$seek.'%')->where('organization_false_delete',1)->where('organization_state',1)->where('organization_district_id',$district_id)->order('organization_attention desc')->field('organization_id,organization_name,organization_cover,organization_portrait,organization_type,organization_level,organization_synopsis')->select();

        return returnJson(1,'',$seek_select);//搜索结果
    }

    public function video_collect(){//1.08.03视频播放-收藏
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

    public function video_cancel_collect(){//1.08.04视频播放-取消收藏
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

    public function report_video(){//1.08.05视频播放-举报视频
        $report_data = input('post.');//report_cause，file_id
        $user = Db::name('user')->where('user_token',$report_data['user_token'])->find();
        if ($user == null) {
            return returnJson(-1,'用户未登录');
        }
        $report = Db::name('report')->where('file_id',$report_data['file_id'])->find();
        if ($report) {//如果已被举报，查询有记录的话
            $report_number = Db::name('report')->where('file_id',$report_data['file_id'])->setInc('report_number');
            $report_cause_insert = [
                'report_cause'=>$report_data['report_cause'],
                'report_id'=>$report['report_id'],
                // 'file_state'=>1,
                'report_creattime'=>time(),
            ];
            $report_cause = Db::name('report_cause')->insert($report_cause_insert);
            return returnJson(1,'举报成功');
        }
        //如果没有记录的话
        $report_insert = [
            'file_id'=>$report_data['file_id'],
            'file_state'=>1,
            'reqort_creattime'=>time(),
        ];
        $report_ist = Db::name('report')->insert($report_insert);
        $report_istId = Db::name('report')->getLastInsID();
        $report_cause_insert = [
            'report_cause'=>$report_data['report_cause'],
            'report_id'=>$report_istId,
            'report_creattime'=>time(),
        ];
        $report_cause = Db::name('report_cause')->insert($report_cause_insert);
        return returnJson(1,'举报成功');
    }

    public function upload_image(){
        $upload_data = input('post.');
        $user = user($upload_data['user_token']);
        if (empty($upload_data['file_content'])) {
            return returnJson(0,'非法操作！');
        }
        if (!$user) {
            return returnJson(0,'用户信息异常。。。');
        }
        $data = [
            'district_id'=>$upload_data['district_id'],
            'dance_type_id'=>$upload_data['dance_type_id'],
            'file_cover'=>$upload_data['file_content'],
            'file_content'=>$upload_data['file_content'],
            'file_name'=>$upload_data['file_name'],
            'file_creattime'=>time(),
            'file_collection'=>0,
            'file_type'=>3,
            'file_category'=>1,
            'file_state'=>1,
            'file_false_delete'=>1,
        ];
        $file_insert = Db::name('file')->insertGetId($data);
        $file_user = Db::name('file_user')->insert([
            'user_id'=>$user['user_id'],
            'file_id'=>$file_insert,
        ]);
        if ($file_user == 1) {
            return returnJson(1,'添加成功');
        }
        return returnJson(0,'添加失败');
    }
    public function upload_video(){
        $upload_data = input('post.');
        $user = user($upload_data['user_token']);
        if (empty($upload_data['file_content'])) {
            return returnJson(0,'非法操作！');
        }
        if (!$user) {
            return returnJson(0,'用户信息异常。。。');
        }
        $data = [
            'district_id'=>$upload_data['district_id'],
            'dance_type_id'=>$upload_data['dance_type_id'],
            'file_cover'=>$upload_data['file_cover'],
            'file_content'=>$upload_data['file_content'],
            'file_name'=>$upload_data['file_name'],
            'file_creattime'=>time(),
            'file_collection'=>0,
            'file_type'=>1,
            'file_category'=>1,
            'file_state'=>1,
            'file_false_delete'=>1,
        ];
        $file_insert = Db::name('file')->insertGetId($data);
        $file_user = Db::name('file_user')->insert([
            'user_id'=>$user['user_id'],
            'file_id'=>$file_insert,
        ]);
        if ($file_user == 1) {
            return returnJson(1,'添加成功');
        }
        return returnJson(0,'添加失败');
    }
    public function upload_music(){
        $upload_data = input('post.');
        $user = user($upload_data['user_token']);
        if (empty($upload_data['file_content'])) {
            return returnJson(0,'非法操作！');
        }
        if (!$user) {
            return returnJson(0,'用户信息异常。。。');
        }
        $data = [
            'district_id'=>$upload_data['district_id'],
            'dance_type_id'=>$upload_data['dance_type_id'],
            'file_cover'=>$upload_data['file_cover'],
            'file_content'=>$upload_data['file_content'],
            'file_name'=>$upload_data['file_name'],
            'file_creattime'=>time(),
            'file_collection'=>0,
            'file_type'=>2,
            'file_category'=>1,
            'file_state'=>1,
            'file_false_delete'=>1,
        ];
        $file_insert = Db::name('file')->insertGetId($data);
        $file_user = Db::name('file_user')->insert([
            'user_id'=>$user['user_id'],
            'file_id'=>$file_insert,
        ]);
        if ($file_user == 1) {
            return returnJson(1,'添加成功');
        }
        return returnJson(0,'添加失败');
    }
}