<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB类
use DB;
// 引入哈希类
use Hash;
// // 引入表单校验类
// use  App\Http\Requests\AdminUserinsert;
class AdminusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //添加
      $user = DB::table('admin_users')->paginate(2);
      // 加载模板
      return view('Admin.Adminuser.index',['user'=>$user]);
    }
    // 分配角色
    public function adminuserrole($id){
        // 获取用户的信息
        $info = DB::table('admin_users')->where('id','=',$id)->first();
        // 获取所有的角色信息
        $role =DB::table('role')->get();
        // 获取当前登录的用户角色信息
        $data =DB::table('user_role')->where('uid','=',$id)->get();
        // dd($info);
        // echo $id;
        if(count($data)){
            foreach($data as $key=>$value){
                // 当前所有的角色ID
                $rids[]=$value->rid;
            }
        // 加载模板分配角色
        return view('Admin.Adminuser.role',['info'=>$info,'role'=>$role,'rids'=>$rids]);
        }else{
             return view('Admin.Adminuser.role',['info'=>$info,'role'=>$role,'rids'=>array()]);
        }
       
    }
    // 保存角色
    public function severole(Request $request){
        // 把新选择的角色插入到
        // 获取用户的id
        $uid =$request->input('uid');
        // echo $uid;
        // echo 1;
        // 获取分配的角色
        $rids = $_POST['rids'];
        // var_dump($reds);
        // 删除之前的角色信息
        DB::table('user_role')->where('uid','=',$uid)->delete();
        // 存入到数据库
        foreach($rids as $k=>$v){
            $data['uid']=$uid;
            $data['rid']=$v;
            DB::table('user_role')->insert($data);
        }
        return redirect('/adminusers')->with('success','分配角色成功');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加
        return view('Admin.Adminuser.add');
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
        $data = $request->except(['_token']);
        // 密码加密
        $data['password'] =Hash::make($data['password']);
        // 执行数据插入
        if(DB::table('admin_users')->insert($data)){
            return redirect('/adminusers')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $info =DB::table('admin_users')->where('id','=',$id)->first();
        // dd($info);
        return view('Admin.Adminuser.edit',['info'=>$info]);
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
        $data = $request->input('name');
        // dd($data);
        if(DB::table('admin_users')->where('id','=',$id)->update(['name'=>$data])){
            return redirect('/adminusers')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
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
        // echo $id;
        if(DB::table('admin_users')->where('id','=',$id)->delete()){
            return redirect('/adminusers')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}
