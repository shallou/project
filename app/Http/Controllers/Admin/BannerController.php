<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $info = DB::table('banner')->join('user','banner.user_id','=','user.id')->select('user.id as uid','banner.id as bid','user.name','banner.banner','banner_id','banner.user_id')->paginate(5);
        // dd($info);
        return view('Admin.Banner.index',['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $info = DB::table('user')->get();
        // dd($info);
        // foreach()
        return view('Admin.Banner.add',['info'=>$info]);
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
        $data=$request->except(['_token']);
        // dd($data);
        if($data['user_id'] != 0){
            if($data['banner_id'] != 0){
                // echo 1;
                // 获取用户的id
                $a=$data['banner_id'];
                $b='banner'.$a;
                // dd($b);
                // $data[$b] =$a;
                 // dd($data);
                // dd($data);
                // 图片限制
                if(count($info=DB::table('banner')->where('user_id','=',$data['user_id'])->get())<=4){
                    // dd($info);
                    if($request->hasFile('banner')){
                    $name=time();
                    $ext=$request->file('banner')->getClientOriginalExtension();
                    $request->file('banner')->move('./static/Homes/theme/img/ad',$name.'.'.$ext);
                    $data['banner'] ='/static/Homes/theme/img/ad/'.$name.'.'.$ext;
                    // dd($data);
                    if(DB::table('banner')->insert($data)){
                        return redirect('/banner')->with('success','添加成功');
                    }else{
                        return back()->with('error','添加失败');
                    }

                    }else{
                        return back()->with('error','请选择一张图片');
                    }
                }else{
                    return back()->with('error','抱歉,轮播图只能添加五张');
                }


            }else{
                return back()->with('error','请选择一条轮播图类别');
            }
        }else{
             return back()->with('error','请选择一个用户类别');
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
        $info =DB::table('banner')->where('id','=',$id)->first();
        // dd($info);
        return view('Admin.Banner.edit',['info'=>$info]);
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
         // $data['banner'] = $request->input('banner');
         // dd($data);
         if($request->hasFile('banner')){
            $name=time();
            $ext=$request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move('./static/Homes/theme/img/ad',$name.'.'.$ext);
            $data['banner'] ='/static/Homes/theme/img/ad/'.$name.'.'.$ext;
            // dd($data);
            if(DB::table('banner')->where('id','=',$id)->update($data)){
                return redirect('/banner')->with('success','添加成功');
            }else{
                return back()->with('error','添加失败');
            }

        }else{
                return back()->with('error','请选择一张图片');
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
        if(DB::table('banner')->where('id','=',$id)->delete()){
            return redirect('/banner')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
