@extends('Home.HomePublic.Home')
@section('Home')
@foreach($info as $key=>$value)
<div class="member-right fr">
            <div class="member-head">
                <div class="member-heels fl"><h2>我的评价</h2></div>
            </div>
            <div class="member-border">
               <div class="member-column clearfix">
                   <span class="co1">商品信息</span>
                   <span class="co2">购买时间</span>
                   <span class="co3">评价状态</span>
               </div>
               <div class="member-class clearfix">
                   <ul>
                       <li class="clearfix">
                           <div class="sp1">
                               <span class="gr1"><a href="#"><img width="60" height="60" about="" title="" src="{{$value->pic}}"></a></span>
                               <span class="gr2"><a href="#">红米Note2 标准版 白色 移动4G手机 双卡双待</a></span>
                               <span class="gr3">X{{$value->num}}</span>
                           </div>
                           <div class="sp2">2015 - 09 -  02</div>
                           <div class="sp3"><a href="#">发表评价</a> </div>
                       </li>
                   </ul>
               </div>
               <form action="/Ecreates/{{$value->gid}}" method="post" enctype="multipart/form-data">
               <div class="member-setup clearfix">
                   <ul>
                       <li class="clearfix">
                           <div class="member-score fl"><i class="reds">*</i>评分：</div>
                           <div class="member-star fl">
                               <ul>
                                   <li class="on"></li>
                                   <li class="on"></li>
                                   <li></li>
                                   <li></li>
                                   <li></li>
                               </ul>
                           </div>
                           <div class="member-judge fr"><input type="checkbox"> 匿名评价</div>
                       </li>

                       <li class="clearfix">
                           <div class="member-score fl"><i class="reds">*</i>商品评价：</div>
                           <div class="member-star fl">
                               <textarea maxlength="200" name="content"></textarea>
                           </div>
                       </li>
                       <li class="clearfix">

                           <input type="file" name="img">
                       </li>
                       <li class="clearfix">
                           <div style="padding-left:85px;">最多可以增加<i class="reds">3</i>张</div>
                       </li>
                   </ul>
                   <div class="sp3">
                   	{{csrf_field()}}
               	<input type="submit" value="发表评价">
				</div>
               </div>
               </form>
               

            </div>
        </div>
        @endforeach
@endsection
@section("title","个人评价")