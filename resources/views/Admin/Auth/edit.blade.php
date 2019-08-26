@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>权限添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/auth/{{$info->id}}" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$info->name}}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">控制器名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="mname" value="{{$info->mname}}"/> 
       </div> 
      </div> 
      
      <div class="mws-form-row"> 
       <label class="mws-form-label">控制器方法</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="aname" value="{{$info->aname}}"/> 
       </div> 
      </div> 
      
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{method_field('PUT')}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","后台权限添加")