<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 个人中心
    public function personal(){
        // dd(session('user_id'));
        $info = DB::table('user')->where('id','=',session('user_id'))->first();
        return view('Home.HomePublic.Home',['info'=>$info]);
    }
    public function personals(){
        return view('Home.Personal.personal');
    }


    // 订单管理
    public function orderform(){
        $info = DB::table('address')->join('orders','orders.address_id','=','address.id')->join('order_goods','order_goods.order_id','=','orders.id')->where('orders.user_id','=',session('user_id'))->select('address.id as aid','address.name as aname','address.phone','address.user_id as auser_id','address.huo','orders.id','orders.order_num','orders.user_id as oid','address_id','orders.status','order_goods.id as gid','order_goods.order_id','order_goods.goods_id','order_goods.name as gname','order_goods.num','order_goods.pic','order_goods.tot','order_goods.statuss')->get();
        // $info =DB::table('address')->join('orders','orders.address_id','=',"address.id")->join('order_goods','order_goods.order_id','=','orders.id')->where('orders.user_id','=',session('user_id'))->get();
        // dd($info);
        // $user_info = DB::table('user')->where('id','=',session('user_id'))->first();
        // dd(session('goods'));
        // session(['user_info'=>$user_info]);
        // dd(session('user_info'));
        // dd($info);
        return view('Home.Personal.orderform',['info'=>$info]);
    }
    // // 支付操作
    public function orderpays($id){
        // echo $id;
        $data=[];
        $data1=[];

        $info =DB::table('order_goods')->join('orders','order_goods.order_id','=','orders.id')->where('order_goods.id','=',$id)->select('order_goods.id as gid','orders.id as oid','orders.address_id','orders.address_id','orders.status','order_goods.goods_id','order_goods.name','order_goods.num','order_goods.pic','order_goods.tot')->get();
      
        // dd($info);
        foreach($info as $k=>$v){
             $data['address_id']=$v->address_id;
             $data['order_num']=time()+rand(1,10000);
             $data['user_id']=session('user_id');
             $data['status'] =0;//未支付
             // $data1[]
        }
        // 生成订单
        if($ids=DB::table('orders')->insertGetid($data)){
            // echo 1;
            foreach($info as $k=>$v){
                $data1['order_id']=$ids;
                $data1['goods_id']=$v->goods_id;
                $data1['name']=$v->name;
                $data1['num']=$v->num;
                $data1['pic']=$v->pic;
                $data1['tot']=$v->tot;

            }
        }
        // 生成订单详情
        if(DB::table('order_goods')->insert($data1)){
                session(['order_id'=>$ids]);
                session(['address_id'=>$data['address_id']]);
                session(['tot'=>$data1['tot']]);

             // 订单号
                $out_trade_no =$data['order_num'];
                // 主题
                $subject="zhifu";
                // 金额
                $total_fee ='0.01';
                // 描述
                $body='shop pay';
                // 调用支付宝接口
                pays($out_trade_no,$subject,$total_fee,$body);


        }
        // dd($data);
       
    }
    // 取消订单操作
    public function quxiao($id){
        // echo $id;
        if(DB::table('orders')->where('id','=',$id)->delete()){
            // echo '111';
            DB::table('order_goods')->where('order_id','=',$id)->delete();
            return redirect('/orderform');
        }
    }
    // 确认收货 1 收货
    public function querenhuoshou($id){

        if(DB::table('order_goods')->where('id','=',$id)->update(['statuss'=>1])){
            return redirect('/orderform');
        }
    }

    // 我的账户
    public function account(){

        return view('Home.Personal.account'); 
    }
    // 设置密保问题
    public function encrypted(){

        return view('Home.Personal.encrypted');
    }
    // 保存密保问题
    public function encrypteds(Request $request,$id){
        // dd($id);
        // dd($request->all());
        $data =$request->except(['_token']);
        $data['user_id']=$id;
        // dd($data);
        // $data1 =DB::table('encrypted')->where('user_id','=',$id)->get();
        // dd($data1);
        if(count(DB::table('encrypted')->where('user_id','=',$id)->get())==0){
            echo 1;
            if(DB::table('encrypted')->insert($data)){
                return redirect('/account');
                // echo 1;
            }else{
                return back();
            }
        }
        return back();
    }

    public function index()
    {
        //
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
