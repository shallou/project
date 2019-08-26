<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //写出与User模型类对应的数据表
    protected $table = 'user';
    // 该模型是否被自动维护时间戳
    public $timestamps = true;
    // 可以被批量赋值的属性,在使用模型添加的时候
    // 必须设置该属性,否则添加不成功
    protected $fillable = ['name','password','email','status','token','phone'];

    // 修改器 可以自动转换获取数据字段的是 Status 字段名
    public function getStatusAttribute($value){
    	$status =[1=>'禁用',0=>'未激活',2=>'激活'];
    	return $status[$value];
    }
     // 通过user模型类和User_info模型类的关系获取当前会员下的会员详情信息
    public function info(){
        // App\Models\Userinfo 关联的userinfo模型类 user_id关联的字段
        return $this->hasOne('App\Models\Userinfo','user_id');
    }
    // 通过Uer模型类和address模型类的关系获取当前的所有收地址
    public function address(){
    	return $this->hasMany('App\Models\Useraddress','user_id');
    }
}
