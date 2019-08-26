@extends('Home.HomePublic.Home')
@section('Home')
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
               @foreach($info as $key=>$value)
               
               <div class="member-class clearfix">
                   <ul>

                       <li class="clearfix">
                           <div class="sp1">
                               <span class="gr1"><a href="#"><img width="60" height="60" about="" title="" src="{{$value->pic}}"></a></span>
                               <span class="gr2"><a href="#">红米Note2 标准版 白色 移动4G手机 双卡双待</a></span>
                               <span class="gr3">X{{$value->num}}</span>
                           </div>
                           <div class="sp2">2015 - 09 -  02</div>
                           
                           <div class="sp3"><a href="#">已评价</a> </div>
                       </li>
                   </ul>
               </div>
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
                               <p>{{$value->content}}</p>
                           </div>
                       </li>
                       <li class="clearfix">
                           <div class="member-score fl">晒单：</div>
                           <div class="member-star fl">
                               <a href="#"><img src="{{$value->img}}"></a>
                               <!-- <a href="#"><img src="theme/img/pd/m2.png"></a>
                               <a href="#"><img src="theme/img/pd/m2.png"></a> -->
                           </div>
                       </li>
                       <li class="clearfix">
                           <div style="padding-left:85px;">最多可以增加<i class="reds">10</i>张</div>
                       </li>
                   </ul>
               </div>
              
               @endforeach
                <div class="member-pages clearfix">
                    <div class="fr pc-search-g">
                        <a class="fl pc-search-f" href="#">上一页</a>
                        <a href="#" class="current">1</a>
                        <a href="javascript:;">2</a>
                        <a href="javascript:;">3</a>
                        <a href="javascript:;">4</a>
                        <a href="javascript:;">5</a>
                        <a href="javascript:;">6</a>
                        <a href="javascript:;">7</a>
                        <span class="pc-search-di">…</span>
                        <a title="使用方向键右键也可翻到下一页哦！" class="pc-search-n" href="javascript:;" onclick="SEARCH.page(3, true)">下一页</a>
                    <span class="pc-search-y">
                        <em>  共20页    到第</em>
                        <input type="text" class="pc-search-j" placeholder="1">
                        <em>页</em>
                        <a href="#" class="confirm">确定</a>
                    </span>

                    </div>
                </div>

            </div>
        </div>
@endsection
@section('title','前台评价')