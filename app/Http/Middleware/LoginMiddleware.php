<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request 请求对象
        // 中间接做数据的过滤
        // 检查是否具有登陆的session
        if($request->session()->has('email')){
            //执行下一个请求
             return $next($request);
         }else{
            // 跳转到登录界面, redirect 跳转 /login 健在登录模板的路有规则
            return redirect('/homelogin/create');
         }
       
    }
}
