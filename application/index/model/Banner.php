<?php
/**
 * Author: Postbird
 * Date  : 2017/3/23
 * time  : 11:14
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */
namespace app\index\model;

use think\Model;

class Banner extends Model{
    // 数据表名
    protected $name='banner';
    // 开启自动写入时间戳字段
    protected $type       = [
        'auto_timestamp' => true,
    ];
}
