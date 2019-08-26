<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Userinsert1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // 给表单校验类授权
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // 限制规则
    public function rules()
    {
        return [
            // 名字的规则 required 不能为空的规则 unique唯一 regex正则
            'username'=>'required|regex:/\w{4,8}/|unique:users',
            // 密码规则
            'password'=>'required|regex:/\w{2,8}/',
            // 确认密码规则
            'repassword'=>'required|same:password',
            // 邮箱规则
            'email'=>'required|email|unique:users',
            // 电话
            'phone'=>'required|regex:/\w{11}/|unique:users',
        ];
    }
    // 自定义错误
    public function messages(){
        return [
            //显示名字字段的自定义错误消息
            "username.required"=>"名字不能为空",
            "username.regex"=>"名字必须是4-8位的数字字母或者下划线",
            "username.unique"=>"名字不能重复",
            "password.required"=>"密码不能为空",
            "password.regex"=>"密码必须是6-18位的数字字母或者下划线",
            "repassword.required"=>"确认密码不能为空",
            "repassword.same"=>"两次密码不一致",
            "email.required"=>"邮箱不能为空",
            "email.email"=>"邮箱格式不对",
            "email.unique"=>"邮箱不能重复",
            "phone.required"=>"电话不能为空",
            "phone.regex"=>"电话格式不对",
            "phone.unique"=>"电话不能重复",
        ];
    }
}
