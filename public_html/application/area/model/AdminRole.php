<?php
namespace app\admin\model;
use think\Model;
use think\Session;
class AdminRole extends Model{
	public function lists(){
		return $this->where(['admin_role_evalpath'=>['LIKE',Session::get('admin_role_evalpath','admin').'%']])->order('admin_role_evalpath asc')->select();
	}
	public function info($id = 0){
		if (empty($id)) {
			return false;
		}
		return $this->where(['admin_role_id'=>$id,'admin_role_evalpath'=>['LIKE',Session::get('admin_role_evalpath','admin').'%']])->order('admin_role_evalpath asc')->find();
	}
	public function change_parm($parm){

		if (empty($parm['id']) || $parm['id'] != 1) {

			if (empty($parm['admin_role_pid'])) {
				$this->errorMsg('所属职位必须');
				return false;
			}
			$info = $this->where(['admin_role_id'=>$parm['admin_role_pid'],'admin_role_evalpath'=>['LIKE',Session::get('admin_role_evalpath','admin').'%']])->find();
			if (empty($info)) {
				$this->errorMsg('所属职位不存在');
				return false;
			}
			$return_parm['admin_role_pid'] = $parm['admin_role_pid'];

			$return_parm['admin_role_evalpath'] = $info['admin_role_evalpath'];

			if (empty($parm['admin_role_permission'])) {
				$this->errorMsg('职位权限为空');
				return false;
			}
			$info['admin_role_permission'] = json_decode($info['admin_role_permission'],true);
			foreach ($parm['admin_role_permission'] as $k => $v) {
				if (!in_array($v,$info['admin_role_permission'])) {
					$this->errorMsg('所属职位无此权限');
					return false;
				}
				if ($v == 1) {
					if ($return_parm['admin_role_type'] == 2) {
						$this->errorMsg('分店职位无此权限');
						return false;
					}
				}
			}
			$return_parm['admin_role_permission'] = json_encode($parm['admin_role_permission']);
		}
		return $return_parm;
	}
}