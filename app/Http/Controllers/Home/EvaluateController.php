<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Storge; //导入七牛类
use Intervention\Image\ImageManager;//图片修改类
use Config;
use App\Models\Comment;//模型类
class EvaluateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 个人评价
    public function pingjia($id){
        // echo $id;
        $info = DB::table('address')->join('orders','orders.address_id','=','address.id')->join('order_goods','order_goods.order_id','=','orders.id')->where('order_goods.id','=',$id)->select('address.id as aid','address.name as aname','address.phone','address.user_id as auser_id','address.huo','orders.id','orders.order_num','orders.user_id as oid','address_id','orders.status','order_goods.id as gid','order_goods.order_id','order_goods.goods_id','order_goods.name as gname','order_goods.num','order_goods.pic','order_goods.tot','order_goods.statuss')->get();
        // dd($info);

        return view('Home.Evaluate.pingjia',['info'=>$info]);
    }
    // 提交评价
    public function Ecreates(Request $request,$ids){
        // echo $id;
        // dd($request->all());
        // $info[] = $request->except(['_token']);
        // dd($info);
        if($request->hasFile('img')){
            // 获取上传文件信息
            $file = $request->file('img');
            // dd($file);
            $name =time();
            $ext =$request->file('img')->getClientOriginalExtension();
        }
         $dirpath = Config::get('app.app_upload');
        // 判断文件是否存在,不存在则创建
        if(!is_dir($dirpath)){
            mkdir($dirpath,0777,true);  // 路径,权限,是否创建多级目录
        }
        // $newfile  文件上传到oss服务器里的名
        // $filepath 上传文件的临时目录
        $newfile = $name.'.'.$ext;
        \Storage::disk('qiniu')->writeStream($newfile, fopen($file->getRealPath(), 'r'));
        
        // 图片的修改
        // 实例化ImageManager
        $manager = new ImageManager();
        $manager->make(env('QINIU_DOMAIN').$newfile)->resize(150,160)->save(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext);

        // 数据入库
        $data['content']=$request->input('content');
        $data['user_id']=session('user_id');
        $data['img']=trim(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext,'.');
        $data['goods_id']=$ids;
        // dd($data);
        if($ISS=Comment::create($data)){
            // dd($ISS);
            // 修改订单详情表状态值
            DB::table('order_goods')->where('id','=',$ids)->update(['statuss'=>3]);
        }
        // dd($data1);
        return redirect('/orderform');
       
    }
    public function index()
    {
        //
        // $info=array();
        // $info = DB::table('address')->join('orders','orders.address_id','=','address.id')->join('order_goods','order_goods.order_id','=','orders.id')->where('orders.user_id','=',session('user_id'))->select('address.id as aid','address.name as aname','address.phone','address.user_id as auser_id','address.huo','orders.id','orders.order_num','orders.user_id as oid','address_id','orders.status','order_goods.id as gid','order_goods.order_id','order_goods.goods_id','order_goods.name as gname','order_goods.num','order_goods.pic','order_goods.tot','order_goods.statuss')->get();
        // dd($info);

        $info = DB::table('order_goods')->join('comment','comment.goods_id','=','order_goods.id')->get();
        // dd($info);

        return view('Home.Evaluate.index',['info'=>$info]);

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
