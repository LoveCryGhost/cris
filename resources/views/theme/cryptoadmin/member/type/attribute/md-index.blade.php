<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品類型</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_type_attribute_create(this, php_inject={{json_encode(['models'=>['type' => $type]])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-type-attribute">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>排序</th>
                            <th>Barcode</th>
                            <th>屬性</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($type))
                            @foreach($type->attributes as $attribute)
                                <tr class="handle" data-md-id="{{$attribute->a_id}}">
                                    <td>
                                        <span class="handle" style="cursor: move;">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                    </td>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$attribute->id_code}}
                                        <input name="a_ids[]" hidden value="{{$attribute->a_id}}">
                                    </td>
                                    <td>{{$attribute->a_name}}</td>
                                    <td>
                                        @include('theme.cryptoadmin.member.layouts.btn-md-index-table_tr', ['route_name'=> 'member.type-attribute', 'm_id' => $attribute->a_id])
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
@yield('jss')
<script type="text/javascript">
    $(function () {
        //排序表格
        active_table_sortable(table_id="tbl-type-attribute", eq_order_index=1, options={});
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });

    function md_type_attribute_create(_this,  php_inject){
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('member.type-attribute.create')}}?t_id=' + php_inject.models.type.t_id,
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-md .modal-title').html('產品屬性');
                $('#modal-md .modal-body').html(data.view);

                //插入排序value
                $('#tbl-type-attribute tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                })
            },
            error: function(data) {
            }
        });
    }

    function md_edit(_this,  _php_inject){
        m_id = _php_inject.m_id;
        //取得所有formData
        var formData = new FormData();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{route('member.type-attribute.index')}}/'+m_id+'/edit?m_id='+m_id,
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-md .modal-title').html('編輯 - 產品屬性');
                $('#modal-md .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }
</script>
@endsection
