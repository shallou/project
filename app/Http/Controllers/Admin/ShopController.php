<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Markdown;//导入
use Config;
use DB;//引入DB类
// use Intervention\Image\ImageManager;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取商品的数据
        // $shop =DB::table('shops')->get();
        // 两表关联
        $shop = DB::table('shops')->select('cates.id as cid','cates.name as cname','shops.id as sid','shops.name as sname','shops.pic','shops.descr','shops.num','shops.price')->join('cates','shops.cate_id','=','cates.id')->paginate(2);
        return view('Admin.Shop.index',['shop'=>$shop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载模板
        $cate=CateController::getCates();
        // dd($cate);
        return view('Admin.Shop.add',['cate'=>$cate]);

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
        // $info = $request->all();
        // dd($info);
        // 判断文件图片是否上传
        if($request->hasFile('pic')){
            $name=time();
            $ext=$request->file('pic')->getClientOriginalExtension();
            $request->file('pic')->move(Config::get('app.app_upload'),$name.'.'.$ext);
        }

        // 封装需要插入的数据
        $data['name'] = $request->input('name');
        $data['cate_id'] = $request->input('cate_id');
        $data['pic'] = trim(Config::get('app.app_upload').'/'.$name.'.'.$ext,'.');
        // 通过Markdown的 组件转换为HTML代码
        $data['descr'] = Markdown::convertToHtml($request->input('descr'));
        $data['num'] =$request->input('num');
        $data['price'] =$request->input('price');
        // dd($data);
        if(DB::table('shops')->insert($data)){
            return redirect('/adminshop')->with('success','添加成功');
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
        // echo $id;
        if(DB::table('shops')->where('id','=',$id)->delete()){
            return redirect('/adminshop')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
