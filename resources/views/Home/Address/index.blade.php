@extends('Home.HomePublic.Home')
@section('Home')
<div class="member-right fr">
            <div class="member-head">
                <div class="member-heels fl"><h2>地址管理</h2></div>
            </div>
            <div class="member-border">
                <div class="member-newly"><b>新增收货地址</b>您已经创建了<i class="reds">4</i>个收货地址了，最多可创建<i class="reds">20</i>个</div>
                <div class="member-sites">
                    <ul>
                    	@foreach($info as $key=>$value)
                        <li class="clearfix">
                        	@if($value->Astatus ==2)
                            <div class="default fl"><a href="#">默认地址</a> </div>
                            @elseif($value->Astatus ==0)
                            <div class="default fl"><a href="#">普通地址</a> </div>
                            @endif
                            <div class="user-info1 fl clearfix">
                                <div class="user-info">
                                    <span class="info1">收货人：</span>
                                    <span class="info2">{{$value->name}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="info1">所在地区：</span>
                                    <span class="info2">{{$value->huo}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="info1">地址：</span>
                                    <span class="info2">{{$value->huo}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="info1">手机：</span>
                                    <span class="info2">{{$value->phone}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="info1">固定电话：</span>
                                    <span class="info2">{{$value->phone}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="info1">电子邮箱：</span>
                                    <span class="info2">{{session('email')}}</span>
                                </div>
                            </div>

                            <div class="pc-event">
                            	@if($value->Astatus ==0)
                                <a href="/moaddress/{{$value->id}}" >设为默认地址</a>
                                @elseif($value->Astatus ==2)
                                <a href="javascript:void(0)" class="pc-event-d">设为默认地址</a>
                                @endif
                                <a href="/Address/{{$value->id}}/edit">编辑 </a>
                               <form action="/Address/{{$value->id}}" method="post">
                               	{{csrf_field()}}
								{{method_field('DELETE')}}
                               	<button>删除</button>
                               </form>
                               
                                </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="member-pages clearfix">
                    <div class="fr pc-search-g">
                        <a href="#" class="fl pc-search-f">上一页</a>
                        <a class="current" href="#">1</a>
                        <a href="javascript:;">2</a>
                        <a href="javascript:;">3</a>
                        <a href="javascript:;">4</a>
                        <a href="javascript:;">5</a>
                        <a href="javascript:;">6</a>
                        <a href="javascript:;">7</a>
                        <span class="pc-search-di">…</span>
                        <a onclick="SEARCH.page(3, true)" href="javascript:;" class="pc-search-n" title="使用方向键右键也可翻到下一页哦！">下一页</a>
                    <span class="pc-search-y">
                        <em>  共20页    到第</em>
                        <input type="text" placeholder="1" class="pc-search-j">
                        <em>页</em>
                        <a class="confirm" href="#">确定</a>
                    </span>

                    </div>
                </div>
            </div>
        </div>
@endsection
@section('title','订单查询')