<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Config;
use Intervention\Image\ImageManager;
use App\Services\OSS;//导入OSS类
use Storge; //导入七牛类
use Illuminate\Support\Facades\Redis;//导入redis类
class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 把列表数据存储在redis缓存里
        $arts =[];
        // 哈希表名 存储列表数据
        $hashkey ='Hash:php217article';
        // 链表名字 存储名字
        $listkey='List:php217articlelist'; 
        // 判断redis里有没有列表数据
        if(Redis::exists($listkey)){
            // 获取所有数据id
            $lists = Redis::lrange($listkey,0,-1);
            // dd($lists);
            // 遍历id
            foreach($lists as $k=>$v){
                $arts[] =Redis::hgetall($hashkey.$v); 
            }

        }else{
            //获取数据库的数据 给redis一份
             $arts = Article::get()->toArray();
             // 给redis一份
             foreach($arts as $k=>$v){
                // 将文章的id存储在$listkey里面
                Redis::rpush($listkey,$v['id']);
                // 将所有的数据插入到哈希表里
                Redis::hmset($hashkey.$v['id'],$v);

             }
        }
        //列表
        // $data = Article::get();
        // // dd($data);
        return view('Admin.Article.index',['data'=>$arts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.Article.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //普通添加
        // dd($request->all());
        // 图片上传
        // if($request->hasFile('thumb')){
        //     $name =time();
        //     $ext =$request->file('thumb')->getClientOriginalExtension();
        //     // 把文件移动到upload下
        //     $request->file('thumb')->move(Config::get('app.app_upload'),$name.'.'.$ext);
        // }
        // // 图片的修改
        // // 实例化ImageManager
        // $manager = new ImageManager();
        // $manager->make(Config::get('app.app_upload').'/'.$name.'.'.$ext)->resize(150,160)->save(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext);

        // // 数据入库
        // $data['title']=$request->input('title');
        // $data['editor']=$request->input('editor');
        // $data['thumb']=trim(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext,'.');
        // $data['descr']=$request->input('descr');
        // // dd($data);
        // if(Article::create($data)){
        //     return redirect('/adminarticles')->with('success','添加成功');
        // }else{
        //     return back();
        // }



        // 阿里云上传
        //  if($request->hasFile('thumb')){
        //     // 获取上传文件信息
        //     $file = $request->file('thumb');
        //     // dd($file);
        //     $name =time();
        //     $ext =$request->file('thumb')->getClientOriginalExtension();
        // }
        // // $newfile  文件上传到oss服务器里的名
        // // $filepath 上传文件的临时目录
        // // 
        // $dirpath = Config::get('app.app_upload');
        // // 判断文件是否存在,不存在则创建
        // if(!is_dir($dirpath)){
        //     mkdir($dirpath,0777,true);  // 路径,权限,是否创建多级目录
        // }

        // $newfile = $name.'.'.$ext;
        // $filepath = $file->getRealPath();
        // OSS::upload($newfile, $filepath);
        
        // // 图片的修改
        // // 实例化ImageManager
        // $manager = new ImageManager();
        // $manager->make(env('ALIURL').$newfile)->resize(150,160)->save(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext);

        // // 数据入库
        // $data['title']=$request->input('title');
        // $data['editor']=$request->input('editor');
        // $data['thumb']=trim(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext,'.');
        // $data['descr']=$request->input('descr');
        // // dd($data);
        // if(Article::create($data)){
        //     return redirect('/adminarticles')->with('success','添加成功');
        // }else{
        //     return back();
        // }


        // // 七牛上传
        if($request->hasFile('thumb')){
            // 获取上传文件信息
            $file = $request->file('thumb');
            // dd($file);
            $name =time();
            $ext =$request->file('thumb')->getClientOriginalExtension();
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
        $data['title']=$request->input('title');
        $data['editor']=$request->input('editor');
        $data['thumb']=trim(Config::get('app.app_upload').'/'.'r_'.$name.'.'.$ext,'.');
        $data['descr']=$request->input('descr');
        // dd($data);
        $data1 = Article::create($data);
        // dd($data1);
        $id = $data1->id;
        if($id){
           
            // 把需要添加的数据插入到redis缓存服务器里
           
            
            // 哈希表名 存储列表数据
            $hashkey ='Hash:php217article';
             // 链表名字 存储名字
             $listkey='List:php217articlelist';
              // id 存储在 链表里
             Redis::rpush($listkey,$id);
             // 数据 存储里哈希表里
             $data['id']=$id;
             Redis::hmset($hashkey.$id,$data);
              return redirect('/adminarticles')->with('success','添加成功');
        }else{
            return back();
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
        $info = Article::where('id','=',$id)->first();
        // dd($info->id);

        return view('admin.Article.edit',['info'=>$info]);

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
        echo $id;
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
    // Ajax 删除
    public function del(Request $request){
        // echo '11';
        $arr =$request->input('arr');
        if($arr==""){
            echo '请至少选择一条数据';die;
        }
        // dd($arr);
        // echo json_encode($arr);
        // 遍历
        foreach($arr as $k=>$v){
            Article::where('id','=',$v)->delete();
          // 删除缓存服务器的数据
            // 删除链表里 id
            // 删除哈希里面的数据
            // 哈希表名 存储列表数据
            $hashkey ='Hash:php217article';
             // 链表名字 存储名字
             $listkey='List:php217articlelist';
            Redis::lrem($listkey,1,$v);
            // 删除哈希表里的数据
            Redis::del($hashkey.$v);
        }
          echo 1;
    }
}
