<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/static/Homes/xiangmv//AmazeUI-2.4.2/assets/css/amazeui.css" />
    <link href="/static/Homes/xiangmv//css/dlstyle.css" rel="stylesheet" type="text/css">
  </head>

  <body>

    <div class="login-boxtitle">
      <a href="home.html"><img alt="logo" src="/static/Homes/theme/icon/logo.png" /></a>
    </div>

    <div class="login-banner">
      <div class="login-main">
        <div class="login-banner-bg"><span></span><img src="/static/Homes/theme/login/a2.jpg" /></div>
        <div class="login-box">

              <h3 class="title">登录商城</h3>

              <div class="clear"></div>
            
            <div class="login-form">
              <form action="/homelogin" method="post">
                @if(session('error'))
                {{session('error')}}
                @endif
                 <div class="user-name">
                    <label for="user"><i class="am-icon-user"></i></label>
                    <input type="text" name="email" id="user" placeholder="邮箱">
                 </div>
                 <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="请输入密码">
                 </div>
           </div>
            
            <div class="login-links">
                <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
                <a href="/forget" class="am-fr">忘记密码</a>
                <a href="/homeregister/create" class="zcnext am-fr am-btn-default">注册</a>
                <br />
            </div>
                <div class="am-cf">
                  {{csrf_field()}}
                  <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm">
                  
                </div>
            <div class="partner">   
                <h3>合作账号</h3>
              <div class="am-btn-group">
                <li><a href="/encrypted/mibao"><i class="am-icon-qq am-icon-sm"></i><span>密保找回密码</span></a></li>
                <li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
                <li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
              </div>
            </div> 
            </form>


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

</html>