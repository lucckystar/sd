<?php

namespace app\admin\controller;

use think\Controller;

use think\Session;

use think\Db;

class Account extends Controller {

    //判断是否登录默认方法

	public function _initialize(){

		// if(Session::has('staff_id','admin')){

		// 	$this->redirect('Index/index');

		// }

	}



    //登录页面

	public function login(){

		return $this->fetch();

	}



    //登录请求

	public function loginupdate(){

        $parm = input('post.');



        // if (!captcha_check($parm['verify'])) {

        //     $this->error('验证码错误！','',true);

        // }



        // $Admin_info = Db::name('admin')->where('admin_account',$parm['username'])->find();



        // if (empty($Admin_info)) {

        //     $this->error('用户名或密码有误！');

        // }

        // if (!checkPass($parm['pwd'],$Admin_info['admin_salt'], $Admin_info['admin_pass'])) {

        //     $this->error('用户名或密码有误！');

        // }



        // Session::set('admin_id',$Admin_info['admin_id'],'admin');

        // Session::set('admin_username',$Admin_info['admin_username'],'admin');

        // Session::set('admin_role_id',$Admin_info['admin_role_id'],'admin');

        // Session::set('admin_realname',$Admin_info['admin_realname'],'admin');

        // Session::set('admin_phone',$Admin_info['admin_phone'],'admin');

        // Session::set('admin_portrait',$Admin_info['admin_portrait'],'admin');



        // $AdminRole_info = Db::name('admin_role')->where(['admin_role_id'=>$Admin_info['admin_role_id']])->find();

        // Session::set('admin_role_type',$AdminRole_info['admin_role_type'],'admin');

        // Session::set('admin_role_name',$AdminRole_info['admin_role_name'],'admin');

        // Session::set('admin_role_permission',$AdminRole_info['admin_role_permission'],'admin');

        // Session::set('admin_role_evalpath',$AdminRole_info['admin_role_evalpath'],'admin');



        // $T_AdminLog = new \app\admin\model\AdminLog();

        // $T_AdminLog->record('用户登录');

        $this->success('登陆成功！',url('Index/index'));

    }

}