@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>轮播图添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/banner" method="post" enctype="multipart/form-data"> 
     <div class="mws-form-inline"> 
      <!-- <div class="mws-form-row"> 
       <label class="mws-form-label">名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value=""/> 
       </div> 
      </div>  -->

       <div class="mws-form-row"> 
       <label class="mws-form-label">选择用户</label> 
       <div class="mws-form-item"> 
        <select name="user_id" class="large">
          <option value="0">--请选择--</option>
          @foreach($info as $v)
          <option value="{{$v->id}}">{{$v->name}}</option>
          @endforeach
        
        </select> 
       </div> 
      </div> 

      <div class="mws-form-row"> 
       <label class="mws-form-label">轮播图类别</label> 
       <div class="mws-form-item"> 
        <select name="banner_id" class="large">
          <option value="0">--请选择--</option>
          
          <option value="1">第一张轮播图</option>
          <option value="2">第二张轮播图</option>
          <option value="3">第三张轮播图</option>
          <option value="4">第四张轮播图</option>
          <option value="5">第五张轮播图</option>
          
        </select> 
       </div> 
      </div> 
      
      <div class="mws-form-row"> 
       <label class="mws-form-label">轮播图图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="banner"/> 
       </div> 
      </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","后台轮播图添加")