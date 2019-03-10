<?php
namespace app\area\controller;
use think\Session;
use think\Db;
class Curriculum extends Base{

    public function organization_curriculum_list(){//机构课程列表
    	$seek = input('seek');
        $organization_curriculum_list = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('organization_curriculum c','a.curriculum_id = c.curriculum_id','left')->join('organization d','c.organization_id = d.organization_id','left')->where('curriculum_state',1)->where('a.curriculum_identity_type',2)->where('curriculum_false_delete',1)->where('curriculum_name','like','%'.$seek.'%')->paginate(25);
        $this->assign('organization_curriculum_list',$organization_curriculum_list);
        $this->assign('seek',$seek);
        return view();
    }

    public function organization_curriculum_details(){//机构课程详情
        $curriculum_id = input('curriculum_id');
        $organization_curriculum_find = Db::name('curriculum')->alias('a')->join('organization_curriculum b','a.curriculum_id = b.curriculum_id','left')->join('organization c','b.organization_id = c.organization_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('a.curriculum_id',$curriculum_id)->find();
        $this->assign('organization_curriculum_find',$organization_curriculum_find);
        return view();
    }

    public function teacher_curriculum_details(){//教师课程详情
        $curriculum_id = input('curriculum_id');
        // var_dump($curriculum_id);exit();
        $teacher_curriculum_find = Db::name('curriculum')->alias('a')->join('curriculum_teacher b','a.curriculum_id = b.curriculum_id','left')->join('user_teacher c','b.user_teacher_id = c.user_teacher_id','left')->join('dance_type d','a.dance_type_id = d.dance_type_id','left')->where('a.curriculum_id',$curriculum_id)->where('a.curriculum_state',1)->where('a.curriculum_false_delete',1)->find();
        var_dump($teacher_curriculum_find);
        $this->assign('teacher_curriculum_find',$teacher_curriculum_find);
        return view();
    }

    public function organization_curriculum_update_show(){//机构课程编辑
    	$curriculum_id = input('curriculum_id');
    	$organization_curriculum_find = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('organization_curriculum c','a.curriculum_id = c.curriculum_id','left')->join('organization d','c.organization_id = d.organization_id','left')->where('a.curriculum_id',$curriculum_id)->find();
        $dance_type = Db::name('dance_type')->where('dance_type_status',1)->select();
        $this->assign('dance_type',$dance_type);
    	$this->assign('organization_curriculum_find',$organization_curriculum_find);
    	return view();
    }

    public function organization_curriculum_update(){//机构课程修改确认
    	$curriculum_id = input('curriculum_id');
    	$organization_curriculum_find = Db::name('curriculum')->where('curriculum_id',$curriculum_id)->find();
    	$this->assign('organization_curriculum_find',$organization_curriculum_find);
    	return view();
    }

    public function organization_curriculum_closure(){//机构课程首页封停
    	$curriculum_id = input('curriculum_id');
    	$organization_curriculum_find = Db::name('curriculum')->where('curriculum_id',$curriculum_id)->update([
    			'curriculum_state'=>2,
    		]);
    	if ($organization_curriculum_find == 1) {
    		$this->success('封停成功','organization_curriculum_list',2);
    	}else{
    		$this->error('封停失败,服务器正忙。。。','organization_curriculum_list',2);
    	}
    }

    public function teacher_curriculum_list(){//教师课程列表
    	$seek = input('seek');
        $teacher_curriculum_list = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('curriculum_teacher c','a.curriculum_id = c.curriculum_id','left')->join('user_teacher d','c.user_teacher_id = d.user_teacher_id','left')->where('curriculum_state',1)->where('a.curriculum_identity_type',1)->where('curriculum_false_delete',1)->where('a.curriculum_name|d.teacher_name','like','%'.$seek.'%')->paginate(25);
        $this->assign('teacher_curriculum_list',$teacher_curriculum_list);
        $this->assign('seek',$seek);
        return view();
    }

    public function organization_closure_curriculum_list(){//封停课程列表
    	$seek = input('seek');
        $organization_closure_curriculum_list = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('organization_curriculum c','a.curriculum_id = c.curriculum_id','left')->join('organization d','c.organization_id = d.organization_id','left')->where('curriculum_state',2)->where('a.curriculum_identity_type',2)->where('curriculum_false_delete',1)->where('curriculum_name','like','%'.$seek.'%')->paginate(25);
        $this->assign('organization_closure_curriculum_list',$organization_closure_curriculum_list);
        $this->assign('seek',$seek);
    	return view();
    }

    public function teacher_closure_curriculum_list(){//封停课程列表
    	$seek = input('seek');
        $teacher_closure_curriculum_list = Db::name('curriculum')->alias('a')->join('dance_type b','a.dance_type_id = b.dance_type_id','left')->join('curriculum_teacher c','a.curriculum_id = c.curriculum_id','left')->join('user_teacher d','c.user_teacher_id = d.user_teacher_id','left')->where('curriculum_state',2)->where('a.curriculum_identity_type',1)->paginate(25);
        $this->assign('teacher_closure_curriculum_list',$teacher_closure_curriculum_list);
        $this->assign('seek',$seek);
        return view();
    }
}