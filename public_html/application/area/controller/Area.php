<?php
namespace app\area\controller;
use think\Controller;
use think\Db;
use think\View;

class Area extends controller{
	
    public function area_list(){//地区列表
        $seek = input('seek');
        $district = Db::name('district')->where('district_name','like','%'.$seek.'%')->select();
        $this->assign('district',$district);
        $this->assign('seek',$seek);
        return view();
    }

    public function area_edit_show(){//地区列表内容编辑
        $district_id = input('district_id');
        $district_find = Db::name('district')->where('district_id',$district_id)->find();
        $this->assign('district_find',$district_find);
        return view();
    }

    public function area_edit(){//地区列表修改
        $district_data = input('post.');
        $district_update = Db::name('district')->where('district_id',$district_data['district_id'])->update([
                'district_name'=>$district_data['district_name'],
                'district_account'=>$district_data['district_account'],
                'district_psd'=>$district_data['district_psd'],
            ]);
        if ($district_update == 1) {
            return $this->success('修改成功','Area/area_list');
        }
        if ($district_update == 0) {
            return $this->success('未修改','Area/area_list','',1);
        }
        return $this->error('修改失败','Area/area_list','',1);
    }

    public function area_recover(){//地区恢复
        $district_id = input('district_id');
        $district_update = Db::name('district')->where('district_id',$district_id)->update([
                'district_status'=>1,
            ]);
        if ($district_update == 1) {
            return $this->success('恢复成功','Area/area_list','',1);
        }
        if ($district_update == 0) {
            return $this->success('未改变','Area/area_list','',1);
        }
        return $this->redirect('Area/area_edit_show',['district_id' =>$district_id]);
    }

    public function area_forbid(){//地区禁止
        $district_id = input('district_id');
        $district_update = Db::name('district')->where('district_id',$district_id)->update([
                'district_status'=>2,
            ]);
        if ($district_update == 1) {
            return $this->success('封停成功','Area/area_list','',1);
        }
        if ($district_update == 0) {
            return $this->success('未改变','Area/area_list','',1);
        }
        return $this->error('封停失败','Area/area_edit_show','',1);
    }
}
