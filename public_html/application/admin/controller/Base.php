<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
class Base extends Controller {
	public function _initialize(){
		// if(!Session::has('admin_id','admin')){
		// 	$this->redirect('Account/login');
		// 	exit;
		// }
		
		// $T_AdminMenu = new \app\admin\model\AdminMenu();
		// $T_AdminLog = new \app\admin\model\AdminLog();
		
		// $menu_info = $T_AdminMenu->where(['admin_menu_url'=>$this->request->controller().'/'.$this->request->action()])->find();
		// if (!empty($menu_info)) {
			
		// 	if (Session::get('admin_id','admin') != 1) {
		// 		if (!in_array($menu_info['admin_menu_id'],Session::get('admin_role_permission','admin'))) {
		// 			$this->error('您无权限执行此操作','',IS_AJAX);
		// 		}
		// 	}

		// 	$nav_list = $T_AdminMenu->nav_list($menu_info);
		// 	$staff_log_name = '';
		// 	foreach ($nav_list as $k => $v) {
		// 		$staff_log_name .= $v['admin_menu_name'].'->';
		// 	}
		// 	if(empty($_COOKIE['LAST_PATH_INFO']) || $_COOKIE['LAST_PATH_INFO']!=$_SERVER['PATH_INFO']){
		// 		$T_AdminLog->record(substr($staff_log_name,0,-2));
		// 		$_COOKIE['LAST_PATH_INFO'] = $_SERVER['PATH_INFO'];
		// 	}
		// }
	}
}