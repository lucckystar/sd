<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\View;

class Discounts extends controller{
	
    public function discounts_list(){//优惠券列表
        $seek = input('seek');
        $discounts = Db::name('discounts')->where('discounts_false_delete',1)->paginate();
        $this->assign('discounts',$discounts);
        $this->assign('seek',$seek);
        return view();
    }
}
