<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class Order extends Controller{//用户控制器

    public function affirm_pay(){//14-2确认支付
        $order = input('post.');
        $curriculum = Db::name('curriculum')->where('curriculum_id',$order['curriculum_id'])->find();
        if ($curriculum['curriculum_state'] == 1 && $curriculum['curriculum_false_delete'] == 1) {
            if ($curriculum['curriculum_effective'] == 2) {
                if (time() >= $curriculum['curriculum_start_time'] && time() <= $curriculum['curriculum_over_time']) {
                    if ($curriculum['curriculum_identity_type'] == 1) {
                        $user = user($order['user_token']);
                        $teacher = Db::name('user_teacher')->where('user_teacher_id',$curriculum['id'])->find();
                        $order_data = [//差优惠券没写入-差优惠金额没写入-差实际支付金额
                            'user_id'=>$user['user_id'],
                            'curriculum_id'=>$order['curriculum_id'],
                            'order_number'=>rand(111111111,999999999),
                            'order_status'=>1,
                            'order_amount'=>$curriculum['curriculum_actual_price'],
                            'order_createtime'=>time(),
                        ];
                        $insert_insert = Db::name()->insertGetId($order_data);
                        
                    }
                }
            }
        }
        return returnJson(1,'',$user_find);//正常,'',用户信息
    }

    
}