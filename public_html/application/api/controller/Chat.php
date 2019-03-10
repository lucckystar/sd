<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class Chat extends Controller{//聊天控制器
    
    public function chat_list(){//聊天列表
        
    }

    public function chat_details(){//聊天详情
    $param = input('post.');

    if (empty($param['page'])) {
       $param['page'] = 1;
    }
    $limit = 12;
    $limit_first = ($param['page']-1)*$limit;

    $User_list = Db::name('user')->alias('a')->join('vip b','a.vip_id = b.vip_id')->where(['a.user_inviter_2'=>$this->User_info['user_id']])->limit($limit_first,$limit)->select();
    return returnJson(1,'',$User_list);
    }
}