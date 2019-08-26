<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB类
use DB;
use Illuminate\Support\Facades\Redis;//测试redis
use Hash;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 
    public function getCatesByPid($pid){
        // 获取数据
        $cate = DB::table('cates')->where('pid','=',$pid)->get();
        $data =[];
        // 遍历
        foreach($cate as $k=>$v){
            //子类信息 的信息写在父类的SUV的下标里
            $v->suv = self::getCatesByPid($v->id);
            $data[]=$v; 

        }
        return $data;
    }
    public function index()
    {
        // 获取顶级分类
       $cate = self::getCatesByPid(0);
       // dd($cate);
       // dd($cates);
       // 两表关联 分类和商品
       $shop = DB::table('shops')->get();
       // dd($cates);
       // // 遍历顶级分类 获取一级分类
       // foreach($cates as $row){
       //               $arr = explode(',',$row->path);
       //               if(count($arr)==2){
       //                  $catess[] = $row;
       //               }
       //      }

       //  // dd($catess);
       // // dd($shop);
       //  foreach($catess as $v){
       //       $shop[]=DB::table('shops')->join('cates','shops.cate_id','=','cates.id')->select('cates.name as cname','cates.id as cid','shops.name as sname','shops.id as sid','shops.price','shops.pic')->where('shops.cate_id','=',$v->id)->get();
       //  }

        // dd($shop);
      // 轮播图
       // if(!empty(session('email'))){
       //  $info = DB::table('banner')->();
       //  return view('Home.Index.index',['cates'=>$cate,'shop'=>$shop,'info'=>$info]);
       //  }
       if(!empty(session('email'))){
        // dd(session('user_id'));
            if(!empty($info = DB::table('banner')->where('user_id','=',session('user_id'))->get())){
                // dd($info);
                return view('Home.Index.index',['cates'=>$cate,'shop'=>$shop,'info'=>$info]);
            }
       }

        // dd($info);

        //加载前台首页
        return view('Home.Index.index',['cates'=>$cate,'shop'=>$shop]);
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
        //加载详情页
        // echo $id;
        $info =DB::table('shops')->where('id','=',$id)->first();

        // 获取商品的详情评论
        $data =DB::table('comment')->join('order_goods','order_goods.id','=','comment.goods_id')->join('shops','shops.id','=','order_goods.goods_id')->select('comment.id as cid','shops.id as sid','order_goods.id as gid','comment.created_at','comment.content','order_goods.name','order_goods.num')->get();
        // dd($data);

        return view('Home.Index.info',['info'=>$info,'data'=>$data]);
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

    // 测试redis
    public function rediss(){
        
        // Redis::set('php217',10);

        echo Redis::get('php217');
    }
    // 退出
    public function logout(Request $request){
        // 销毁邮箱用户信息
        $request->session()->pull('email');
         // 清除session 购物车 结算的数据
        $request->session()->pull('cart');
        $request->session()->pull('goods');
        // 登录界面
        return redirect('/homelogin/create');
    }

    // 密保问题找回密码  获取用户名
    public function mibao(){
        // echo 1;
        return view('Home.Index.mibao');
    }

    // 密保问题找回密码 
    public function mibaos(Request $request){
        // dd($request->all());
        $email = $request->input('email');
        // dd($email);
        return view('Home.Index.mibaos',['email'=>$email]);

    } 
    // 判断密保问题
    public function mibaowenti(Request $request,$id){
        // echo $id;
        
        if(count($info=DB::table('user')->where('email','=',$id)->first())){
            // echo 1;
            $data = $request->except('_token');
            // dd($info->id);
            // dd($data);
            $data1 = DB::table('encrypted')->where('user_id','=',$info->id)->first();
            // dd($data1);
            if($data1->name1 == $data['name1'] && $data1->name2 == $data['name2'] && $data1->name3 == $data['name3'] ){
                // echo 1;
                return view('Home.Index.editmibao',['id'=>$info->id]);
            }
        }
          
        return back();
    }

    // 用密保修改密码
    public function editmibao(Request $request,$id){
        // echo $id;
        $data = $request->except(['_token']);
        
        $data['password']=Hash::make($data['password']);
        // dd($data);
        if(DB::table('user')->where('id','=',$id)->update($data)){
            return redirect('/homelogin/create');
        }

    }

}
