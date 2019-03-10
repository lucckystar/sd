<?php
namespace app\admin\controller;
use think\Db;
use think\Session;
class Admin extends Base {
	//权限管理
	public function role(){
		$T_AdminRole = new \app\admin\model\AdminRole();
		$AdminRole_lists = $T_AdminRole->where(['admin_role_evalpath'=>['LIKE',Session::get('admin_role_evalpath','admin').'%']])->order('admin_role_evalpath asc')->select();
		$this->assign('lists',$AdminRole_lists);
		return $this->fetch();
	}
	public function role_add(){
		$T_AdminRole = new \app\admin\model\AdminRole();
		$T_AdminMenu = new \app\admin\model\AdminMenu();

		$AdminRole_lists = $T_AdminRole->lists();
		$AdminMenu_lists = $T_AdminMenu->select();
		if (Session::get('admin_role_id','admin') != 1) {
			$T_AdminMenu->menu_wipeout($AdminMenu_lists,Session::get('admin_role_permission','admin'));
		}

		$this->assign('AdminRole_lists',$AdminRole_lists);
		$this->assign('AdminMenu_lists',$T_AdminMenu->sort($AdminMenu_lists));
		return $this->fetch('role_edit');
	}
	public function role_edit(){
		$parm = input('get.');
		$info = Db::name('admin_role')->where(['admin_role_id'=>$parm['id']])->find();
		$info['admin_role_permission'] = json_decode($info['admin_role_permission'],true);
		$this->assign('info',$info);
		return $this->role_add();
	}
	public function role_insert(){
		$parm = input('post.');
		$T_AdminRole = new \app\admin\model\AdminRole();
		$data = $T_AdminRole->change_parm($parm);
		if (empty($data)) {
			$this->error($T_AdminRole->errorMsg(),'',true);
		}
		$data['admin_role_evalpath'] = ['EXP','CONCAT(admin_role_evalpath,LAST_INSERT_ID(admin_role_id+1))'];
		$AdminRole_insert = $T_AdminRole->insert($data);
		if (empty($AdminRole_insert)) {
			$this->error('服务器正忙...','',true);
		}
		$this->success('添加职位完成',U('Admin/role'),true);
	}
	public function role_editok(){
		$parm = input('post.');
		$T_AdminRole = new \app\admin\model\AdminRole();
		$data = $T_AdminRole->change_parm($parm);
		if ($data) {
			$this->error($T_AdminRole->errorMsg(),'',true);
		}
		if ($parm['id'] == $parm['admin_role_pid']) {
			$this->error('所属职位不能是自身','',true);
		}
		$data['admin_role_evalpath'] .= '-'.$parm['id'];

		$AdminRole_info = $T_AdminRole->where(['admin_role_id'=>$parm['id']])->find();

		Db::startTrans();
		if (!$T_AdminRole->where(['admin_role_id'=>$parm['id']])->update($data)) {
			Db::rollback();
			$this->error('暂无修改任何信息','',true);
		}

		if ($parm['id'] != 1 && $AdminRole_info['admin_role_evalpath'] !== $data['admin_role_evalpath']) {
			$AdminRole_update[] = ['admin_role_evalpath',['EXP','REPLACE(admin_role_evalpath,"'.$AdminRole_info['admin_role_evalpath'].'","'.$parm['admin_role_evalpath'].'")']];
		}
		if ($parm['id'] != 1 && $AdminRole_info['admin_role_permission'] !== $data['admin_role_permission']) {
			$AdminRole_info['admin_role_permission'] = json_decode($AdminRole_info['admin_role_permission'],true);
			foreach ($AdminRole_info['admin_role_permission'] as $k => $v) {
				if (!strpos($data['admin_role_permission'],'"'.$v.'"')) {
					if ($k > 0) {
						$AdminRole_update[] = ['admin_role_permission',['EXP','REPLACE(admin_role_permission,"\",'.$v.'\"","")']];
					}else{
						$AdminRole_update[] = ['admin_role_permission',['EXP','REPLACE(admin_role_permission,"\"'.$v.'\",","")']];
					}
				}
			}
		}
		if (!empty($AdminRole_update)) {
			if (!$T_AdminRole->where(['admin_role_evalpath'=>['LIKE',$AdminRole_info['admin_role_evalpath'].'-%']])->update($AdminRole_update)) {
				Db::rollback();
				$this->error('服务器正忙...','',true);
			}
		}

		Db::commit();
		$this->success('编辑职位完成',U('Admin/role'),true);
	}
	public function role_del(){
		$parm = input('get.');
		$T_AdminRole = new \app\admin\model\AdminRole();
		$T_AdminMenu = new \app\admin\model\AdminMenu();
		if ($parm['id'] == 1) {
			$this->error('初始超管BOSS职位不可删除','',true);
		}
		if ($T_AdminRole->where(['admin_role_pid'=>$parm['id']])->find()) {
			$this->error('此职位有下属职位，不可删除','',true);
		}
		if ($T_AdminMenu->where(['admin_role_id'=>$parm['id']])->find()) {
			$this->error('此职位有下属员工，不可删除','',true);
		}
		if (!$T_AdminRole->where(['admin_role_id'=>$parm['id']])->delete()) {
			$this->error('1服务器正忙...','',true);
		}
		$this->success('删除职位完成',U('Admin/role'),true);
	}

