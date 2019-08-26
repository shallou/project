<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/static/Homes/xiangmv//AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/static/Homes/xiangmv//css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/static/Homes/xiangmv//AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/static/Homes/xiangmv//AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/Homes/xiangmv/css/bootstrap.min.css">

  </head>
  <style type="text/css">
    .cur{
      border:1px solid red;
    }

     .curs{
      border:1px solid green;
    }
  </style>
  <body>

    <div class="login-boxtitle">
      <a href="home/demo.html"><img alt="" src="/static/Homes/theme/icon/logo.png" /></a>
    </div>

    <div class="res-banner">
      <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/static/Homes/theme/login/a2.jpg" /></div>
        <div class="login-box">

            <div class="am-tabs" id="doc-my-tabs">
              <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                <li class="am-active"><a href="">邮箱注册</a></li>
                <li><a href="">手机号注册</a></li>
              </ul>

              <div class="am-tabs-bd">
                <div class="am-tab-panel am-active">
                  <form  action="/homeregister" method="post">
                    @if(session('error'))
                    {{session('error')}}
                    @endif
                 <div class="user-email">
                    <label for="email"><i class="am-icon-envelope-o"></i></label>
                    <input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                 </div>                   
                 <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="设置密码">
                 </div>                   
                 <div class="user-pass">
                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码">
                 </div> 

                  <div class="user-pass">
                    <label for="passwordRepeat"><i class="am-icon-code-fork"></i></label>
                    <img src="/code" onclick="this.src=this.src+'?a=1'" style="float:right"> 
                 </div>

                  <div class="verification">
                      <label for="code"><i class="am-icon-code-fork"></i></label>
                      <input type="tel" name="code" id="code" placeholder="请输入验证码">
                    </div> 
                 
                 
                 <div class="login-links">
                  </div>
                   {{csrf_field()}}
                    <div class="am-cf">
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                </div>

                </form>

                <div class="am-tab-panel">
                  <form method="post" action="/registerphone" id="ff">
                 <div class="user-phone" style="margin-top:20px">
                    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                    <input type="tel" name="phone" id="phone" placeholder="请输入手机号" class="ll"reminder="请输入正确的手机号"><span></span>
                 </div>                                     
                    <div class="verification" style="margin-top:20px">
                      <label for="code"><i class="am-icon-code-fork"></i></label>
                      <input type="tel" name="code" id="code" placeholder="请输入验证码"  style="width:140px" class="ll" reminder="请输入验证码"><span></span>
                      <a href="javascript:void(0)"class="btn btn-info" style="float:right" id="ss">获取</a>
                    </div>
                 <div class="user-pass" style="margin-top:20px">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="设置密码" class="ll"/><span></span>
                 </div>                   
                 <div class="user-pass" style="margin-top:20px">
                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码" class="ll"/><span></span>
                 </div> 
                    <div class="am-cf">
                      {{csrf_field()}}
                      <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                      
                    </div>
                    </form>
                
                  <hr>
                </div>

                <script>
                  $(function() {
                      $('#doc-my-tabs').tabs();
                    })
                </script>

              </div>
            </div>

        </div>
      </div>
      
          <div class="footer ">
            <div class="footer-hd ">
              <p>
                <a href="# ">恒望科技</a>
                <b>|</b>
                <a href="# ">商城首页</a>
                <b>|</b>
                <a href="# ">支付宝</a>
                <b>|</b>
                <a href="# ">物流</a>
              </p>
            </div>
            <div class="footer-bd ">
              <p>
                <a href="# ">关于恒望</a>
                <a href="# ">合作伙伴</a>
                <a href="# ">联系我们</a>
                <a href="# ">网站地图</a>
                <em>© 2015-2025 Hengwang.com 版权所有</em>
              </p>
            </div>
          </div>
  </body>
  <script type="text/javascript">
    // alert($);
   Phone = false;
   Code = false;
    // 获取焦点
    $('.ll').focus(function(){
      // 获取 reminder 的属性值
      reminder=$(this).attr('reminder');
      // alert(reminder);
      // 找到下一个span元素
      $(this).next('span').css('color','red').html(reminder);
      $(this).addClass('cur');
      // 清除样式
      $(this).removeClass('curs');
    });

    // 手机号失去焦点事件
    $("input[name='phone']").blur(function(){
       o=$(this);
      // 获取手机号
      p=$(this).val();
      // 正则校验 match 匹配正则规则 匹配到返回 true 没有匹配到返回null
      if(p.match(/^\d{11}$/)==null){
        // alert('手机号格式不对');
        $(this).next('span').css('color','red').html('手机号格式不合法');
        $(this).addClass('cur');
        Phone = false;
      }else{
        // alert('ok');
        // 校验手机号是否唯一
        $.get('/checkphone',{p:p},function(data){
          // alert(data);
          // Ajax 里不能解析$(this);
          if(data==1){
            // 手机已被注册
            $('#ss').attr('disabled',true);
            o.next('span').css('color','red').html('手机号不可用');
            o.addClass('cur');
            Phone = false;
          }else{
            $('#ss').attr('disabled',false);

            //手机可用
            o.next('span').css('color','green').html('手机号可用');
             o.addClass('curs');
             Phone=true;
          }

        });
      }
    });

    //获取按钮
    $('#ss').click(function(){
      // 获取手机号
      oo=$(this);
      pp = $("input[name='phone']").val();
      // ajax
      $.get('/registersendphone',{pp:pp},function(data){
        // alert(data.code);
        if(data.code == 000000){
          // 按钮的倒计时
          m=60;
          mytime=setInterval(function(){
            m--;
            // 赋值给按钮
            oo.html(m);
            // 禁用按钮
            oo.attr('disabled',true);
            // 判断
            if(m<1){
              // 清除定时器
              clearInterval(mytime);
              oo.html('发送');
              oo.attr('disabled',false);
            }

          },1000);
        }
      },'json');
    }); 

    // 检测短信校验码
    $("input[name='code']").blur(function(){
      pp = $(this);
      // 获取写入的校验码
      code = $(this).val();
      // ajax
      $.get('/checkcode',{code:code},function(data){
        if(data ==1){
          //
            pp.next('span').css('color','green').html('校验码一致');
             pp.addClass('curs');
             Code = true;
        }else if(data ==2){
          // 校验码有误
            pp.next('span').css('color','red').html('校验码有误');
             pp.addClass('cur');
             Code = false;
        }else if(data ==3){
          pp.next('span').css('color','red').html('校验码为空');
             pp.addClass('cur');
              Code = false;
        }else if(data ==4){
          pp.next('span').css('color','red').html('校验码过期');
             pp.addClass('cur');
              Code = false;
        }
      });
    });

    // 表单提交
    $('#ff').submit(function(){
      // trigger让匹配到元素触发某类事件
      $('input').trigger('blur');
      if(Phone && Code){
        return true;//允许表单提交
      }else{
        return false;//阻止表单提交
      }
      // return false; 

    });
  </script>
</html>