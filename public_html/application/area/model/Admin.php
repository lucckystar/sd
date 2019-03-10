<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model{
	public function info($id){
		return $this->where(['admin_id'=>$id])->find();
	}
	public function change_parm($parm){
		$return_parm['admin_username'] = $parm['admin_username'];
		$return_parm['admin_role_id'] = $parm['admin_role_id'];
		$return_parm['admin_using'] = $parm['admin_using'];
		$return_parm['admin_status'] = $parm['admin_status'];
		$T_AdminRole = new \app\admin\model\AdminRole();
		if (!$T_AdminRole->info($parm['admin_role_id'])) {
			$this->errorMsg('所属职位不存在');
			return false;
		}
		if (!empty($parm['admin_portrait'])) {
			$T_File = new \app\admin\model\File();
			if (!$T_File->info($parm['admin_portrait'])) {
				$this->errorMsg('文件不存在');
				return false;
			}
			$return_parm['admin_portrait'] = $parm['admin_portrait'];
		}
		return $return_parm;
	}
}
