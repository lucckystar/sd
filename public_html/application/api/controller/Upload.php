<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class Upload extends Controller{//上传控制器
    
    public function upload_file(){
        $file_type = input('file_type');
        $file = request()->file('file');
        if ($file_type == 1) {//file_type为1视频
            $info = $file->validate(['size'=>99999999999999999999999,'ext'=>'mp4'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
            // 成功视频上传后 获取上传信息
                $video = $info->getSaveName();
                return returnJson(1,'成功',$video);
            }else{
                $defeated =  $file->getError();
                return returnJson(0,$defeated);
            }
        }
        if ($file_type == 2) {
            $info = $file->validate(['size'=>99999999,'ext'=>'mp3'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $music = $info->getSaveName();
                return returnJson(1,'成功',$music);
            }else{
                // 上传失败获取错误信息
                $defeated = $file->getError();
                return returnJson(0,$defeated);
            }
        }
        if ($file_type == 3) {
            $info = $file->validate(['size'=>99999999,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
            // 成功上传后 获取上传信息
                $image = $info->getSaveName();
                return returnJson(1,'成功',$image);
            }else{
                // 上传失败获取错误信息
                $defeated =  $file->getError();
                return returnJson(0,$defeated);
            }
        }
    }












 //    public function upload_image(){//上传图片反馈
 //    // 获取表单上传文件 例如上传了001.jpg
 //    $file = request()->file('image');
 //    // 移动到框架应用根目录/public/uploads/ 目录下
 //    $info = $file->validate(['size'=>119298,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
 //    if($info){
 //        // 成功上传后 获取上传信息
 //        $image = $info->getSaveName();
 //        return returnJson(1,'成功',$image);
 //    }else{
 //        // 上传失败获取错误信息
 //        $defeated =  $file->getError();
 //        return returnJson(0,'失败',$defeated);
 //    	}
	// }

 //    public function upload_video(){///视频上传反馈
 //    	$file = request()->file('video');
	//     // 移动到框架应用根目录/public/uploads/ 目录下
	//     $info = $file->validate(['size'=>99999999999999999999999,'ext'=>'mp4'])->move(ROOT_PATH . 'public' . DS . 'uploads');
 //        // $info = $file->validate(['size'=>99999999999,'ext'=>'avi,wma,mp4'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	//     if($info){
	//         // 成功上传后 获取上传信息
	//         $video = $info->getSaveName();
	//         return returnJson(1,'成功',$video);
	//     }else{
	//         // 上传失败获取错误信息
	//         $defeated =  $file->getError();
	//         return returnJson(0,'失败',$defeated);
	//     }
 //    }

 //    public function upload_music(){//音乐上传反馈
 //        $file = request()->file('music');
 //        // 移动到框架应用根目录/public/uploads/ 目录下
 //        $info = $file->validate(['size'=>99999999,'ext'=>'mp3'])->move(ROOT_PATH . 'public' . DS . 'uploads');
 //        // $info = $file->validate(['size'=>99999999,'ext'=>'mp3,wma,flac'])->move(ROOT_PATH . 'public' . DS . 'uploads');
 //        if($info){
 //            // 成功上传后 获取上传信息
 //            $music = $info->getSaveName();
 //            return returnJson(1,'成功',$music);
 //        }else{
 //            // 上传失败获取错误信息
 //            $defeated = $file->getError();
 //            return returnJson(0,'失败',$defeated);
 //        }
 //    }

 //    public function index_upload(){//文件上传
 //    	$index_file = input('psot.');
 //    	$user = Db::name('user')->where('user_token',$index_file['user_token'])->find();
 //    	$file_insert = [
 //    		'district_id'=>$index_file['district_id'],
 //    		'dance_type_id'=>$index_file['dance_type_id'],
 //    		'file_cover'=>$index_file['file_cover'],
 //    		'file_content'=>$index_file['file_content'],
 //    		'file_name'=>$index_file['file_name'],
 //    		'file_type'=>$index_file['file_type'],
 //    		'file_category'=>$index_file['file_category'],
 //    		'file_creattime'=>time(),
 //    		'district_id'=>$index_file['district_id'],
 //    		'district_id'=>$index_file['district_id'],
 //    	];
 //    	$file_insert = Db::name('file')->getLastInsID($file_insert);
 //    	$file_user_insert = [
 //    		'user_id'=>$user['user_id'],
 //    		'file_id'=>$file_insert,
 //    	];
 //    	$file_user = Db::name('file_user')->insert($file_user_insert);
 //    	if ($file_user) {
 //    		return returnJson(1,'成功');
 //    	}
 //    }
}