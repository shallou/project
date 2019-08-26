<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 获取城市级联数据
    public function address(Request $request){
        $upid =$request->input('upid');
       $address = DB::table('district')->where('upid','=',$upid)->get();
       echo json_encode($address);

    }
    // 插入城市级联数据
    public function insert(Request $request){
        // dd($request->all());
        $data['name']=$request->input('name');
        $data['phone']=$request->input('phone');
        $data['user_id']=session('user_id');
        $data['huo']=$request->input('huo');

        if(DB::table('address')->insert($data)){
            return back();
        }
    }
    // 获取当前用户的所有收货地址的数据
    public static function alladdress($userid){
        $alladdress = DB::table('address')->where('user_id','=',$userid)->get();
        return $alladdress;
    }

    // 切换收货地址
    public function choose(Request $request){
        $id =$request->input('address_id');
        $address = DB::table('address')->where('id','=',$id)->first();
        echo json_encode($address);
    }
    // 地址管理
    public function index()
    {
        //
        $info =DB::table('address')->get();
        // dd($info);
        return view('Home.Address.index',['info'=>$info]);
    }

    // 设置默认地址
    public function moaddress($id){
        // echo $id;
        if(empty(DB::table('address')->where('Astatus','=',2)->get())){
            DB::table('address')->where('id','=',$id)->update(['Astatus'=>2]);
            return back();
        }else{
            if(DB::table('address')->where('Astatus','=',2)->update(['Astatus'=>0])){
                 DB::table('address')->where('id','=',$id)->update(['Astatus'=>2]);
                  return back();
                }

        }


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
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
        $info =DB::table('address')->where('id','=',$id)->first();
        // dd($info);
        return view('Home.Address.edit',['info'=>$info]);

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
        // 修改地址
        // dd($request->all());
        $data['name']=$request->input('name');
        $data['phone']=$request->input('phone');
        $data['huo']=$request->input('huo');
        // dd($data);
        if(DB::table('address')->where('id','=',$id)->update($data)){
            return redirect('/Address');
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
        echo $id;
    }
}
