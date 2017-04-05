<?php
/**
 * Author: Postbird
 * Date  : 2017/3/22
 * time  : 19:48
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */
namespace app\index\controller;

use think\Controller;
use think\Request;

class Test extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function work(Request $request){
        $captcha=$request->param('captcha','post');
        dump($captcha);
        dump(captcha_check($captcha));
    }
}
