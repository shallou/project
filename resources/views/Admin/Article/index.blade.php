@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 公告列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
    
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">操作</th>

        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">标题</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">内容</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">图片</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">作者</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $v)
       <tr class="odd"> 
        <td class="  sorting_1"><input type="checkbox" value="{{$v['id']}}"></td> 

        <td class="  sorting_1">{{$v['id']}}</td> 
        <td class=" ">{{$v['title']}}</td> 
        <td class=" ">{!!$v['descr']!!}</td> 
         <td class=" "><img src="{{$v['thumb']}}"></td> 
         <td class=" ">{{$v['editor']}}</td> 
 
        <td class=" ">
          <a href="/adminarticles/{{$v['id']}}/edit"class="btn btn-info"><i class="icon-wrench"></i></a></td> 
       </tr>
       @endforeach
       <tr>
         <td colspan='7'><a href="JavaScript:void(0)"class="btn btn-success allchoose">全选</a>
         <a href="JavaScript:void(0)"class="btn btn-success nochoose">全不选</a>
         <a href="JavaScript:void(0)"class="btn btn-success fchoose">反选</a></td>
       </tr>
       
       <tr>
         <td colspan="7">
         <a href="JavaScript:void(0)" class="btn btn-danger del">删除</a>
       </td>
       </tr>
      </tbody>
     </table>
    
     <div class="dataTables_paginate paging_full_numbers" id="pages">
    
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
   // alert($);
   // 全选
   $('.allchoose').click(function(){
    $('#DataTables_Table_1').find('tr').each(function(){
      // alert('ss');
      $(this).find(':checkbox').attr('checked',true);
    });
   });

   // 全bu选
    $('.nochoose').click(function(){
    $('#DataTables_Table_1').find('tr').each(function(){
      // alert('ss');
      $(this).find(':checkbox').attr('checked',false);
    });
   });

    // 反选
    $('.fchoose').click(function(){
       $('#DataTables_Table_1').find('tr').each(function(){
        if($(this).find(':checkbox').attr('checked')){
          // 取消选中
          $(this).find(':checkbox').attr('checked',false);
        }else{
          // 选中
          $(this).find(':checkbox').attr('checked',true);
        }
       });
    });
    // 删除
    arr=[];
    $('.del').click(function(){
      $('#DataTables_Table_1').find('tr').each(function(){
        if($(this).find(':checkbox').attr('checked')){
          id=$(this).find(':checkbox').val();
          // alert(id);
          // 把选中的id添加数组里
          arr.push(id);
        }
       });
      // alert(arr);
      // 触发Ajax请求
      $.get('/articledel',{arr:arr},function(data){
        // alert(data);
        if(data==1){
          // 删除选中数据的tr
          // 遍历arr数组 找input 

          for(var i=0;i<arr.length;i++){
            $('input[value='+arr[i]+']').parents('tr').remove();
           
          }
          // alert('删除成功');
        }else{
          alert(data);
        }
      });
    });
 </script>
</html>
@endsection
@section("title","后台公告列表")