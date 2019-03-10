<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;

class Invitation extends Controller{//招聘邀请控制器
    
    public function invitation_list(){//1.09.01招聘大厅
        $district_id = input('district_id');//地区id
        if (!$invitation_list = Db::name('organization')->alias('a')->join('invitation b','a.organization_district_id = b.invitation_id')->where('a.organization_state',1)->where('organization_false_delete',1)->where('a.organization_district_id',$district_id)->field('b.invitation_id,a.organization_name,b.invitation_explain')->select()) {
        	return returnJson(0,'邀请服务器正忙...');
        }
        return returnJson(1,'',$invitation_list);//(状态码1:正常,提示,返回值)
    }

    public function invitation_find(){//1.09.02招聘详情
        $invitation_id = input('invitation_id');//邀请函id
        if (!$invitation_find = Db::name('invitation')->alias('a')->join('organization b','a.invitation_organization_id = b.organization_id','left')->where('invitation_organization_id',$invitation_id)->field('b.organization_name,a.invitation_contact,a.invitation_interview_site,a.invitation_interview_time,a.invitation_dance_type,a.invitation_age_demand,a.invitation_explain,a.invitation_organization_picture,a.invitation_organization_picture2,a.invitation_phone')->find()) {
        	return returnJson(0,'邀请服务器正忙...');
        }
        return returnJson(1,'',$invitation_find);//(状态码1:正常,提示,返回值)
    }
}