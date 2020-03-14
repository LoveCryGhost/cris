<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0"> 員工所屬 - 部門 </h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="btn btn-warning" data-toggle="modal" data-target="#modal-lg"
                        onclick="event.preventDefault();
                        md_product_sku_supplier_create(this, php_inject={{json_encode(['models' => ['staff' => $staff]])}});">
                <i class="fa fa-plus"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-staff-staff_department">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>排序</th>
                            <th>轉調部門</th>
                            <th>獎金</th>
                            <th>轉調起始日期</th>
                            <th>建立者</th>
                            <th>修改者</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($staff->staffDepartments)>0 )
                            @foreach($staff->staffDepartments as $staffDepartment)
                               <tr data-ss-id="{{$staffDepartment->pivot->sd_id}}">
                                   <td>
                                        <span class="handle" style="cursor: move;">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                   </td>
                                   <td>{{$loop->iteration}}</td>
                                   <td>
                                       @if($staffDepartment->parent==null)
                                            {{$staffDepartment->name}} -
                                       @else
                                           {{$staffDepartment->parent->name}} - {{$staffDepartment->name}}
                                       @endif
                                   </td>
                                   <td>
                                       {{$staffDepartment->pivot->bonus}}
                                   </td>
                                   <td>
                                       {{$staffDepartment->pivot->start_at}}
                                   </td>
                                   <td>
                                       {{$staff->created_by->first()->name}}
                                   </td>
                                   <td>
                                       {{$staff->modified_by->first()->name}}
                                   </td>
                                   <td>
                                       <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"
                                          onclick="event.preventDefault(); md_staff_department_edit(this, php_inject={{json_encode(['models' => [ 'staff' => $staff]])}});">
                                           <i class="fa fa-edit mr-5"></i>編輯
                                       </a>
                                   </td>
                               </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@section('js')
    @parent
    @yield('js')
<script type="text/javascript">
    $(function(){
        //排序表格
        active_table_sortable(table_id="tbl-staff-staff_department", eq_order_index=1, options={});
        //Switch
        // active_switch(switch_class='bt-switch', options=[]);
    });

    function md_staff_department_edit(_this,  php_inject){
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('staff.staff-department.index')}}/'+php_inject.models.staff.id+'/edit',
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-lg .modal-title').html('員工-部門');
                $('#modal-lg .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }

    function md_staff_department_create(_this,  php_inject){
        {{--$.ajaxSetup(active_ajax_header());--}}
        {{--$.ajax({--}}
        {{--    type: 'get',--}}
        {{--    url: '{{route('member.product-sku.create')}}?p_id=' + php_inject.models.product.p_id,--}}
        {{--    data: '',--}}
        {{--    async: true,--}}
        {{--    crossDomain: true,--}}
        {{--    contentType: false,--}}
        {{--    processData: false,--}}
        {{--    success: function(data) {--}}
        {{--        $('#modal-lg .modal-title').html('產品 - SKU');--}}
        {{--        $('#modal-lg .modal-body').html(data.view)--}}
        {{--    },--}}
        {{--    error: function(data) {--}}
        {{--    }--}}
        {{--});--}}
    }


</script>
@endsection
