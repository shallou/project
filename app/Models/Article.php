<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     //写出与User模型类对应的数据表
    protected $table = 'articles';
    // 该模型是否被自动维护时间戳
    public $timestamps = false;
    // 可以被批量赋值的属性,在使用模型添加的时候
    // 必须设置该属性,否则添加不成功
    protected $fillable = ['title','descr','thumb','editor'];
}
