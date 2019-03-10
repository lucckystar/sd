<?php
namespace app\admin\controller;
use think\Session;
use think\Db;
class Organization extends Base{

    public function organization_list(){//机构列表
        $organization_data = input('post.');
        $seek = input('seek');
        $organization_select = Db::name('organization')->alias('a')->join('district b','a.organization_district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('organization_false_delete',1)->field('organization_id,organization_state,organization_name,organization_portrait,organization_attention,district_name')->where('organization_name','like','%'.$seek.'%')->paginate(15);
        $this->assign('seek',$seek);
        $this->assign('organization_select',$organization_select);
        return view();
    }

    public function organization_details(){//机构详情
        $organization_id = input('organization_id');
        $seek = input('seek');
        $organization_find = Db::name('organization')->alias('a')->join('district b','a.organization_district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('organization_false_delete',1)->where('organization_id',$organization_id)->find();
        $this->assign('organization_find',$organization_find);
        $organization_file = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('c.organization_id',$organization_id)->limit(15)->select();
        $this->assign('organization_file',$organization_file);
        $file_count = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('file_false_delete',1)->count();
        $this->assign('file_count',$file_count);
        $attention_count = Db::name('attention')->where('fid',$organization_id)->where('attention_identity',2)->count();
        $this->assign('attention_count',$attention_count);
        $this->assign('organization_id',$organization_id);
        return view();
    }


    public function organization_update_show(){//机构详情
        $organization_id = input('organization_id');
        $seek = input('seek');
        $organization_find = Db::name('organization')->alias('a')->join('district b','a.organization_district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('organization_false_delete',1)->where('organization_id',$organization_id)->find();
        // $organization_find = Db::name('organization')->alias('a')->join('district b','a.organization_district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('organization_false_delete',1)->where('organization_id',$organization_id)->field('organization_id,organization_state,organization_name,organization_portrait,organization_attention,district_name')->find();
        $this->assign('organization_find',$organization_find);
        // $this->assign('seek',$seek);
        return view();
    }

    public function organization_update(){//机构详情
        $organization_data = input('post.');
        // $seek = input('seek');
        $organization_find = Db::name('organization')->where('organization_id',$organization_data['organization_id'])->update([
            'organization_id'=>$organization_data['organization_id'],
            'organization_name'=>$organization_data['organization_name'],
            'organization_site'=>$organization_data['organization_site'],
            'organization_business_hours'=>$organization_data['organization_business_hours'],
            'organization_synopsis'=>$organization_data['organization_synopsis'],
            'organization_service'=>$organization_data['organization_service'],
            'organization_type'=>$organization_data['organization_type'],
            'organization_level'=>$organization_data['organization_level'],
            'organization_attention'=>$organization_data['organization_attention'],
            'organization_state'=>$organization_data['organization_state'],
            'organization_id'=>$organization_data['organization_id'],
        ]);
        if ($organization_find == 1) {
            return $this->success('修改成功!',url('organization_update_show',['organization_id'=>$organization_data['organization_id']]));
        }
        if ($organization_find == 0) {
            return $this->success('未修改',url('organization_update_show',['organization_id'=>$organization_data['organization_id']]));
        }else{
            return $this->success('修改失败!',url('organization_update_show',['organization_id'=>$organization_data['organization_id']]));
        }
    }

    public function organization_closure(){//机构封停
        $organization_id = input('organization_id');
        $organization_edit = Db::name('organization')->where('organization_id',$organization_id)->update([
           'organization_state'=>2,
        ]);
        if ($organization_edit == 1) {
            return $this->success('封停成功!',url('organization_list',['organization_id'=>$organization_id]));
        }
        if ($organization_edit == 0) {
            return $this->success('未修改',url('organization_list',['organization_id'=>$organization_id]));
        }else{
            return $this->success('封停失败!',url('organization_list',['organization_id'=>$organization_id]));
        }
    }


    public function file_closure(){//视频列表(全部)
        $file_id = input('file_id');
        $file_closure_update = Db::name('file')->where('file_id',$file_id)->update([
            'file_state'=>2,
        ]);
        if ($file_closure_update == 1) {
            return $this->success('封停成功','file_list','',1);
        }
        return $this->error('封停失败','file_list','',1);
    }

    public function organization_check_list(){//审核列表
        $organization_data = input('post.');
        $seek = input('seek');
        $organization_select = Db::name('organization')->alias('a')->join('district b','a.organization_district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('organization_false_delete',1)->where('organization_state',3)->where('organization_name','like','%'.$seek.'%')->paginate(15);
        $this->assign('seek',$seek);
        $this->assign('organization_select',$organization_select);
        return view();
    }

    public function organization_file_select(){//机构的文件查看
        $organization_id = input('organization_id');
        $seek = input('seek');
        // $organization_select = Db::name('file')->alias('a')->join('district b','a.organization_district_id = b.district_id','left')->join('user c','a.user_id = c.user_id','left')->where('organization_false_delete',1)->where('organization_state',3)->field('organization_id,organization_state,organization_name,organization_portrait,organization_attention,district_name')->where('organization_name','like','%'.$seek.'%')->paginate(15);
        $organization_select = Db::name('file')->alias('a')->join('file_organization b','a.file_id = b.file_id','left')->join('organization c','b.organization_id = c.organization_id','left')->where('c.organization_id',$organization_id)->where('file_false_delete',1)->paginate(25);
        $this->assign('organization_id',$organization_id);
        $this->assign('seek',$seek);
        $this->assign('organization_select',$organization_select);
        return view();
    }

    public function organization_file_closure(){
        $file_id = input('file_id');
        $organization_id = input('organization_id');
        $file_closure = Db::name('file')->where('file_id',$file_id)->update([
                'file_state'=>2,
            ]);
        if ($file_closure == 1) {
            return $this->success('封停成功',url('organization/organization_file_select',['organization_id'=>$organization_id]),2);
        }
        if ($file_closure == 0) {
            return $this->success('未变动',url('organization/organization_file_select',['organization_id'=>$organization_id]),2);
        }else{
            return $this->error('未变动',url('organization/organization_file_select',['organization_id'=>$organization_id]),2);
        }
    }

    public function organization_apply_details(){//申请机构详情
        $organization_id = input('organization_id');
        $organization_find = Db::name('organization')->where('organization_id',$organization_id)->find();
        $this->assign('organization_find',$organization_find);
        return view();
    }

    public function organization_pass(){//通过审核
        $organization_id = input('organization_id');
        $organization = organization($organization_id);
        $user = user($organization['user_id']);
        $organization_find = Db::name('organization')->where('organization_id',$organization_id)->update([
            'organization_state'=>1,
        ]);
        if ($organization_find == 1) {
            JMessage($user['user_phone'].$organization_id,'yuewu2019');
            JM_update_information($user['user_phone'].$organization_id,$user['user_phone'].$organization_id,$organization['organization_portrait']);//   修改为乐舞默认的昵称和头像
            $this->success('审核成功','organization_check_list');
        }else{
            $this->error('审核失败，服务器正忙。。。','organization_check_list'); 
        }
    }

    public function organization_reject(){//拒绝通过审核
        $organization_id = input('organization_id');
        $organization = organization($organization_id);
        $user = user($organization['user_id']);
        $organization_find = Db::name('organization')->where('organization_id',$organization_id)->update([
            'organization_state'=>4,
        ]);
        if ($organization_find == 1) {
            $this->success('驳回成功','organization_check_list');
        }else{
            $this->error('驳回失败，服务器正忙。。。','organization_check_list'); 
        }
    }
}