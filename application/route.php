<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// 注册路由到index模块的News控制器的read操作
Route::rule('/','index/Index/index');
Route::rule('banner','index/Index/banner');

// 注册测试路由
Route::rule('/test','index/Test/index');
Route::rule('/test/work','index/Test/work');

// 注册Login路由
Route::rule('login','index/Login/index');
Route::rule('logout','index/Login/logout');
Route::rule('login/work','index/Login/loginwork');
Route::rule('verify','index/Login/verify');

// 注册Admin路由

Route::rule('admin','index/Admin/index');
Route::rule('admin/edit','index/Admin/edit');
Route::rule('admin/editupdate','index/Admin/editupdate');
Route::rule('admin/bannerupdate','index/Admin/bannerupdate');