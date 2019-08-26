@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 会员地址列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
    
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">收货人</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">收货地址</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">电话</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
       @if(count($address))
       @foreach($address as $info)
       <tr class="odd"> 
        <td class="  sorting_1">{{$info->id}}</td> 
        <td class=" ">{{$info->name}}</td> 
        <td class=" ">{{$info->huo}}</td>
        <td class=" ">{{$info->phone}}</td>
       </tr>
       @endforeach
       @else
       <tr class="odd"> 
        <td class="  sorting_1" colspan="4">没有数据</td> 
        
       </tr>
       @endif
      </tbody>
     </table>
    
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","后台会员收货地址")