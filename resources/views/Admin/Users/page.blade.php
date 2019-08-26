<div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <div id="did">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 192px;">名字</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">邮箱</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">状态</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">添加时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 120px;">修改时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 87px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $v)
       <tr class="odd"> 
        <td class="  sorting_1">{{$v->id}}</td> 
        <td class=" ">{{$v->name}}</td> 
        <td class=" ">{{$v->email}}</td> 
        <td class=" ">{{$v->status}}</td> 
        <td class=" ">{{$v->created_at}}</td> 
        <td class=" ">{{$v->updated_at}}</td> 
        <td class=" ">
          <a href="/userinfo/{{$v->id}}"class="btn btn-success">获取会员详情信息</a>
          <a href="/useraddress/{{$v->id}}"class="btn btn-success">获取收货地址</a>
          <form action="/users1/{{$v->id}}" method="post">
            <button class="btn btn-success" type="submit"><i class="icon-trash"></i></button>
            {{csrf_field()}}
            {{method_field('DELETE')}}
          </form>
          <a href="/users1/{{$v->id}}/edit"class="btn btn-info"><i class="icon-wrench"></i></a></td> 
       </tr>
       @endforeach
      </tbody>
     </table>
    </div>
    </div> 