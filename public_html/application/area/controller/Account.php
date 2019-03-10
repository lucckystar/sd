<?php
namespace app\area\controller;
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

        $district_info = Db::name('district')->where('district_account',$parm['district_account'])->where('district_psd',$parm['district_psd'])->find();

        if (empty($district_info)) {
            $this->error('用户名或密码有误！');
        }
        // if (!checkPass($parm['pwd'],$district_info['admin_salt'], $district_info['admin_pass'])) {
        //     $this->error('用户名或密码有误！');
        // }

        Session::set('district_id',$district_info['district_id'],'area');
        Session::set('district_name',$district_info['district_name'],'area');
        Session::set('district_account',$district_info['district_account'],'area');
        Session::set('district_psd',$district_info['district_psd'],'area');
        // Session::set('admin_phone',$district_info['admin_phone'],'area');
        // Session::set('admin_portrait',$district_info['admin_portrait'],'area');

        // $AdminRole_info = Db::name('admin_role')->where(['admin_role_id'=>$district_info['admin_role_id']])->find();
        // Session::set('admin_role_type',$AdminRole_info['admin_role_type'],'admin');
        // Session::set('admin_role_name',$AdminRole_info['admin_role_name'],'admin');
        // Session::set('admin_role_permission',$AdminRole_info['admin_role_permission'],'admin');
        // Session::set('admin_role_evalpath',$AdminRole_info['admin_role_evalpath'],'admin');

        // $T_AdminLog = new \app\admin\model\AdminLog();
        // $T_AdminLog->record('用户登录');
        $this->success('登陆成功！',url('Index/index'));
    }
}