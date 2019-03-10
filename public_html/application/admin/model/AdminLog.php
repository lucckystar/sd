<?php
namespace app\admin\model;
use think\Model;
use think\Request;
use think\Session;
class AdminLog extends Model{
   public function record($name=''){
   		$request = Request::instance();
		$data['admin_id'] = Session::get('admin_id','admin');
		$data['admin_log_ip'] = ip2long($request->ip());
		$data['admin_log_time'] = time();
		$data['admin_log_name'] = $name;
		$data['admin_log_controller'] = $request->controller();
		$data['admin_log_action'] = $request->action();
		return $this->insert($data);
   }
}
