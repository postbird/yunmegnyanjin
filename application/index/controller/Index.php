<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        $this->redirect("http://www.ptbird.cn",302);
    }
    public function banner(Request $request){
        $data=Db::name('banner')->field('title,url,img')->select();
//       $data=[
//           [
//               'title'=>'发展对象评审答辩会圆满结束',
//               'url'=>'https://mp.weixin.qq.com/s/0hcue8r9Eo3ht7eUUeJF1A',
//               'img'=>'http://static.ptbird.cn/02/theme/images/1.png'
//           ],
//           [
//               'title'=>'智者切磋，擂台争霸',
//               'url'=>'http://mp.weixin.qq.com/s/aLRjxgZKTwzxf5Do5zp62g',
//               'img'=>'http://static.ptbird.cn/02/theme/images/3.png'
//           ],
//           [
//               'title'=>'党员话民生"热点问题分享交流会会',
//               'url'=>'https://mp.weixin.qq.com/s/l_FJRT_LwXj0XcDyfUB5rg',
//               'img'=>'http://static.ptbird.cn/02/theme/images/2.png'
//           ],
//       ];
        return json($data)->code(201)->header(['Cache-control' => 'no-cache,must-revalidate','Access-Control-Allow-Origin'=>'*']);
    }
}
