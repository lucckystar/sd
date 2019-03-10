<?php
namespace app\admin\model;
use think\Model;
class AdminMenu extends Model{
	public function menu_wipeout($AdminMenu_list = [],$admin_role_permission = []){
		foreach ($AdminMenu_list as $k => $v) {
			if (!in_array($v['admin_menu_id'],$admin_role_permission)) {
				unset($AdminMenu_list[$k]);
			}
		}
		return $AdminMenu_list;
	}

	public function menu_multi_list($AdminMenu_list = []){
		if (empty($AdminMenu_list)) {
			return [];
		}
		$AdminMenu_list = collection($AdminMenu_list)->toArray();
		foreach ($AdminMenu_list as $k => $v) {
			if ($v['admin_menu_pid'] == 0) {
				$v['menu_menu'] = [];
				$return_arr[] = $v;
				unset($AdminMenu_list[$k]);
			}
		}
		$return_arr = $this->menu_nest_list($AdminMenu_list,$return_arr);
		return $return_arr;
	}
	private function menu_nest_list($AdminMenu_list,$return_arr){
		foreach ($return_arr as $k => $v) {
			foreach ($AdminMenu_list as $k1 => $v1) {
				if ($v['admin_menu_id'] == $v1['admin_menu_pid']) {
					$v1['menu_menu'] = [];
					$return_arr[$k]['menu_menu'][] = $v1;
					unset($AdminMenu_list[$k1]);
				}
			}
			if (!empty($return_arr[$k]['menu_menu'])) {
				$return_arr[$k]['menu_menu'] = $this->menu_nest_list($AdminMenu_list,$return_arr[$k]['menu_menu']);
			}
		}
		return $return_arr;
	}

	// public function menu_view_3j($menuList){
	// 	if (empty($menuList)) {
	// 		return [];
	// 	}
	// 	$menuList = collection($menuList)->toArray();
	// 	$return_list = [];
	// 	foreach ($menuList as $k => $v) {
	// 		if ($v['menu_pid'] == 0) {
	// 			$v['menu_menu'] = [];
	// 			foreach ($menuList as $k1 => $v1) {
	// 				$v1['menu_menu'] = [];
	// 				foreach ($menuList as $k2 => $v2) {
	// 					$v2['menu_menu'] = [];
	// 					$v1['menu_menu'][] = $v2;
	// 					unset($menuList[$k1]);
	// 				}
	// 				$v['menu_menu'][] = $v1;
	// 				unset($menuList[$k1]);
	// 			}
	// 			$return_list[] = $v;
	// 			unset($menuList[$k]);
	// 		}
	// 	}
	// 	return $return_list;
	// }

	public function nav_list($AdminMenu_info){
		$nav_list[] = $AdminMenu_info;
		while ($AdminMenu_info['admin_menu_pid'] > 0) {
			$AdminMenu_info = $this->where(['admin_menu_id'=>$AdminMenu_info['admin_menu_pid']])->find();
			$nav_list[] = $AdminMenu_info;
		}
		$nav_list = array_reverse($nav_list);
		return $nav_list;
	}

	public function sort($list,$pid = 0,$return_list = []){
		foreach ($list as $k => $v) {
			if ($pid == $v['admin_menu_pid']) {
				$return_list[] = $v;
				unset($list[$k]);
				$return_list = $this->sort($list,$v['admin_menu_id'],$return_list);
			}
		}
		return $return_list;
	}
}