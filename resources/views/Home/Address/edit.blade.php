@extends('Home.HomePublic.Home')
@section('Home')
<div class="member-right fr">
            <div class="member-head">
                <div class="member-heels fl"><h2>地址管理</h2></div>
            </div>
            <div class="member-border">
                <div class="member-newly"><b>新增收货地址</b>您已经创建了<i class="reds">4</i>个收货地址了，最多可创建<i class="reds">20</i>个</div>
                <div class="member-sites">
                <form action="/Address/{{$info->id}}" method="post">
                    <ul>
                    	
                        <li class="clearfix">
                        	
                            <div class="default fl"><a href="#">修改地址</a> </div>
                            
                            <div class="user-info1 fl clearfix">
                                <div class="user-info">
                                    <span class="info1">收货人：</span>
                                    
                                    <input type="text" name="name" value="{{$info->name}}">
                                </div>
                                <div class="user-info">
                                    <span class="info1">所在地区：</span>
                                    <input type="text" name="xhuo" value="{{$info->huo}}">
                                </div>
                                <div class="user-info">
                                    <span class="info1">地址：</span>
                                    <input type="text" name="huo" value="{{$info->huo}}">
                                </div>
                                <div class="user-info">
                                    <span class="info1">手机：</span>
                                    <input type="text" name="phone" value="{{$info->phone}}">
                                </div>
                                <div class="user-info">
                                    <span class="info1">固定电话：</span>
                                    <span class="info2">{{$info->phone}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="info1">电子邮箱：</span>
                                    <span class="info2">{{session('email')}}</span>
                                </div>
                            </div>

                            <div class="pc-event">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                            	<input type="submit" value="提交">
                                
                                
                            </div>
                            
                        </li>
                       
                    </ul>
                </form>
                </div>
                
            </div>
        </div>
@endsection
@section('title','订单查询')