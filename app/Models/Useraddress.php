<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Useraddress extends Model
{
    //
    //定义与模型关联的数据表
    protected $table = 'address';
    // 模型自动维护时间戳 
    public $timeStamps =false;
    // 主键
    protected $primaryKey ="id";
}
