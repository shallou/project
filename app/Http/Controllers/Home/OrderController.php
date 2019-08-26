<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 结算请求 吧勾选的商品存储在session 方便结算页做遍历
    public function jiesuan(Request $request){
        $arr = $_GET['arr'];
        $data =array();
        foreach($arr as $key=>$value){
            // 获取购物车里面的session
            $cart =session('cart');
            // 遍历
            foreach($cart as $k=>$v){
                // 判断
                if($value ==$v['id']){
                    // 把勾选的商品数量和id存储在数组limian
                    $data[$k]['num'] =$cart[$k]['num'];
                    $data[$k]['id'] =$value;
                }
            }
        }
        // 把每勾选一条数据存储在session里
        $request->session()->push('goods',$data);
        echo json_encode($data);
    }
    // 跳转订单界面
    public function insert(){
        // 获取勾选的商品
        $goods=session('goods');
        // dd($goods);
        $d =[];
        $tot ='';
        foreach($goods[0] as $key=>$value){
            // 获取商品数据
            $shop =DB::table('shops')->where('id','=',$value['id'])->first();
            $temp['num'] =$value['num'];
            $temp['pic'] =$shop->pic;
            $temp['name'] = $shop->name;
            $temp['price'] =$shop->price;
            $tot+=$value['num']*$shop->price;
            $d[] =$temp;
        }

        // 获取当前用户的所有的收货地址
       $address =AddressController::alladdress(session('user_id'));
       // 获取第一条数据
       $addressfirst = DB::table('address')->where('user_id','=',session('user_id'))->first();

        // 加载结算页
        return view('Home.Order.insert',['d'=>$d,'tot'=>$tot,'address'=>$address,'addressfirst'=>$addressfirst]);
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

    // 下单操作
    public function ordercreate(Request $request){
        // dd($request->all());
        // 地址id
        $data = $request->except(['_token']);
        // dd($data);
        // 订单号
        $data['order_num'] =time()+rand(1,10000);
        //用户id
        $data['user_id'] = session('user_id');
        // 状态值 初始值为0 未支付 2代表支付
        $data['status'] =0;
        // 添加数据到订单表中 并获取订单id
        $id =DB::table('orders')->insertGetid($data);
        // dd($id);
        if($id){
            // 订单的详情表入库
            // 购买的商品数据
            $goods = session('goods');
            // dd($goods);
            $d=[];
            $tot='';//下单总计
            foreach($goods[0] as $key=>$value){
                // 获取商品数据
                $info =DB::table('shops')->where('id','=',$value['id'])->first();
                // 订单id
                $data1['order_id'] =$id;
                // 商品id
                $data1['goods_id'] =$value['id'];
                // 商品名字
                $data1['name'] = $info->name;
                // 商品数量
                $data1['num'] =$value['num'];
                // 商品图片
                $data1['pic'] =$info->pic;
                $tot+=$data1['num']*$info->price;
                $data1['tot'] =$tot;
                // $data1['status']=0;//0 未评论 2 已评论
                // session(['tot'=>$tot]);
                $d[] = $data1;
            }
            // dd($d);
            // 入库 订单详情表
            if(DB::table('order_goods')->insert($d)){
                // echo 'xiadan';
                // 订单id 付款金额 选择地址id 存储在session里
                session(['order_id'=>$id]);
                session(['address_id'=>$data['address_id']]);
                session(['tot'=>$tot]);

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
        }


    }

    // 支付完成页面请求
    public function returnurl(Request $request){
        // echo 'zhifuyemian';
        // 修改订单状态 有未付款=>已付款
        $order_id =session('order_id');
        $address_id=session('address_id');
        $tot = session('tot');
        $data['status'] =2;//2 已付款
        DB::table('orders')->where('id','=',$order_id)->update($data);
        // 获取选择的收货地址
        $address = DB::table('address')->where('id','=',$address_id)->first();
        // 清除session 购物车 结算的数据
        $request->session()->pull('cart');
        $request->session()->pull('goods');
        
        // 加载通知界面
        return view('Home.Order.success',['address'=>$address,'tot'=>$tot]);
        
    }



    
}
