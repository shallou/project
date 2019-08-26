<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取角色
        $role =DB::table('role')->paginate(5);
        // dd($role);
        return view('Admin.Role.index',['role'=>$role]);
    }
    // 分配权限
    public function adminauth($id){
        // echo $id;
        // 获取角色信息
        $role = DB::table('role')->where('id','=',$id)->first();
        // 获取所有权限
        $node = DB::table('node')->get();
        // 获取当前角色权限
        $data = DB::table('role_node')->where('rid','=',$id)->get();
        if(count($data)){
            foreach($data as $key=>$value){
                $nids[]=$value->nid;
            }
            return view('Admin.Role.auth',['role'=>$role,'auth'=>$node,'nids'=>$nids]);
        }else{
            return view('Admin.Role.auth',['role'=>$role,'auth'=>$node,'nids'=>array()]);
        }
        

    }
    // 保存权限
    public function saveauth(Request $request){
        $rid = $request->input('rid');
        // echo $rid;
        // 分配的权限
        $nids=$_POST['nids'];
        // dd($nids);
        // 删除之前权限信息
        DB::table('role_node')->where('rid','=',$rid)->delete();
        // 数据添加role_node
        foreach($nids as $v){
            $data['nid']=$v;
            $data['rid']=$rid;
            DB::table('role_node')->insert($data);
        }
        return redirect('/role')->with('success','添加权限成功');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加角色视图
        return view('Admin.Role.add');

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
        $data =$request->except(['_token']);
        // dd($data);

        if(DB::table('role')->where('name','=',$data['name'])->first()){
            // echo '1';
            return back()->with('error','sorry,该管理员已存在');
        }else{
            // echo '2';
            DB::table('role')->insert($data);
            return redirect('/role')->with('success','添加角色成功');
        }
        dd();

        // $info =DB::table('role')->get();
        
        // // dd($info);
        // $infos[]=$info;
        // // dd($info);
        // // $data1=1;
        // $datas=in_array($data,$infos);
        //     dd($datas);

        // if(!in_array($data,$infos)){
        //     return back()->with('error','sorry,该管理员已存在');
        // }else{
        //     DB::table('role')->insert($data);
        //     return redirect('/role')->with('success','添加角色成功');
        // }

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
        // echo $id;
        $info =DB::table('role')->where('id','=',$id)->first();
        // dd($info);
         return view('Admin.Role.edit',['info'=>$info]);
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
        // echo $id;
        // dd($request->all());
        $name = $request->input('name');
        if(DB::table('role')->where('id','=',$id)->update(['name'=>$name])){
            return redirect('/role')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败,名称已重复');
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
        if(DB::table('role')->where('id','=',$id)->delete()){
             return redirect('/role')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
