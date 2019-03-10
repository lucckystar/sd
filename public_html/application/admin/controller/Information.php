<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\View;

class Information extends controller{
    
    public function banner_list(){//轮播图列表
        $banner_select = Db::name('banner')->select();
        $this->assign('banner_select',$banner_select);
        return view();
    }

    public function banner_edit_show(){//轮播图修改展示
        $banner_id = input('banner_id');
        $banner_find = Db::name('banner')->where('banner_id',$banner_id)->find();
        $this->assign('banner_find',$banner_find);
        return view();
    }

    // public function banner_edit(){//轮播图执行修改
    //     $banner_data = input('post.');
    //     $banner_content = request()->file('banner_content');
    //     // var_dump($banner_content);exit();
    //     if($banner_content !== null){
    //     $banner = $banner_content->move(ROOT_PATH . 'public' . DS . 'uploads');
    //     if($banner){
    //         // 成功上传后 获取上传信息
    //         // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
    //         $banner_content = $banner->getSaveName();
    //         $banner_edit = Db::name('banner')->where('banner_id',$banner_data['banner_id'])->update([
    //             'banner_name'=>$banner_data['banner_name'],
    //             'banner_content'=>$banner_content,
    //             'banner_sort'=>$banner_data['banner_sort'],
    //         ]);
    //         if ($banner_edit == 1) {
    //             return $this->success('修改成功','Information/banner_list','',1);
    //         }
    //         if ($banner_edit == 0) {
    //             return $this->success('未修改','Information/banner_list','',2);
    //         }
    //     }else{
    //         // 上传失败获取错误信息
    //         // echo $banner_content->getError();
    //         return $this->error('修改失败,服务器正忙。。。','Information/banner_list','',2);
    //         }
    //         $banner_edit = Db::name('banner')->where('banner_id',$banner_data['banner_id'])->update([
    //                 'banner_name'=>$banner_data['banner_name'],
    //                 'banner_sort'=>$banner_data['banner_sort'],
    //             ]);
    //         if ($banner_edit == 1) {
    //             return $this->success('修改成功','Information/banner_list','',1);
    //         }
    //         if ($banner_edit == 0) {
    //             return $this->success('未修改','Information/banner_list','',2);
    //         }else{
    //             return $this->error('修改失败,服务器正忙。。。','Information/banner_list','',2);
    //         }
    //     }
    // }


    public function banner_edit(){//轮播图执行修改
        $banner_data = input('post.');
        $banner_content = request()->file('banner_content');
        // var_dump($banner_content);exit();
        if($banner_content !== null){
        $banner = $banner_content->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($banner){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $banner_content = $banner->getSaveName();
            $banner_edit = Db::name('banner')->where('banner_id',$banner_data['banner_id'])->update([
                'banner_name'=>$banner_data['banner_name'],
                'banner_content'=>$banner_content,
                'banner_sort'=>$banner_data['banner_sort'],
            ]);
            if ($banner_edit == 1) {
                return $this->success('修改成功','Information/banner_list','',1);
            }
            if ($banner_edit == 0) {
                return $this->success('未修改','Information/banner_list','',2);
            }
        }else{
            // 上传失败获取错误信息
            // echo $banner_content->getError();
            return $this->error('修改失败,服务器正忙。。。','Information/banner_list','',2);
            }
        }
            $banner_edit = Db::name('banner')->where('banner_id',$banner_data['banner_id'])->update([
                    'banner_name'=>$banner_data['banner_name'],
                    'banner_sort'=>$banner_data['banner_sort'],
                ]);
            if ($banner_edit == 1) {
                return $this->success('修改成功','Information/banner_list','',1);
            }
            if ($banner_edit == 0) {
                return $this->success('未修改','Information/banner_list','',2);
            }else{
                return $this->error('修改失败,服务器正忙。。。','Information/banner_list','',2);
            }
    }

    
    public function banner_del(){//轮播图删除
        $banner_id = input('banner_id');
        $banner_find = Db::name('banner')->where('banner_id',$banner_id)->delete($banner_id);
        if ($banner_find == 1) {
            return $this->success('删除成功','Information/banner_list','',1);
        }
        return $this->error('删除失败,服务器正忙。。。','Information/banner_list','',2);
    }

    public function banner_add_show(){//添加轮播图
        return view();
    }

    public function banner_add(){//轮播图执行添加
        $banner_data = input('post.');
        $banner_content = request()->file('banner_content');
        if ($banner_content == null) {
            return $this->error('添加失败,图片不存在','Information/banner_list','',2);
        }
        $banner = $banner_content->move(ROOT_PATH . 'public' . DS . 'uploads');
        $banner_content = $banner->getSaveName();

        $banner_insert = [
            'banner_name'=>$banner_data['banner_name'],
            'banner_content'=>$banner_content,
            'banner_sort'=>$banner_data['banner_sort'],
        ];
        $banner_add = Db::name('banner')->insert($banner_insert);
        if ($banner_add == 1) {
            return $this->success('添加成功','Information/banner_list','',1);
        }
        return $this->error('添加失败,服务器正忙。。。','Information/banner_list','',2);
    }

