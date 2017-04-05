<?php
/**
 * Author: Postbird
 * Date  : 2017/3/21
 * time  : 9:37
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */
namespace app\index\controller;

use think\Config;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\Session;

class Login extends Controller{
    // 用户登录
    public function index(){
        // $salt=sha1(time().openssl_random_pseudo_bytes(1));
        // $pass=md5($password.$salt);
        return $this->fetch();
    }
    // 用户登录处理
    public function loginwork(Request $request){
        $name=trim($request->param('name','post'));
        $password=trim($request->param('password','post'));
        $captchaCode=trim($request->param('captcha','post'));
        // 验证码
        if (!captcha_check($captchaCode)) {
            $this->error('验证码错误');
            return ;
        }
        // 查询用户信息
        $userInfo=Db::name('admin')->where(['name'=>$name])->find();
        $passwordCode=md5($password.$userInfo['salt']);
        // 管理员不存在
        if(count($userInfo)==0 || $passwordCode!=$userInfo['password']){
            $this->error('用户或密码错误');
        }
        // 登录成功
        Session::set('loginuser',$name);
        Session::set('loginflag',Config::get('login.flag'));
        Session::set('logincheck',md5($name.Config::get('login.flag')));
        $this->redirect(url('/admin'));

    }
    // 退出登陆
    public function logout(){
        Session::delete('loginuser');
        Session::delete('loginflag');
        Session::delete('logincheck');
        $this->redirect('/login');
    }
    // 验证码
    public function verify(){

    }
}