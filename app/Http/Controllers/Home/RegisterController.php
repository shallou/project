<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;//laravel里把发送邮件的功能封装在Mail类里
//引入第三方验证码类库
use Gregwar\Captcha\CaptchaBuilder;//导入验证码类库
// 导入模型类
use App\Models\HomeRegister;
use Hash;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 测试邮件的发送原始字符串
    public function sendmail(){
        // raw 发送原始字符串函数 PHP217 内容
        // $message 消息生成器 to(接收方) cc(抄送)
        // bcc(不抄送) subject(邮件主题)
        Mail::raw('php217 is very good',function($message){
            $message->to('2631107541@qq.com');
            $message->subject('测试邮件');
        });
    }
    // 测试邮件的发送视图
    public function sendmail1(){
        Mail::send('Home.Register.a',['id'=>100],function($message){
            $message->to('2631107541@qq.com');
            $message->subject('发送视图');
        });
    }
    
    public function index()
    {
        //
    }
    // 生成校验码
    public function code(){
        // 生成校验码代码
        ob_clean();//清除操作
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        // 输出验证码
        $builder->output();
        // die;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载注册界面
        return view('Home.Register.register');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 发送邮件 $id 用户的id $email 收件人 $token 校验参数
    public function registermail($id,$email,$token){
        // 匿名函数内部获取不到匿名函数外部变量
        // use 把匿名函数外部变量直接引入到匿名函数的内部
        Mail::send('Home.Register.jihuo',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('尊敬的用户');

        });
        return true;
    }
    public function store(Request $request)
    {
        //获取输入的校验么
        $code = $request->input('code');
        // 获取系统的校验码
        $vcode=session('vcode');
        // echo $code.":".$vcode;
        // 对比
        if($code == $vcode){
            // echo 'ok';
            // dd($request->all());
            // 封装数据
            $data['email']=$request->input('email');
            $data['password']=Hash::make($request->input('password'));
            $data['name']='asd'.rand(1,1000);
            $data['status']=0;//0 的话是没有激活  //2 代表用户已经激活了(发送邮件)
            $data['token']=str_random(50);
            $data['phone']=rand(1,10000);
          $data1 = HomeRegister::create($data);
          // dd($data1);
          $id = $data1->id;
            // 入库
            if($id){
                // echo 'ok';
                // 调用方法 发送邮件激活用户 status 修改为2
                $res=$this->registermail($id,$data['email'],$data['token']);
                if($res){
                    echo '激活用户的邮件已经发送,登录邮箱激活帐户';
                }else{
                    return back()->with('error','请重亲发送邮件,激活帐户');
                }
            }else{
                echo 'no';
            }
        }else{
            return back()->with('error','验证码有误');
        }

    }
    // 激活用户 status值
    public function jihuo(Request $request){
        $id=$request->input('id');
        $token =$request->input('token');
        // 获取数据库的token
        $use =HomeRegister::where('id','=',$id)->first();
        // 对比邮件里token是否和数据库里的token一致
        if($token == $use->token){
             // 执行修改
            $data['status']=2;
            $data['token'] = str_random(50);
            HomeRegister::where('id','=',$id)->update($data);
            echo '用户已被激活,请去登录';
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
    // 手机号注册
    public function registerphone(Request $request){
        // dd($request->all());
      $data = $request->except(['repassword','_token']);
      $data['status']=2;
      $data['name']='asd'.rand(1,1000);
      $data['email']=rand(1,10000).'@qq.com';
      $data['token']=str_random(50);
      if(HomeRegister::create($data)){
        return redirect('/homelogin/create')->with('success','添加用户成功');
      }else{
        return back()->with('success','添加用户失败');
      }
    }
    // 检测手机号是否唯一
    public function checkphone(Request $request){
        $p=$request->input('p');
        // echo $p;
        // 用注册的手机号和数据表user的手机号做对比
       $phone =HomeRegister::pluck('phone')->toArray();
       // dd($phone);
       // echo '<pre>';
       // var_dump($phone);
       if(in_array($p,$phone)){
        echo 1;//存在
       }else{
        echo 0;//不存在
       }

    }
    // 发送短信校验么
    public function registersendphone(Request $request){
        $pp = $request->input('pp');
        // 调用短信接口
        $data=sms($pp);
        echo $data;
        // dd($data);

    }
    // 检测校验码
    public function checkcode(Request $request){
        $code = $request->input('code');
        // 和系统的校验码对比
        if(isset($_COOKIE['pcode']) && !empty($code)){
            // 获取系统的校验码
            $pcode = $request->cookie('pcode');
            // 和系统的校验码作对比
            if($code == $pcode){
                echo 1;//校验码正确
            }else{
                echo 2;//校验码有误
            }

        }else if(empty($code)){
            echo 3;//校验码为空
        }else{
            echo 4;//校验码过期
        }
    }

}
