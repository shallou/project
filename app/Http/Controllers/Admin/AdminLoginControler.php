<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB类
use DB;
// 引入哈希类
use Hash;
class AdminLoginControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        // 销毁session 
        $request->session()->pull('adminname');
        $request->session()->pull('nodelist');

        return redirect('/adminlogin/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载后台登录的模板
        return view('Admin.AdminLogin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        // 获取登录的管理员名称和密码
        $name =$request->input('name');
        $password = $request->input('password');
        // 检测管理员名字
        $info  = DB::table('admin_users')->where('name','=',$name)->first();
        if($info){
            // echo 'name';
            // 检测密码
            if(Hash::check($password,$info->password)){
                // echo '1';
                // 设置用户登录的session name值
                session(['adminname'=>$name]);
                // 1.获取后台登录用户的所有的权限信息
                $list =DB::select("select n.name,n.mname,n.aname from user_role as ur,role_node as rn,node as n where ur.rid=rn.rid and rn.nid=n.id and uid={$info->id}");
               // dd($list);
                // 2.初始化权限 让所有的后台管理员都具有后台首页的权限
                $nodelist['AdminController'][]='index';
                foreach($list as $k=>$v){
                    // 把当前登录的用户权限写入到$nodelist
                    $nodelist[$v->mname][]=$v->aname;
                    // 如果有哦create方法.添加store
                    if($v->aname =='create'){
                        $nodelist[$v->mname][]='store';
                    }
                    // 如果有edit方法.添加update
                    if($v->aname == 'edit'){
                        $nodelist[$v->mname][]="update";
                    }
                }
                // dd($nodelist);
                // 3.把所有登录用户的所有权限信息储存在session
                session(['nodelist'=>$nodelist]);
                //直接跳转到后天首页
                return redirect('/admin')->with('success','登录成功');
            }else{
                return back()->with('error','密码有误');
            }
        }else{
            return back()->with('error','管理员有误');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