    public function publicity_list(){//展示图
        $publicity_pic = Db::name('information')->where('information_id',1)->select();
        $this->assign('publicity_pic',$publicity_pic);
        return view();
    }

    public function publicity_edit_show(){
        $information_id = input('information_id');
        $information_find = Db::name('information')->where('information_id',$information_id)->find();
        $this->assign('information_find',$information_find);
        return view();
    }

    public function publicity_edit(){//展示图修改
        $publicity_data = input('post.');
        $publicity_content = request()->file('information_content');
        if ($publicity_content == null) {
            return $this->error('修改失败,图片不存在','Information/publicity_list','',2);
        }
        $publicity_content = $publicity_content->move(ROOT_PATH . 'public' . DS . 'uploads');
        $publicity_content = $publicity_content->getSaveName();

        $publicity_edit = Db::name('information')->where('information_id',$publicity_data['information_id'])->update([
            'information_name'=>$publicity_data['information_name'],
            'information_content'=>$publicity_content,
        ]);
        if ($publicity_edit == 1) {
            return $this->success('修改成功','Information/publicity_list','',1);
        }
        if ($publicity_edit == 0) {
            return $this->success('未修改','Information/publicity_list','',1);
        }
        return $this->error('修改失败','Information/publicity_list','',1);
    }

    public function dance_type_list(){//舞蹈种类
        $dance_type_select = Db::name('dance_type')->select();
        $this->assign('dance_type_select',$dance_type_select);
        return view();
    }

    public function dance_type_add_show(){//舞蹈种类添加
        $dance_type_select = Db::name('dance_type')->where('dance_type_status',1)->select();
        $this->assign('dance_type_select',$dance_type_select);
        return view();
    }

    public function dance_type_add(){//舞蹈种类添加
        $dance_type_name = input('dance_type_name');
        if (empty($dance_type_name)) {
            return $this->success('内容为空,未添加','Information/dance_type_list','',1);
        }
        $dance_type_insert = Db::name('dance_type')->insert([
                'dance_type_name'=>$dance_type_name,
            ]);
        if ($dance_type_insert == 1) {
            return $this->success('添加成功','Information/dance_type_list','',1);
        }
        return $this->error('添加失败','Information/dance_type_list','',1);
    }

    public function dance_type_edit_show(){//舞蹈种类修改
        $dance_type_id = input('dance_type_id');
        if (empty($dance_type_id)) {
            return $this->success('内容为空,未修改','Information/dance_type_list','',1);
        }
        $dance_type_find = Db::name('dance_type')->where('dance_type_id',$dance_type_id)->find();
        $this->assign('dance_type_find',$dance_type_find);
        return view();
    }

    public function dance_type_edit(){//舞蹈种类修改
        $dance_type_data = input('post.');
        if (empty($dance_type_data)) {
            return $this->success('内容为空,未修改','Information/dance_type_list','',1);
        }
        $dance_type_update = Db::name('dance_type')->where('dance_type_id',$dance_type_data['dance_type_id'])->update([
                'dance_type_name'=>$dance_type_data['dance_type_name'],
            ]);
        if ($dance_type_update == 1) {
            return $this->success('修改成功','Information/dance_type_list','',1);
        }
        if ($dance_type_update == 0) {
            return $this->success('未修改','Information/dance_type_list','',1);
        }
       return $this->error('修改失败,服务器正忙。。。','Information/dance_type_list','',1);
    }

    public function dance_type_cease(){//舞蹈种类禁止
        $dance_type_id = input('dance_type_id');
        $dance_type_update = Db::name('dance_type')->update([
                'dance_type_id'=>$dance_type_id,
                'dance_type_status'=>2,
            ]);
        if ($dance_type_update == 1) {
            return $this->success('封停成功','Information/dance_type_list','',1);
        }
        if ($dance_type_update == 0) {
            return $this->success('未改变','Information/dance_type_list','',1);
        }
        return $this->error('封停失败,服务器正忙。。。','Information/dance_type_list','',1);
    }

    public function dance_type_recover(){//舞蹈种类恢复
        $dance_type_id = input('dance_type_id');
        $dance_type_update = Db::name('dance_type')->update([
                'dance_type_id'=>$dance_type_id,
                'dance_type_status'=>1,
            ]);
        if ($dance_type_update == 1) {
            return $this->success('恢复成功','Information/dance_type_list','',1);
        }
        if ($dance_type_update == 0) {
            return $this->success('未改变','Information/dance_type_list','',1);
        }
        return $this->error('恢复失败,服务器正忙。。。','Information/dance_type_list','',1);
    }
}