<?php
namespace app\area\controller;
class Common extends Base {
    //上传文件-图片
    public function uploadone_img(){
        $T_File = new \app\admin\model\File();
        $res = $T_File->add(1,0);
        if (empty($res)) {
            $this->error($T_File->errorMsg(),'',true);
        }
        return json(['status'=>1,'list'=>$res]);
    }
}