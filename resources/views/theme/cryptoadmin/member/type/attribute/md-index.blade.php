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
                           md_insert(this, php_inject={{json_encode(['attributes' => ''])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-type-attribute">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>排序</th>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($type))
                            @foreach($type->attributes as $attribute)
                                <tr class="handle">
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
                                        <input name="a_ids[]"  value="{{$attribute->a_id}}">
                                    </td>
                                    <td>{{$attribute->a_name}}</td>
                                    <td></td>
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
        //可以排序
        $('#tbl-type-attribute tbody').sortable({
            // placeholder         : 'sort-highlight',
            handle              : '.handle',
            forcePlaceholderSize: false,
            zIndex              : 999999,
            update              : table_order_tr
        });
    });
    function md_insert(_this,  attributes){
        //取得所有formData
        var formData = new FormData();
        //formData.append('_method','DELETE');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{route('member.type-attribute.create')}}',
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-md .modal-title').html('產品屬性');
                $('#modal-md .modal-body').html(data.view)
            },
            error: function(data) {
            }
        });
    }
    function table_order_tr() {
        //排序
        $('#tbl-type-attribute tbody tr').each(function ($index) {
            input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
            $(this).children('td:eq(1)').html($index+1);
        })
    }
</script>
@endsection
