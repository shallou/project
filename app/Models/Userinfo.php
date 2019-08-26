<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    //定义与模型关联的数据表
    protected $table = 'user_info';
    // 模型自动维护时间戳 
    public $timeStamps =false;
}
