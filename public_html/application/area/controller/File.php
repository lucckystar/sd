<?php
namespace app\area\controller;
use think\Session;
use think\Db;
class File extends Base{

    public function file_list(){//视频列表(全部)
        $seek = input('seek');
        $file_type = input('file_type');
        $file_select = Db::name('file')->alias('a')->join('district b','a.district_id = b.district_id','left')->join('dance_type c','a.dance_type_id = c.dance_type_id','left')->where('file_false_delete',1)->where('file_type',$file_type)->field('file_id,district_name,dance_type_name,file_cover,file_name,file_creattime,file_collection,file_category,file_state,file_type')->where('file_name','like','%'.$seek.'%')->paginate(15);
        $file_type = Db::name('file')->where('file_type',$file_type)->field('file_type')->find();
        $this->assign('seek',$seek);
        $this->assign('file_type',$file_type);
        $this->assign('file_select',$file_select);

        return view();
    }

    public function file_details(){//视频列表(全部)
        $file_data = input('post.');
        // if () {
        //     # code...
        // }
        $file_id = input('file_id');
        $videos_find = Db::name('file')->where('file_id',$file_id)->find();
        $this->assign('videos_find',$videos_find);
        var_dump($videos_find);
        return view();
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

    public function file_report(){//被举报视频列表
        $seek = input('seek');
        $file_report = Db::name('report')->alias('a')->join('file b','a.file_id = b.file_id','left')->join('district c','b.district_id = c.district_id','left')->where('a.file_state',1)->where('b.file_name','like','%'.$seek.'%')->order('report_number desc')->paginate(25);
        $this->assign('file_report',$file_report);
        $this->assign('seek',$seek);
        // var_dump($file_report);
        return view();
    }

    public function file_closure_pass(){//举报通过封停文件
        $file_id = input('file_id');
        $file_report = Db::name('file')->where('file_id',$file_id)->update([
            'file_state'=>2,
        ]);
        $file_report = Db::name('report')->where('file_id',$file_id)->update([
            'file_state'=>2,
        ]);
        if ($file_report == 1) {
            $this->success('封停成功','file_report');
        }else{
            $this->error('封停失败，服务器正忙。。。','file_report');
        }
    }

    public function file_report_reject(){//举报驳回
        $file_id = input('file_id');
        $file_report = Db::name('report')->where('file_id',$file_id)->delete();
        if ($file_report == 1) {
            $this->success('驳回成功','file_report');
        }else{
            $this->error('封停失败，服务器正忙。。。','file_report');
        }
    }

    public function file_closure_list(){//被举报被封停文件列表
        $seek = input('seek');
        $file_closure_list = Db::name('report')->alias('a')->join('file b','a.file_id = b.file_id','left')->join('district c','b.district_id = c.district_id','left')->where('a.file_state',2)->where('b.file_name','like','%'.$seek.'%')->paginate(25);
        $this->assign('file_closure_list',$file_closure_list);
        $this->assign('seek',$seek);
        return view();
    }

    public function file_recover(){//被举报文件恢复
        $file_id = input('file_id');
        $file_recover = Db::name('file')->where('file_id',$file_id)->update([
            'file_state'=>1,
        ]);
        if ($file_recover == 1) {
            $this->success('恢复成功','file_closure_list');
        }else{
            $this->error('恢复失败','file_closure_list');
        }
        return view();
    }
}
