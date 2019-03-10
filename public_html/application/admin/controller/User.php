<?php
namespace app\admin\controller;
use think\Session;
use think\Db;
class User extends Base{

    public function user_list(){//用户列表
        $seek = input('seek');
        $user_list = Db::name('user')->where('user_false_delete',1)->where('user_name|user_phone','like','%'.$seek.'%')->paginate(25);
        $this->assign('seek',$seek);
        $this->assign('user_list',$user_list);
        return view();
    }

    public function user_edit_show(){//用户修改页面
        $user_id = input('user_id');
        $user_find = Db::name('user')->where('user_id',$user_id)->find();
        $this->assign('user_find',$user_find);
        return view();
    }

    public function user_details(){//详情
        $user_id = input('user_id');
        $user_find = Db::name('user')->where('user_id',$user_id)->find();

        if ($user_find['user_role'] == 2) {
            $user_fans = Db::name('attention')->where('fid',$user_id)->where('attention_identity',1)->count();
        }elseif ($user_find['user_role'] == 3) {
           $user_fans = Db::name('attention')->where('fid',$user_id)->where('attention_identity',2)->count();
        }else{
            $user_fans = 0;
        }

        // $user_file = Db::name('user')->alias('a')->join('file_user b','a.user_id = b.user_id','left')->join('file c','b.file_id = c.file_id','left')->where('a.user_id',$user_id)->order('file_creattime desc')->select();
        // $user_file = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user_id)->order('file_creattime desc')->limit(3)->select();
        $user_file_number = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user_id)->order('file_creattime desc')->count();
        $user_attention = Db::name('attention')->where('uid',$user_id)->count();
        $user_file = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user_id)->limit(15)->order('a.file_creattime desc')->field('a.file_creattime,c.user_name,a.file_name,c.user_portrait,c.user_id')->where('file_false_delete',1)->select();
        // var_dump($user_file);
        $this->assign('user_id',$user_id);
        $this->assign('user_file',$user_file);
        $this->assign('user_find',$user_find);
        $this->assign('user_file_number',$user_file_number);
        $this->assign('user_attention',$user_attention);
        $this->assign('user_fans',$user_fans);
        return view();
    }

    public function user_file_select(){//用户视频查询
        $user_id = input('user_id');
        // $seek = input('seek');
        // if ($seek == null) {
        //     $seek = '';
        // }
        // $seek_where['file_name'] = ['like','%'.$seek.'%'];
        // $user = user($user_id);
        $user_file_select = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user_id)->where('a.file_false_delete',1)->paginate(25);
        // var_dump($user_file_select);
        $this->assign('user_file_select',$user_file_select);
        // $this->assign('seek',$seek);
        $this->assign('user_id',$user_id);
        // $this->assign('user',$user);
        return view();
    }

    public function user_file_details(){//用户文件详情
        $user_id = input('user_id');
        $file_id = input('file_id');
        $user_file_select = Db::name('file')->alias('a')->join('file_user b','a.file_id = b.file_id','left')->join('user c','b.user_id = c.user_id','left')->where('c.user_id',$user_id)->where('a.file_id',$file_id)->where('a.file_false_delete',1)->find();
        $this->assign('videos_find',$user_file_select);
        $this->assign('user_id',$user_id);
        $this->assign('file_id',$file_id);
        return view();
    }

    public function user_file_judge(){//文件判断分配
        $file_id = input('file_id');
        $user_teacher_id = input('user_teacher_id');
        $file_type = input('file_type');

            $file = user_file_details($file_id,$user_teacher_id,$file_type);
            $this->assign('videos_find',$file);
            if ($file_type == 1 || $file_type == 2) {
                // var_dump($file);
                return view('file/user_file_judge_video');
            }
            if ($file_type == 3) {
                return view('file/user_file_pic_details');
            }
}
    public function file_closure(){//用户文件封停
        $file_id = input('file_id');
        $user_id = input('user_id');
        $user_file_closure = file_closure($file_id);
        if ($user_file_closure == 1) {
        return $this->success('封停成功',url('user/user_file_select',['user_id'=>$user_id]),2);
        }
        if ($user_file_closure == 0) {
            return $this->success('未改变',url('user/user_file_select',['user_id'=>$user_id]),2);
        }else{
            return $this->error('封停失败，服务器正忙',url('user/user_file_select',['user_id'=>$user_id]),2);
        }
        return view();
    }
}