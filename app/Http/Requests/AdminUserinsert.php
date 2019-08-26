<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserinsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // 给表单校验授权
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // 设置规则
    public function rules()
    {
        return [
            //名字的规则 required 不能为空的规则 unique 唯一 users 表明
            'username'=>'required|regex:/\w{2,8}/|unique:users',
            'password'=>'required|Regex:/\w{6,8}/',
            // 确认密码规则
            'repassword'=>'required|same:password',
            // 邮箱的guize
            'email'=>'required|email|unique:users',
            // 电话的规则
            'phone'=>'required|regex:/\d{11}/|unique:users',

        ];
    }
    // 自定义错误信息
    public function messages(){
        return[
            // 显示 名字字段的自定义的错误信息
            "username.required"=>'名字不能为空',
            'username.unique'=>'名字不能重复',
            'username.regex'=>"名字必须是2-8位的数字字母或者下划线",
             "password.required"=>'密码不能为空',
            'password.regex'=>"密码必须是2-8位的数字字母或者下划线",
            "repassword.required"=>'确认密码不能为空',
            'repassword.same'=>'两次密码不一致',
            "email.required"=>'邮箱不能为空',
            'email.unique'=>'邮箱不能重复',
            'email.email'=>"邮箱格式不符合要求",
              "phone.required"=>'电话不能为空',
            'phone.unique'=>'电话不能重复',
            'phone.regex'=>"电话格式不符合要求",


        ];
    }
}
