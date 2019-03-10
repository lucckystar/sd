<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\File;
use think\Request;
// use JM\autoload;
use think\Loader;
class Login extends Controller{//登陆控制器

    public function user_login(){//用户登陆
        $param = input('post.');
        $User_info = Db::name('user')->where(['user_phone'=>$param['phone']])->find();
        if (empty($User_info)) {
            return returnJson(0,'1用户名或密码不正确');
        }
        if ($User_info['user_psd'] != md5($param['password'])) {
            return returnJson(0,'2用户名或密码不正确');
        }
        if ($User_info['user_status'] != 1) {
            return returnJson(0,'该用户由于违规操作已被禁用，请联系平台方解决');
        }
        if ($User_info['user_false_delete'] != 1) {
            return returnJson(0,'该用户不存在');
        }
        $User_token = md5(time().$User_info['user_id'].rand(111111,999999));
        if (!Db::name('user')->update([
            'user_token'=>$User_token,
            'user_id'=>$User_info['user_id'],
        ])) {
            return returnJson(0,'服务器正忙');
        }
        $data['user_token'] = $User_token;
        $data['jmphone'] = $param['phone'];
        $data['jmpassword'] = 'yuewu2019';
        return returnJson(1,'登录成功',$data);
    }

    //注册-发送短信验证码
    public function send_message(){
        // var_dump(EXTEND_PATH,'JMessage.autoload');exit();
        $param = input('post.');
        $User_info = Db::name('user')->where(['user_phone'=>$param['phone']])->find();
        if ($param['type'] == 1) {
            if (!empty($User_info)) {
                return returnJson(2,'该手机号已经注册过了');
            }
        }elseif ($param['type'] == 2) {
            if (empty($User_info)) {
                return returnJson(2,'该手机号还没有被注册过');
            }
        }
        $Message_info = Db::name('message')->where(['message_phone'=>$param['phone'],'message_type'=>$param['type'],'message_createtime'=>['EGT',time()-60]])->find();
        if (!empty($Message_info)) {
            return returnJson(2,'短信验证码60秒内仅能发送一次');
        }
        $rand = rand(111111,999999);
        if (!Db::name('message')->insert(['message_phone'=>$param['phone'],'message_type'=>$param['type'],'message_code'=>$rand,'message_createtime'=>time()])) {
            return returnJson(2,'服务器正忙...');
        }
        sendSMS($param['phone'],'您的短信验证码为 '.$rand.' ，如非本人操作请忽略');
        return returnJson(1,'短信发送成功');
    }

    //注册
    public function register(){
        $param = input('post.');
        $User_info = Db::name('user')->where(['user_phone'=>$param['phone']])->find();
        if (!empty($User_info)) {
            return returnJson(0,'该手机号已经注册过了');
        }
        $Message_info = Db::name('message')->where(['message_phone'=>$param['phone'],'message_code'=>$param['code'],'message_type'=>1])->find();
        if (empty($Message_info)) {
            return returnJson(0,'短信验证码不正确或已经失效');
        }
        $User_insert['user_phone'] = $param['phone'];
        $User_insert['user_psd'] = md5($param['password']);
        $User_insert['user_creattime'] = time();
        if (!Db::name('user')->insert($User_insert)) {
            return returnJson(0,'服务器正忙...');
        }
        if (!Db::name('message')->where(['message_phone'=>$param['phone'],'message_type'=>1])->delete()) {
            return returnJson(0,'服务器正忙...');
        }
        JMessage($User_insert['user_phone'],'yuewu2019');
        JM_update_information($User_insert['user_phone'],$User_insert['user_phone'],'001/initial.png');//修改为乐舞默认的昵称和头像
        $data = [
            'jmphone'=>$param['phone'],
            'jmpassword'=>'yuewu2019',
        ];
        return returnJson(1,'注册成功');
    }

    //忘记密码
    public function forget(){
        $param = input('post.');
        $User_info = Db::name('user')->where(['user_phone'=>$param['phone']])->find();
        if (empty($User_info)) {
            return returnJson(0,'该手机号还没有被注册过');
        }
        $Message_info = Db::name('message')->where(['message_phone'=>$param['phone'],'message_code'=>$param['code'],'message_type'=>2])->find();
        if (empty($Message_info)) {
            return returnJson(0,'短信验证码不正确或已经失效');
        }
        if (!Db::name('user')->where(['user_phone'=>$param['phone']])->update(['user_psd'=>md5($param['password'])])) {
            return returnJson(0,'新密码不能与旧密码一致');
        }
        if (!Db::name('message')->where(['message_phone'=>$param['phone'],'message_type'=>2])->delete()) {
            return returnJson(0,'服务器正忙...');
        }
        return returnJson(1,'重置密码成功');
    }
}