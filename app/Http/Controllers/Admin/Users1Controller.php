<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型类
use App\Models\User;
// 引入哈希
use Hash;
use DB;
class Users1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // echo 2;die;
        // $k = $request->input('keywords');
        // $k1 = $request->input('keywords1');
        // $users =User::where('name','like','%'.$k.'%')->where('email','like','%'.$k1.'%')->paginate(2);
        // dd($request->all());
        // ajax 获取总条数
        $tot =User::count();
        // 每页显示的数据条数
        // dd($tot);
        $rev =2;
        // 获取最大页
        $maxpage=ceil($tot/$rev);
        for($i=1;$i<=$maxpage;$i++){
            $pp[$i]=$i;
        }
        // dd($pp);
        // echo 'ok';
        // 获取当前页
        $page=$request->input('page');
        // 判断
        if(empty($page)){
            $page=1;
        }
        // 获取偏移量
        $offset=($page-1)*$rev;
        // dd($offset);
        // 获取当前页的数据
         // $sql='select * from user limit $offset,$rev';
         $data=User::offset($offset)->limit($rev)->get();
         // dd($data);
        // 判断是ajax请求还是普通请求
        if($request->ajax()){
            // 加载ajax独立的模板
            // dd($data);
            // echo $data;
            return view('Admin.Users.page',['data'=>$data]);
        }

        return view('Admin.Users.index',['pp'=>$pp,'data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // echo 1;
        // 加载模板
        return view('Admin.users.add');

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
        $data['password']=Hash::make($data['password']);
        $data['token'] = str_random(50);
        $data['status']=1;
        // 用模型类插入数据
        if(User::create($data)){
            return redirect('/users1')->with('success','添加会员成功');
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
        //获取要修改的数据
        $info =User::where('id','=',$id)->first();
        return view('Admin.Users.edit',['info'=>$info]);

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
        //获取要修改的数据
        $data=$request->except(['_token','_method']);
        if(User::where('id','=',$id)->update($data)){
            return redirect('/users1')->with('success','修改成功');
        }else{
            return redirect('/users1/$id/edit')->with('error','修改失败');
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
        //删除
        // dd($id);
        if(User::where('id','=',$id)->delete()){
            return redirect('/users1')->with('success','删除成功');
        }else{
            return redirect('/users1')->with('error','删除成功');
        }
    }
   // 获取会员详情信息
   public function userinfo($id){
    // echo $id;
    // dd($id);
    // 
    $userinfo= User::find($id)->info;
    // dd($userinfo);
    // 加载视图
    return view('Admin.Users.info',['info'=>$userinfo]);

   }
   // 后去会员下所有收货地址
   public function useraddress($id){
    // echo $id;
    // 调用模型类的address
    $address =User::find($id)->address;
    // dd($address);
    return view('Admin.Users.address',['address'=>$address]);
   }
}
