@extends('Home.HomePublic.Home')
@section('Home')
<div class="member-right fr">
            <div class="member-head">
                <div class="member-heels fl"><h2>我的订单</h2></div>
                <div class="member-backs member-icons fr"><a href="#">搜索</a></div>
                <div class="member-about fr"><input type="text" placeholder="商品名称/商品编号/订单编号"></div>
            </div>
            <div class="member-whole clearfix">
                <ul id="H-table" class="H-table">
                    <li class="cur"><a href="#">我的订单</a></li>
                    <li><a href="#">待付款<em>(44)</em></a></li>
                    <li><a href="#">待发货</a></li>
                    <li><a href="#">待收货</a></li>
                    <li><a href="#">待评价</a></li>
                    <!-- <li><a href="#">订单信息</a></li> -->
                </ul>
            </div>
            <div class="member-border">
               <div class="member-return H-over">
                   <div class="member-cancel clearfix">
                       <span class="be1">订单信息</span>
                       <span class="be2">收货人</span>
                       <span class="be2">订单金额</span>
                       <span class="be2">订单时间</span>
                       <span class="be2">订单状态</span>
                       <span class="be2">订单操作</span>
                   </div>
                   <!-- 订单信息开始 -->
                   <div class="member-sheet clearfix">
                       <ul>
                        @foreach($info as $value)

                           <li>
                               <div class="member-minute clearfix">
                                   <span>2015-09-22 18:22:33</span>
                                   <span>订单号：<em>{{$value->order_num}}</em></span>
                                   <span><a href="#">以纯甲醇旗舰店</a></span>
                                   <span class="member-custom">客服电话：<em>010-6544-0986</em></span>
                               </div>
                               <div class="member-circle clearfix">
                                   <div class="ci1">
                                    
                                       <div class="ci7 clearfix">
                                           <span class="gr1"><a href="#"><img src="{{$value->pic}}" width="60" height="60" title="" about=""></a></span>
                                           <span class="gr2"><a href="#">{{$value->gname}}</a></span>
                                           <span class="gr3">{{$value->num}}</span>
                                       </div>
                                     
                                  
                                   </div>
                                   <div class="ci2">{{$value->aname}}</div>
                                   <div class="ci3"><b>￥{{$value->tot}}</b><p>货到付款</p><p class="iphone">手机订单</p></div>
                                   <div class="ci4"><p>2015-09-22</p></div>
                                   <div class="ci5"><p>等待付款</p> <p><a href="#">物流跟踪</a></p> <p><a href="#">订单详情</a></p></div>
                                  
                                   <div class="ci5 ci8">
                                     @if($value->status ==0)
                                    <p>剩余15时20分</p> <p><a href="/order/create" class="member-touch">立即支付</a> </p> 
                                    <p><a href="#">取消订单</a> </p></div>
                                    @elseif($value->status ==2)
                                    @if($value->statuss ==0)
                                    <p><a href="javascript:void(0)" class="member-touch " id="sssa">提醒发货</a> </p> 
                                    @elseif($value->statuss ==2)
                                    <p><a href="/querenhuoshou/{{$value->gid}}" class="member-touch ">确认收货</a> </p> 
                                    @elseif($value->statuss ==1)
                                     <p><a href="javascript:void(0)" class="member-touch " >已收货</a> </p> 
                                     @elseif($value->statuss ==3)
                                     <p><a href="javascript:void(0)" class="member-touch " >已评价</a> </p> 
                                    @endif
                                    @endif
                                    
                               </div>
                           </li>
                          <!-- 订单信息接收 -->
                          @endforeach
                       </ul>
                   </div>
               </div>
               <div class="H-over member-over" style="display:none;"><h2>
                <!-- <div class="member-whole clearfix"> -->
                <!-- <div class="member-cancel clearfix">
                       <span class="be1">订单信息</span>
                       <span class="be2">收货人</span>
                       <span class="be2">订单金额</span>
                       <span class="be2">订单时间</span>
                       <span class="be2">订单状态</span>
                       <span class="be2">订单操作</span>
                   </div> -->
                 <div class="member-sheet clearfix">
                       <ul>
                        @foreach($info as $value)
                        @if($value->status ==0)
                           <li>
                               <div class="member-minute clearfix">
                                   <span>2015-09-22 18:22:33</span>
                                   <span>订单号：<em>{{$value->order_num}}</em></span>
                                   <span><a href="#">以纯甲醇旗舰店</a></span>
                                   <span class="member-custom">客服电话：<em>010-6544-0986</em></span>
                               </div>
                               <div class="member-circle clearfix">
                                   <div class="ci1">
                                    
                                       <div class="ci7 clearfix">
                                           <span class="gr1"><a href="#"><img src="{{$value->pic}}" width="60" height="60" title="" about=""></a></span>
                                           <span class="gr2"><a href="#">{{$value->gname}}</a></span>
                                           <span class="gr3">{{$value->num}}</span>
                                       </div>
                                     
                                  
                                   </div>
                                   <div class="ci2">{{$value->aname}}</div>
                                   <div class="ci3"><b>￥{{$value->tot}}</b><p>货到付款</p><p class="iphone">手机订单</p></div>
                                   <div class="ci4"><p>2015-09-22</p></div>
                                   <div class="ci5"><p>等待付款</p> <p><a href="#">物流跟踪</a></p> <p><a href="#">订单详情</a></p></div>
                                  
                                   <div class="ci5 ci8">
                                     @if($value->status ==0)
                                    <p>剩余15时20分</p> <p><a href="/orderpays/{{$value->gid}}" class="member-touch">立即支付</a> </p> 
                                     <p><a href="/quxiao/{{$value->id}}">取消订单</a> </p></div>
                                    @elseif($value->status ==2)
                                     <p><a href="#" class="member-touch">已支付</a> </p> 
                                    @endif
                                   
                               </div>
                           </li>
                          <!-- 订单信息接收 -->
                          
                          @endif
                          @endforeach
                       </ul>
                   </div>
                 <!-- </div> -->
               </h2></div>
               <div class="H-over member-over" style="display:none;"><h2>
                 <!-- <div class="member-return H-over">
                   <div class="member-cancel clearfix">
                       <span class="be1">订单信息</span>
                       <span class="be2">收货人</span>
                       <span class="be2">订单金额</span>
                       <span class="be2">订单时间</span>
                       <span class="be2">订单状态</span>
                       <span class="be2">订单操作</span>
                   </div> -->
                   <!-- 订单信息开始 -->
                   <div class="member-sheet clearfix">
                       <ul>
                        @foreach($info as $value)
                         @if($value->status ==2)
                           <li>
                               <div class="member-minute clearfix">
                                   <span>2015-09-22 18:22:33</span>
                                   <span>订单号：<em>{{$value->order_num}}</em></span>
                                   <span><a href="#">以纯甲醇旗舰店</a></span>
                                   <span class="member-custom">客服电话：<em>010-6544-0986</em></span>
                               </div>
                               <div class="member-circle clearfix">
                                   <div class="ci1">
                                    
                                       <div class="ci7 clearfix">
                                           <span class="gr1"><a href="#"><img src="{{$value->pic}}" width="60" height="60" title="" about=""></a></span>
                                           <span class="gr2"><a href="#">{{$value->gname}}</a></span>
                                           <span class="gr3">{{$value->num}}</span>
                                       </div>
                                     
                                  
                                   </div>
                                   <div class="ci2">{{$value->aname}}</div>
                                   <div class="ci3"><b>￥{{$value->tot}}</b><p>货到付款</p><p class="iphone">手机订单</p></div>
                                   <div class="ci4"><p>2015-09-22</p></div>
                                   <div class="ci5"><p>等待付款</p> <p><a href="#">物流跟踪</a></p> <p><a href="#">订单详情</a></p></div>
                                  
                                   <div class="ci5 ci8">
                                     @if($value->status ==2)
                                     <p><a href="javascript:void(0)" class="member-touch " id="sss">提醒发货</a> </p> 
                                     <!-- <span></span> -->
                                    @endif
                                    
                               </div>
                           </li>
                          <!-- 订单信息接收 -->
                          
                          @endif
                          @endforeach
                       </ul>
                   </div>
              
               <script type="text/javascript">
                 // alert($);
                 $('#sss').click(function(){
                    // alert(1);
                    $(this).html('已提醒发货');
                   // var id=$(this).attr("id");
                   //  o =$(this);
                   //  alert(id);
                    

                 });
                 $('#sssa').click(function(){
                  // alert('1');
                  $(this).html('已提醒发货');
                 });

               </script>
               </h2></div>
               <div class="H-over member-over" style="display:none;"><h2>
                 <!-- <div class="member-cancel clearfix">
                       <span class="be1">订单信息</span>
                       <span class="be2">收货人</span>
                       <span class="be2">订单金额</span>
                       <span class="be2">订单时间</span>
                       <span class="be2">订单状态</span>
                       <span class="be2">订单操作</span>
                   </div> -->
                   <!-- 订单信息开始 -->
                   <div class="member-sheet clearfix">
                       <ul>
                        @foreach($info as $value)
                         @if($value->statuss ==2)
                           <li>
                               <div class="member-minute clearfix">
                                   <span>2015-09-22 18:22:33</span>
                                   <span>订单号：<em>{{$value->order_num}}</em></span>
                                   <span><a href="#">以纯甲醇旗舰店</a></span>
                                   <span class="member-custom">客服电话：<em>010-6544-0986</em></span>
                               </div>
                               <div class="member-circle clearfix">
                                   <div class="ci1">
                                    
                                       <div class="ci7 clearfix">
                                           <span class="gr1"><a href="#"><img src="{{$value->pic}}" width="60" height="60" title="" about=""></a></span>
                                           <span class="gr2"><a href="#">{{$value->gname}}</a></span>
                                           <span class="gr3">{{$value->num}}</span>
                                       </div>
                                     
                                  
                                   </div>
                                   <div class="ci2">{{$value->aname}}</div>
                                   <div class="ci3"><b>￥{{$value->tot}}</b><p>货到付款</p><p class="iphone">手机订单</p></div>
                                   <div class="ci4"><p>2015-09-22</p></div>
                                   <div class="ci5"><p>等待付款</p> <p><a href="#">物流跟踪</a></p> <p><a href="#">订单详情</a></p></div>
                                  
                                   <div class="ci5 ci8">
                                     @if($value->statuss ==2)
                                     <p><a href="/querenhuoshou/{{$value->gid}}" class="member-touch ">确认收货</a> </p> 
                                     <!-- <span></span> -->
                                    @endif
                                    
                               </div>
                           </li>
                          <!-- 订单信息接收 -->
                          
                          @endif
                          @endforeach
                       </ul>
                   </div>
               </h2></div>
               <div class="H-over member-over" style="display:none;"><h2>
                  <!-- <div class="member-cancel clearfix">
                       <span class="be1">订单信息</span>
                       <span class="be2">收货人</span>
                       <span class="be2">订单金额</span>
                       <span class="be2">订单时间</span>
                       <span class="be2">订单状态</span>
                       <span class="be2">订单操作</span>
                   </div> -->
                   <!-- 订单信息开始 -->
                   <div class="member-sheet clearfix">
                       <ul>
                        @foreach($info as $value)
                         @if($value->statuss ==1)
                           <li>
                               <div class="member-minute clearfix">
                                   <span>2015-09-22 18:22:33</span>
                                   <span>订单号：<em>{{$value->order_num}}</em></span>
                                   <span><a href="#">以纯甲醇旗舰店</a></span>
                                   <span class="member-custom">客服电话：<em>010-6544-0986</em></span>
                               </div>
                               <div class="member-circle clearfix">
                                   <div class="ci1">
                                    
                                       <div class="ci7 clearfix">
                                           <span class="gr1"><a href="#"><img src="{{$value->pic}}" width="60" height="60" title="" about=""></a></span>
                                           <span class="gr2"><a href="#">{{$value->gname}}</a></span>
                                           <span class="gr3">{{$value->num}}</span>
                                       </div>
                                     
                                  
                                   </div>
                                   <div class="ci2">{{$value->aname}}</div>
                                   <div class="ci3"><b>￥{{$value->tot}}</b><p>货到付款</p><p class="iphone">手机订单</p></div>
                                   <div class="ci4"><p>2015-09-22</p></div>
                                   <div class="ci5"><p>等待付款</p> <p><a href="#">物流跟踪</a></p> <p><a href="#">订单详情</a></p></div>
                                  
                                   <div class="ci5 ci8">
                                     @if($value->statuss ==1)
                                     <p><a href="/pingjia/{{$value->gid}}" class="member-touch ">去评价</a> </p> 
                                     <!-- <span></span> -->
                                    @endif
                                    
                               </div>
                           </li>
                          <!-- 订单信息接收 -->
                          
                          @endif
                          @endforeach
                       </ul>
                   </div>
               </h2></div>
              <!--  <div class="H-over member-over" style="display:none;"><h2>订单信息</h2></div> -->

                <div class="clearfix" style="padding:30px 20px;">
                    <div class="fr pc-search-g pc-search-gs">
                        <a style="display:none" class="fl " href="#">上一页</a>
                        <a href="#" class="current">1</a>
                        <a href="javascript:;">2</a>
                        <a href="javascript:;">3</a>
                        <a href="javascript:;">4</a>
                        <a href="javascript:;">5</a>
                        <a href="javascript:;">6</a>
                        <a href="javascript:;">7</a>
                        <span class="pc-search-di">…</span>
                        <a href="javascript:;">1088</a>
                        <a title="使用方向键右键也可翻到下一页哦！" class="" href="javascript:;">下一页</a>
                    </div>
                </div>

            </div>
        </div>
 
@endsection
@section('title','订单查询')