<?php

namespace App\Http\Middleware;

use Closure;

class AdminLoginMiddleware
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
        // 检测后台登录用户的adminname  session值
        if($request->session()->has('adminname')){
            // 第四步.把访问模块的控制器和方法拿到,直接和权限列表进行对比
            $nodelist=session('nodelist');
            // dd($nodelist);
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            $controllerName=$func[0];
            $actionName=$func[1];           
            // echo $controllerName.':'.$actionName;
            // 权限做对比
            // 访问模块不存在或控制器存在方法不存在
            // if(empty($nodelist[$controllerName]) || !in_array($actionName,$nodelist[$controllerName])){
            //     return redirect("/admin")->with("error","sorry,您没有权限访问该模块,请联系超级管理员");
            // }
             // 访问下一个请求
             return $next($request);
        }else{
            return redirect('/adminlogin/create');
        }
       
    }
}
