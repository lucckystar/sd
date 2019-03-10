<?php
namespace app\area\controller;
use think\Session;
use think\Db;
class Index extends Base{
    //后台框架
	public function index(){
		// $T_AdminMenu = new \app\admin\model\AdminMenu();
		// $AdminMenu_list = $T_AdminMenu->where(['admin_menu_islife'=>1,'admin_menu_eval'=>['ELT',3]])->order('admin_menu_id asc')->select();
		// if (Session::get('admin_id','admin') != 1) {
		// 	$AdminMenu_list = $T_AdminMenu->menu_wipeout($AdminMenu_list,Session::get('admin_role_permission','admin'));
		// }
		// $AdminMenu_list = $T_AdminMenu->menu_multi_list($AdminMenu_list);
		// $this->assign('AdminMenu_list',$AdminMenu_list);
        return $this->fetch();
	}

    //主页
	public function homepage(){
		return $this->fetch();
	}

	//修改密码
    public function setpass(){
    	$T_AdminLog = new \app\admin\model\T_AdminLog();
        $T_AdminLog->record('修改密码');
    	return $this->fetch();
    }
    public function setpass_ok(){
        $parm = input('post.');
        $T_Admin = new \app\admin\model\Admin();
        $Admin_info = $T_Admin->info(Session::get('admin_id','admin'));
        if (!checkPass($parm['old_pwd'],$Admin_info['admin_salt'],$Admin_info['admin_pass'])) {
            $this->error('原密码不正确！','');
        }
        $data = encodePass($parm['new_pwd']);
        $data = ['admin_pass'=>$data['hash'],'admin_salt'=>$data['salt']];
        Db::startTrans();
        if (!$T_Admin->where(['admin_id'=>Session::get('admin_id','admin')])->update($data)) {
            Db::rollback();
            $this->error('服务器正忙...','');
        }
        $T_AdminLog = new \app\admin\model\AdminLog();
        $T_AdminLog->record('修改密码成功');

        Db::commit();
    	$this->success('修改密码成功',url('homepage'));
    }

    //退出登录
	public function logout(){
		$T_AdminLog = new \app\admin\model\AdminLog();
        $T_AdminLog->record('退出登录');
    	Session::clear('admin');
    	$this->redirect('Account/login');
    }

}
