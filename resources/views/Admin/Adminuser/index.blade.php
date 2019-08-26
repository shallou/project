@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 管理员列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <form action="/users1" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>搜索名字: <input type="text" aria-controls="DataTables_Table_1" name="keywords"><input type="submit" value="搜索"></label>
     </div>
     </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">名字</th>

        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($user as $v)
       <tr class="odd"> 
        <td class="  sorting_1">{{$v->id}}</td> 
        <td class=" ">{{$v->name}}</td> 
        <td class=" ">
          <a href="/adminusesrrole/{{$v->id}}" class="btn btn-success">分配角色</a>
          <form action="/adminusers/{{$v->id}}" method="post">
            <button class="btn btn-success" type="submit"><i class="icon-trash"></i></button>
            {{csrf_field()}}
            {{method_field('DELETE')}}
          </form>
          <a href="/adminusers/{{$v->id}}/edit"class="btn btn-info"><i class="icon-wrench"></i></a></td> 
       </tr>
       @endforeach
      </tbody>
     </table>
    
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {{$user->render()}}
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","后台管理员列表")