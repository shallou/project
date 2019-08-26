<html><head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"> 
	<meta name="renderer" content="webkit">
	<title>密保修改</title>
    <link rel="shortcut icon" type="image/x-icon" href="/static/Homes/theme/icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/static/Homes/theme/css/base.css">
	<link rel="stylesheet" type="text/css" href="/static/Homes/theme/css/login.css">
 </head>
 <body>

<!--- header begin-->
<header id="pc-header">
    <div class="login-header" style="padding-bottom:0">
        <div><h1><a href="index.html"><img src="/static/Homes/theme/icon/logo.png"></a></h1></div>
    </div>
</header>
<!-- header End -->



<section id="login-content">
    <div class="login-centre">
        <div class="login-switch clearfix">

            <p class="fr">密保问题修改 <a href="login.html">登录</a></p>
        </div>
        <div class="login-back">
            <div class="H-over">
                @if(session('success'))
                <div class="mws-form-message success" >
           
                {{session('success')}}
                </div>
                @endif
                @if(session('error'))
                 <button style="border:1px solid red">{{session('error')}}</button>
                @endif
                <form action="/mibaowenti/{{$email}}" method="post">
                    <div class="login-input">
                        <label><i class="heart">*</i>最好的朋友的名字：</label>
                        <input type="text" class="list-input1" id="username" name="name1" placeholder="">
                    </div>
                    <div class="login-input">
                        <label><i class="heart">*</i>父亲的生日：</label>
                        <input type="text" class="list-input" id="password" name="name2" placeholder="">
                    </div>
                    <div class="login-input">
                        <label><i class="heart">*</i>母亲的生日：</label>
                        <input type="text" class="list-input" id="password1" name="name3" placeholder="">
                    </div>
                    
                    <div class="item-ifo">
                        <input type="checkbox" onclick="agreeonProtocol();" id="readme" checked="checked" class="checkbox">
                        <label for="protocol">我已阅读并同意<a id="protocol" class="blue" href="#">《悦商城用户协议》</a></label>
                        <span class="clr"></span>
                    </div>
                    <div class="login-button">
                        {{csrf_field()}}
                         <button type="submit" value="Submit">提交</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!--- footer begin-->
<footer id="footer">
    <div class="containers">
        <div class="w" style="padding-top:30px">
            <div id="footer-2013">
                <div class="links">
                    <a href="">关于我们</a>
                    |
                    <a href="">联系我们</a>
                    |
                    <a href="">人才招聘</a>
                    |
                    <a href="">商家入驻</a>
                    |
                    <a href="">广告服务</a>
                    |
                    <a href="">手机京东</a>
                    |
                    <a href="">友情链接</a>
                    |
                    <a href="">销售联盟</a>
                    |
                    <a href="">English site</a>
                </div>
                <div style="padding-left:10px">
                    <p style="padding-top:10px; padding-bottom:10px; color:#999">网络文化经营许可证：浙网文[2013]0268-027号| 增值电信业务经营许可证：浙B2-20080224-1</p>
                    <p style="padding-bottom:10px; color:#999">信息网络传播视听节目许可证：1109364号 | 互联网违法和不良信息举报电话:0571-81683755</p>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- footer End -->

</body></html>