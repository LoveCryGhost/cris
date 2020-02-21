<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品SKU</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg"
                   onclick="event.preventDefault();
                           md_insert(this, php_inject={{json_encode(['master_id'=>$supplier->s_id])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-supplier-contact">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>排序</th>
                        <th>聯絡人</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    @if(isset($supplier))
                        @foreach($supplier->supplierContacts(3) as $supplierContact)
                            <tr class="handle" data-detail-id="{{$supplierContact->sc_id}}">
                                <td>
                                            <span class="handle" style="cursor: move;">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                          </span>
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$supplierContact->sc_name}}</td>

                                <td>CRUD</td>
                            </tr>
                        @endforeach
                    @endif

                </table>
                {{$supplier->supplierContacts(3)->links()}}
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
            $('#tbl-supplier-contact tbody').sortable({
                // placeholder         : 'sort-highlight',
                handle              : '.handle',
                forcePlaceholderSize: false,
                zIndex              : 999999,
                update              : table_order_tr
            });
            //Switch
            $bt_switch = $('.bt-switch');
            $bt_switch.bootstrapSwitch('toggleState', true);
        });

        function md_insert(_this,  php_inject){
            //取得所有formData
            // var formData = new FormData();
            //formData.append('_method','DELETE');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{route('member.supplier-contact.create')}}?s_id=' + php_inject.master_id,
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-lg .modal-title').html('供應商 - 聯絡人');
                    $('#modal-lg .modal-body').html(data.view)
                },
                error: function(data) {
                }
            });
        }
        function table_order_tr() {
            //排序
            $('#tbl-supplier-contact tbody tr').each(function ($index) {
                $(this).children('td:eq(1)').html($index+1);
            })
        }
    </script>
@endsection
