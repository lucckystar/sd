<?php
namespace app\admin\controller;
use think\Session;
use think\Db;
class Teacher extends Base{

    public function user_teacher_list(){///教师列表
        $seek = input('seek');
        $teacher_list = Db::name('user_teacher')->alias('a')->join('district b','a.district_id = b.district_id','left')->where('a.teacher_name','like','%'.$seek.'%')->paginate(25);
        $this->assign('teacher_list',$teacher_list);
        $this->assign('seek',$seek);
        return view();
    }

    public function user_teacher_details(){//教师详情
        $user_teacher_id = input('user_teacher_id');
        $seek = input('seek'); 
        $chuser_teaer_find = Db::name('user_teacher')->alias('a')->join('district b','a.district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('teacher_false_delete',1)->where('user_teacher_id',$user_teacher_id)->find();
        $this->assign('chuser_teaer_find',$chuser_teaer_find);
        $user_teacher_file = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('c.user_teacher_id',$user_teacher_id)->limit(15)->select();
        $this->assign('user_teacher_file',$user_teacher_file);
        $file_count = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('file_false_delete',1)->count();
        $this->assign('file_count',$file_count);
        $attention_count = Db::name('attention')->where('fid',$user_teacher_id)->where('attention_identity',1)->count();
        $this->assign('attention_count',$attention_count);
        $this->assign('user_teacher_id',$user_teacher_id);
        return view();
    }

    public function user_teacher_update_show(){
        $user_teacher_id = input('user_teacher_id');
        $seek = input('seek');
        $user_teacher_find = Db::name('user_teacher')->alias('a')->join('district b','a.district_id = b.district_id','left')->where('teacher_false_delete',1)->where('user_teacher_id',$user_teacher_id)->find();
        $this->assign('user_teacher_find',$user_teacher_find);
        $this->assign('user_teacher_id',$user_teacher_id);
        return view();
    }

    public function user_teacher_update(){
        $user_teacher_data = input('post.');
        // $seek = input('seek');
        $organization_update = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_data['user_teacher_id'])->update([
            'user_teacher_id'=>$user_teacher_data['user_teacher_id'],
            'teacher_name'=>$user_teacher_data['teacher_name'],
            'teacher_phone'=>$user_teacher_data['teacher_phone'],
            'schooltime'=>$user_teacher_data['schooltime'],
            'teacher_site'=>$user_teacher_data['teacher_site'],
            'teacher_level'=>$user_teacher_data['teacher_level'],
            'teacher_master'=>$user_teacher_data['teacher_master'],
            'teacher_intro'=>$user_teacher_data['teacher_intro'],
            'teacher_state'=>$user_teacher_data['teacher_state'],
        ]);
        if ($organization_update == 1) {
            return $this->success('修改成功!',url('user_teacher_update_show',['user_teacher_id'=>$user_teacher_data['user_teacher_id']]));
        }
        if ($organization_update == 0) {
            return $this->success('未修改',url('user_teacher_update_show',['user_teacher_id'=>$user_teacher_data['user_teacher_id']]));
        }else{
            return $this->success('修改失败!',url('user_teacher_update_show',['user_teacher_id'=>$user_teacher_data['user_teacher_id']]));
        }
    }

    public function teacher_file_select(){//查看更多教师文件
        $user_teacher_id = input('user_teacher_id');
        $teacher_file_select = Db::name('file')->alias('a')->join('file_user_teacher b','a.file_id = b.file_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->where('c.user_teacher_id',$user_teacher_id)->where('file_false_delete',1)->paginate(25);
        $this->assign('teacher_file_select',$teacher_file_select);
        $this->assign('user_teacher_id',$user_teacher_id);
        return view();
    }

    public function teacher_file_closure(){//教师文件封停
        $file_id = input('file_id');
        $user_teacher_id = input('user_teacher_id'); 
        $file_edit = Db::name('file')->where('file_id',$file_id)->update([
           'file_state'=>2,
        ]);
        if ($file_edit == 1) {
            return $this->success('封停成功!',url('Teacher/teacher_file_select',['user_teacher_id'=>$user_teacher_id]));
        }
        if ($file_edit == 0) {
            return $this->success('未修改',url('Teacher/teacher_file_select',['user_teacher_id'=>$user_teacher_id]));
        }else{
            return $this->success('封停失败!',url('Teacher/teacher_file_select',['user_teacher_id'=>$user_teacher_id]));
        }
    }

    public function user_teacher_closure(){//教师封停
        $user_teacher_id = input('user_teacher_id');
        $organization_edit = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->update([
           'teacher_state'=>2,
        ]);
        if ($organization_edit == 1) {
            return $this->success('封停成功!',url('user_teacher_list',['user_teacher_id'=>$user_teacher_id]));
        }
        if ($organization_edit == 0) {
            return $this->success('未修改',url('user_teacher_list',['user_teacher_id'=>$user_teacher_id]));
        }else{
            return $this->success('封停失败!',url('user_teacher_list',['user_teacher_id'=>$user_teacher_id]));
        }
    }

    public function teacher_check_list(){//教师审核列表
        $seek = input('seek');
        $teacher_check_list = Db::name('user_teacher')->alias('a')->join('district b','a.district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('a.teacher_name','like','%'.$seek.'%')->where('teacher_state',3)->paginate(25);
        $this->assign('teacher_check_list',$teacher_check_list);
        $this->assign('seek',$seek);
        return view();
    }
    public function teacher_apply_details(){//教师申请详情
        $user_teacher_id = input('user_teacher_id');
        $user_teacher_find = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->find();
        $this->assign('user_teacher_find',$user_teacher_find);
        return view();
    }
    public function teacher_pass(){//教师审核通过
        $user_teacher_id = input('user_teacher_id');
        $user_teacher_find = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->find();
        $user = Db::name('user')->where('user_id',$user_teacher_find['user_id'])->find();
        $user_teacher_edit = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->update([
                'teacher_state'=>1,
            ]);
        if ($user_teacher_edit == 1) {
            $user_role_update = Db::name('user')->where('user_id',$user['user_id'])->update([
                'user_role'=>2,
            ]);
            if ($user_role_update == 1) {
                return $this->success('审核成功','teacher_check_list');
            }
            // JMessage($user['user_phone'].$user_teacher_id,'yuewu2019');
            // JM_update_information($user['user_phone'].$user_teacher_id,$user['user_phone'].$user_teacher_id,$user_teacher_find['teacher_portrait']);//   修改为乐舞默认的昵称和头像
        }else{
            return $this->error('审核失败,服务器正忙。。。','teacher_check_list');
        }
    }

    public function teacher_reject(){//教师拒绝通过审核
        $user_teacher_id = input('user_teacher_id');
        $user_teacher_find = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->find();
        $user = Db::name('user')->where('user_id',$user_teacher_find['user_id'])->find();
        $user_teacher_find = Db::name('user_teacher')->where('user_teacher_id',$user_teacher_id)->update([
            'teacher_state'=>4,
        ]);
        if ($user_teacher_find == 1) {
            $this->success('驳回成功','teacher_check_list');
        }else{
            $this->error('驳回失败，服务器正忙。。。','teacher_check_list'); 
        }
    }
}