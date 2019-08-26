<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $auth =DB::table('node')->paginate(5);
        return view('Admin.Auth.index',['auth'=>$auth]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Auth.add');
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
        // 
        if(DB::table('node')->insert($data)){
            return redirect('/auth')->with('success','添加权限成功');
        }else{
            return back()->with('error','添加权限失败');
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
        $info = DB::table('node')->where('id','=',$id)->first();
        // dd($info);
        return view('Admin.Auth.edit',['info'=>$info]);
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
        // dd($request->all());
        
        $data =$request->except(['_token','_method']);
        // dd($data);
        // dd($id);
        if(DB::table('node')->where('id','=',$id)->update($data)){
            return redirect('/auth')->with('success','修改成功');
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
        if(DB::table('node')->where('id','=',$id)->delete()){
            return redirect('/auth')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
