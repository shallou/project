@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 订单列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <div id="did">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">名字</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">数量</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">图片</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">订单号</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">价格</th>
       
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($info as $key=>$value)
        @if($value->statuss !=3)
       <tr class="odd"> 
        <td class="  sorting_1">{{$value->gid}}</td> 
        <td class=" ">{{$value->name}}</td> 
        <td class=" ">{{$value->num}}</td> 
        <td class=" "><img src="{{$value->pic}}" width="100px" height="100px"></td> 
        <td class=" ">{{$value->order_num}}</td> 
        <td class=" ">{{$value->tot}}元</td> 
        
        <td class=" ">
          @if($value->statuss == 0)
          <a href="/orderforms/{{$value->gid}}"class="btn btn-success"><i class="icon-wrench">开始发货</i></a></td> 
          @elseif($value->statuss ==2)
          <a href=""class="btn btn-success"><i class="icon-wrench">已发货</i></a></td> 
          @elseif($value->statuss ==1)
          <a href=""class="btn btn-success"><i class="icon-wrench">已收货</i></a></td> 
          @endif
       </tr>
       @endif
       @endforeach
      </tbody>
     </table>
    </div>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {{$info->render()}}
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 </script>
</html>
@endsection
@section("title","后台订单列表")