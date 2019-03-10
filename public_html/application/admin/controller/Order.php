<?php
namespace app\admin\controller;
use think\Session;
use think\Db;
class Order extends Base{

    public function organization_order(){//机构明细
        $seek = input('seek');
        $organization_order_list = Db::name('order')->alias('a')->join('curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.id = c.organization_id','left')->join('user d','a.user_id = d.user_id','left')->where('b.curriculum_identity_type',2)->where('b.curriculum_name|d.user_phone','like','%'.$seek.'%')->order('order_createtime desc')->paginate(25);
        $this->assign('seek',$seek);
        $this->assign('organization_order_list',$organization_order_list);
        return view();
    }

    public function teacher_order(){//机构明细
        $seek = input('seek');
        $teacher_order_list = Db::name('order')->alias('a')->join('curriculum b','a.curriculum_id = b.curriculum_id','left')->join('user_teacher c','b.id = c.user_teacher_id','left')->join('user d','a.user_id = d.user_id','left')->where('b.curriculum_identity_type',1)->where('b.curriculum_name|d.user_phone','like','%'.$seek.'%')->order('order_createtime desc')->paginate(25);
        $this->assign('seek',$seek);
        $this->assign('teacher_order_list',$teacher_order_list);
        return view();
    }

    public function user_order(){//机构明细
        $seek = input('seek');
        $user_order_list = Db::name('order')->alias('a')->join('curriculum b','a.curriculum_id = b.curriculum_id','left')->join('user d','a.user_id = d.user_id','left')->where('b.curriculum_identity_type',2)->where('b.curriculum_name|d.user_phone','like','%'.$seek.'%')->order('order_createtime desc')->paginate(25);
        $this->assign('seek',$seek);
        $this->assign('user_order_list',$user_order_list);
        return view();
    }
}