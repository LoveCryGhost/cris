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
                           md_supplier_contact_create(this, php_inject={{json_encode(['models'=>['supplier' => $supplier] ])}});">
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
                    <tbody>
                        @if(isset($supplier))
                            @foreach($supplier->supplierContacts(10) as $supplierContact)
                                <tr class="handle" data-detail-id="{{$supplierContact->sc_id}}">
                                    <td>
                                                <span class="handle" style="cursor: move;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                              </span>
                                    </td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$supplierContact->sc_name}}
                                        <input text="type" name="supplier_contacts[ids][]" hidden value="{{$supplierContact->sc_id}}">
                                        <input text="type" name="supplier_contacts[sc_name][]" hidden value="{{$supplierContact->sc_name}}">
                                    </td>
                                    <td>CRUD</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{$supplier->supplierContacts(10)->links()}}
            </div>
        </div>

    </div>
</div>

@section('js')
@parent
<script type="text/javascript">
    $(function () {
        //排序表格
        active_table_sortable(table_id="tbl-supplier-contact", eq_order_index=1, options={});
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });

    function md_supplier_contact_create(_this,  php_inject){
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'get',
            url: '{{route('member.supplier-contact.create')}}?s_id=' + php_inject.models.supplier.s_id,
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

</script>
@endsection
