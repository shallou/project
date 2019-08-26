<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;//模型类
use Hash;
use Mail;
class HomeLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('Home.HomeLogin.login');

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
        // 获取登录到邮箱和密码
        $email = $request->input('email');
        $password = $request->input('password');
        // 检测$email
        $info = User::where('email','=',$email)->first();
        // dd($info);
        if($info){
            // echo 'ok';
            // 检测密码
            if(Hash::check($password,$info->password)){
                // echo 'ok';
                // 检测用户是否激活
                if($info->status=='激活'){
                    //吧登录的邮箱名字存储在session里面
                    session(['email'=>$email]);
                    session(['user_id'=>$info->id]);
                    return redirect('/homeindex');
                }else{
                     return back()->with('error','用户没有被激活');
                }
            }else{
                return back()->with('error','密码有误');
            }
        }else{
            return back()->with('error','邮箱有误');
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
    }

    // 发送邮件 $id 用户的id $email 收件人 $token 校验参数 找回密码
    public function loginmail($id,$email,$token){
        // 匿名函数内部获取不到匿名函数外部变量
        // use 把匿名函数外部变量直接引入到匿名函数的内部
        Mail::send('Home.HomeLogin.reset',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('尊敬的用户,重置密码');

        });
        return true;
    }
    // 加载忘记密码模板
    public function forget(){
        return view('Home.Homelogin.forget');
    }
    // 发送邮件找回密码
    public function doforget(Request $request){
        // 获取邮箱账号
        $email =$request->input('email');
        // 获取数据库的数据
        $info =User::where('email','=',$email)->first();
        if($this->loginmail($info->id,$email,$info->token)){
            return redirect('http://mail.qq.com/');
        }
    }
    // 获取参数验证信息 找回密码
    public function reset(Request $request){
        $id = $request->input('id');
        $token = $request->input('token');
        // echo $id.':'.$token;
        // 校验信息
        // 获取数据库的数据
        $info = User::where('id','=',$id)->first();
        // 对比token
        if($token == $info->token){
            return view('Home.HomeLogin.reset1',['id'=>$id]);
        }
    }
    // 修改数据里的密码
    public function doreset(Request $request){
        $id = $request->input('id');
        $password = $request->input('password');
        // 执行修改
        $data['password']=Hash::make($password);
        $data['token'] = str_random(50);
        if(User::where('id','=',$id)->update($data)){
            return redirect('/homelogin/create');
        }
    }

}
