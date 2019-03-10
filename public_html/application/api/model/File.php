<?php
namespace app\admin\model;
use think\Model;
class File extends Model{
	public function info($id,$type=1){
		return $this->where(['file_id'=>$id,'file_type'=>$type])->find();
	}
	public function add($file_type = 0,$file_maxSize = 0){
		$file = request()->file('Filedata');
		if(empty($file)){
			$this->errorMsg('文件不存在');
			return false;
	    }

		if (!empty($file_type)) {
			$filetype_arr = [
				1 => ['jpg','gif','png','jpeg'],
				2 => ['mp4','3gp','rmvb'],
				3 => ['mp3','wam'],
			];
			$file = $file->validate(['size'=>3145728,'ext'=>$filetype_arr[$file_type]]);
		}

        $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
        if (empty($info)) {
        	$this->errorMsg($file->getError());
        	return false;
        }

        $file_add = ['file_path'=>$info->getSaveName(),'file_size'=>$info->getInfo()['size'],'file_type'=>$file_type];
		$res = $this->insertGetId($file_add);

        return ['id'=>$res,'path'=>$file_add['file_path']];
	}
}
