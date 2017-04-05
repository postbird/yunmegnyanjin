<?php
/**
 * Author: Postbird
 * Date  : 2017/3/21
 * time  : 9:38
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */

namespace app\index\controller;

use think\Config;
use think\Controller;
use think\Session;

class Common extends Controller {
    // 整体权限控制
    public function _initialize()
    {
        // 登录成功
        $name=Session::get('loginuser');
        $login=Session::get('loginflag');
        $check=Session::get('logincheck');
        if(strlen($name)==0 || $login!=Config::get('login.flag') || $check!=md5($name.$login)){
            $this->redirect(url('/login'));
        }
    }


//----------------------------------------------------------------------
//                          【 以下是一些说明 】
//----------------------------------------------------------------------
    /**
     *  密码加密使用加salt MD5算法
     *
        $salt=sha1(time().openssl_random_pseudo_bytes(1));
        $pass=md5($password.$salt);
     *
     *  需要先查出salt再进行密码的验证操作
     */
}

