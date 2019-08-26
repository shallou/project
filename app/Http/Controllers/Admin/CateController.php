<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB类
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function getCates(){
        $cate = DB::table('cates')->select(DB::raw("* ,concat(path,',',id)as paths"))->orderBy('paths')->get();
        // 遍历
        foreach($cate as $k=>$v){
            // echo $v->path.'<br>';
            // 字符串转换数组
            $arr=explode(',',$v->path);
            // dump($arr);
            // 获取path中的逗号,添加分级符号
            $length = count($arr)-1;
            // 重复字符串str_repeat
           $cate[$k]->name = str_repeat('--|',$length).$v->name;
        }
        return $cate;
    }
    public function index(Request $request)
    {
        // 获取搜索内容
        $k = $request->input('keywords');
        // echo 1;
        // 获取数据
        // $cate = DB::table('cates')->get();
        // 调整类别顺序
        $cate = DB::table('cates')->select(DB::raw("* ,concat(path,',',id)as paths"))->orderBy('paths')->where('name','like','%'.$k."%")->paginate(2);
        // 遍历
        foreach($cate as $k=>$v){
            // echo $v->path.'<br>';
            // 字符串转换数组
            $arr=explode(',',$v->path);
            // dump($arr);
            // 获取path中的逗号,添加分级符号
            $length = count($arr)-1;
            // 重复字符串str_repeat
           $cate[$k]->name = str_repeat('--|',$length).$v->name;
        }
        // dd($cate);
        // 加载分类列表
        return view('Admin.Cate.index',['cate'=>$cate,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加页面
        // echo 1;
        // 获取所有的分类
        // $cates = DB::table('cates')->get();
        $cates = self::getCates();
        return view('Admin.Cate.add',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加到数据库
        // dd($request->all());
        $data = $request->except(['_token']);
        // 获取pid,进行判断是父类还是子类
        $pid = $request->input('pid');
        if($pid ==0){
            // 顶级分类
            // dd($data);
            $data['path'] = '0';
        }else{
            // 添加子类
            // 获取父类的信息
            $info = DB::table('cates')->where('id','=',$pid)->first();
            $data['path'] =$info->path.','.$info->id;
            // dd($data);
        }
        if(DB::table('cates')->insert($data)){
            // echo 'ok';
            return redirect('/admincates')->with('success','添加成功');
        }else{
            // echo 'error';
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
        // echo $id;
        $info = DB::table('cates')->where('id','=',$id)->first();
        // dd($info);
        return view('Admin.Cate.edit',['info'=>$info]);
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
        $names = $request->input('name');
        // dd($names);
        if(DB::table('cates')->where('id','=',$id)->update(['name'=>$names])){
            return redirect('/admincates')->with('success','修改成功');
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
        //判断是否有子类
        // 获取当前分类的个数
       $s=DB::table("cates")->where("pid","=",$id)->count();
        echo $s;
         if($s>0){
            return redirect("/admincates")->with("error","请先删除子类");
        }
        // 直接删除类别
        if(DB::table('cates')->where('id','=',$id)->delete()){
            return redirect('/admincates')->with('success','删除成功');
        }else{
            return redirect('/admincates')->with('error','删除失败');
        }

    }
}
