<?php
/**
 * Author: Postbird
 * Date  : 2017/3/21
 * time  : 9:37
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */
namespace app\index\controller;

use app\index\controller\Common;
use app\index\model\Banner as BannerModel;
use think\Db;
use think\Request;
use think\Session;
use think\Validate;

class Admin extends Common{

    public function index(){
        // 查询banner图
        $banner=BannerModel::all();
        //
        $this->assign('banner',$banner);
        return $this->fetch();
    }
    // +----------------------------------------------------------------------
    // | 编辑轮播图处理
    // | post 参数 title[] - url[] - img[]
    // +----------------------------------------------------------------------
    public function bannerupdate(Request $request){
        // 接收参数
        $param=$request->post();
        $user = new BannerModel();
        // 更新数据
        for($i=0;$i<count($param['title']);$i++){
            $user->save([
                'title' =>  $param['title'][$i],
                'url'   =>  $param['url'][$i],
                'img'   =>  $param['img'][$i]
            ],['id' => $param['imgd'][$i]]);
        }
        // 更新成功
        Session::flash('msg','操作成功');
        Session::flash('error',0);
        $this->redirect(url('/admin'));
    }
    // +----------------------------------------------------------------------
    // | 编辑管理员信息
    // +----------------------------------------------------------------------
    public function edit(){
        return $this->fetch();
    }
    // +----------------------------------------------------------------------
    // | 编辑管理员信息 处理
    // | post ： password | newpassword | newpasswordagain
    // +----------------------------------------------------------------------
    public function editupdate(Request $request){
        $param=$request->post();
        // 获得登录的admin用户
        $name=Session::get('loginuser');
        // 查询信息
        $adminInfo=Db::name('admin')->where(['name'=>$name])->find();
        // 不存在
        if(count($adminInfo)==0){
            $this->redirect(url('/admin/edit'));
        }
        // 生成密码
        $param['password']=md5($param['password'].$adminInfo['salt']);
        if($param['password'] != $adminInfo['password']){
            Session::flash('msg','原密码不符');
            Session::flash('error',1);
            $this->redirect(url('/admin/edit'));
        }
        //
        if($param['newpassword'] !=$param['newpasswordagain'] ){
            Session::flash('msg','两次密码不匹配');
            Session::flash('error',1);
            $this->redirect(url('/admin/edit'));
        }
        // 生成新的salt 和 密码
        $salt=sha1(time().openssl_random_pseudo_bytes(1));
        $pass=md5($param['newpassword'].$salt);
        $data=[
            'salt'=>$salt,
            'password'=>$pass
        ];
        // 数据库写入新的salt和密码
        $result=Db::name('admin')->where(['id'=>$adminInfo['id']])->update($data);
        if($result){
            Session::flash('msg','操作成功');
            Session::flash('error',0);
        }else{
            Session::flash('msg','操作失败');
            Session::flash('error',1);
        }
        // 修改成功
        $this->redirect(url('/admin/edit'));
    }
}