	//员工管理
	public function admin(){
		$T_Admin = new \app\admin\model\Admin();
		$this->assign('lists',$T_Admin->join([['dr_admin_role','dr_admin.admin_role_id = dr_admin_role.admin_role_id','left']])->order('admin_role_evalpath asc,admin_id asc')->where(['admin_role_evalpath'=>['LIKE',Session::get('admin_role_evalpath','admin').'%']])->paginate(12));
		return $this->fetch();
	}
	public function admin_add(){
		$T_AdminRole = new \app\admin\model\AdminRole();
		$AdminRole_lists = $T_AdminRole->lists();
		$this->assign('AdminRole_lists',$AdminRole_lists);
		return $this->fetch('admin_edit');
	}
	public function admin_edit(){
		$parm = input('get.');
		$T_Admin = new \app\admin\model\Admin();
		$info = $T_Admin->info($parm['id']);
		$T_AdminRole = new \app\admin\model\AdminRole();
		if (!$T_AdminRole->info($info['admin_role_id'])) {
			$this->error('职位不存在','',true);
		}
		$this->assign('info',$info);
		return $this->admin_add();
	}
	public function admin_insert(){
		$parm = input('post.');
		$T_Admin = new \app\admin\model\Admin();
		$data = $T_Admin->change_parm($parm);
		if (empty($data)) {
			$this->error($T_Admin->errorMsg(),'',true);
		}
		if (!$T_Admin->insert($data)) {
			$this->error('服务器正忙...','',true);
		}
		$this->success('添加员工完成',url('Admin/admin'),true);
	}
	public function admin_editok(){
		$parm = input('post.');
		$T_Admin = new \app\admin\model\Admin();

		$data = $T_Admin->change_parm($parm);
		if (empty($data)) {
			$this->error($T_Admin->errorMsg(),'',true);
		}
		if (!$T_Admin->where(['admin_id'=>$parm['id']])->update($data)) {
			$this->error('暂无修改任何信息','',true);
		}
		$this->success('编辑员工完成',url('Admin/staff'),true);
	}
	public function admin_del(){
		$parm = input('get.');
		$T_Admin = new \app\admin\model\Admin();
		$T_AdminRole = new \app\admin\model\AdminRole();

		$AdminRole_id = $T_Admin->where(['admin_id'=>$parm['id']])->value('admin_id');
		if (!$T_AdminRole->info($AdminRole_id)) {
			$this->error('员工不存在','',true);
		}

		if (!$T_Admin->where(['admin_id'=>$parm['id']])->delete()) {
			$this->error('服务器正忙...','',true);
		}
		$this->success('删除员工成功',U('Admin/admin'),true);
	}

	//员工操作日志
	public function admin_log(){
		$this->assign('lists',Db::name('admin_log')->order('admin_log_id desc')->field('admin_username,admin_log_name,admin_log_time,admin_log_ip')->join('admin','dr_admin_log.admin_id=dr_admin.admin_id','left')->paginate(12));
		return $this->fetch();
	}
}