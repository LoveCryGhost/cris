<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品SKU - 供應商列表</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="btn btn-warning" data-toggle="modal" data-target="#modal-lg"
                        onclick="event.preventDefault();
                        md_product_sku_supplier_create(this, php_inject={{json_encode([])}});">
                <i class="fa fa-plus"></i></a>
            </div>
            {{--<div class="col-md-12">--}}

                {{--<div class="form-group row">--}}
                    {{--<label class="col-sm-2 col-form-label">供應商</label>--}}
                    {{--<div class="col-sm-10">--}}
                        {{--<select class="select2_item form-control" name="sku_supplier" id="sku_supplier" style="z-index: 9999;">--}}
                            {{--<option value="">Select...</option>--}}
                            {{--@foreach($suppliers as $supplier)--}}
                                {{--<option value="{{$supplier->s_id}}">{{$supplier->id_code}} - {{$supplier->s_name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group row">--}}
                    {{--<img>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="{{$sku->thumbnail? asset($sku->thumbnail) : '/images/default/products/product.jpg'}}" style="width: 100px;">
            </div>
            <div class="col-md-8">

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-product-sku-supplier">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>排序</th>
                            <th>圖片</th>
                            <th>名稱</th>
                            <th>啟用</th>
                            <th>報價錢</th>
                            <th>連結</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($sku->skuSuppliers)>0)
                            @foreach($sku->skuSuppliers as $skuSupplier)
                               <tr data-ss-id="{{$skuSupplier->pivot->ss_id}}">
                                   <td>
                                        <span class="handle" style="cursor: move;">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                   </td>
                                   <td>{{$loop->iteration}}</td>
                                   <td>
                                       <img src="{{$skuSupplier->name_card? asset($skuSupplier->name_card): "/images/default/products/product.jpg"}}" style="width: 70px;">
                                   </td>
                                   <td>{{$skuSupplier->s_name}}
                                       <input type="text" name="sku_suppliers[s_id]" hidden value="{{$skuSupplier->s_id}}">
                                   </td>
                                   <td>
                                       <input type="checkbox" class="bt-switch"  value="1" {{$skuSupplier->is_active==1? "checked":""}}
                                            data-label-width="100%"
                                            data-label-text="啟用" data-size="min"
                                            data-on-text="On"    data-on-color="primary"
                                            data-off-text="Off"  data-off-color="danger"/>
                                   </td>
                                   <td>{{$skuSupplier->pivot->price}}</td>
                                   <td>
                                       <a class="btn btn-sm btn-primary" href="{{$skuSupplier->pivot->url}}" target="_blank"><i class="fa fa-link"></i></a>
                                   </td>
                                   <td>
                                       <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-lg"
                                          onclick="event.preventDefault(); md_product_sku_supplier_edit(this, php_inject={{json_encode([ 'ss_id' => $skuSupplier->pivot->ss_id, 'sku_id' => $sku->sku_id, 's_id' => $skuSupplier->pivot->s_id])}});">
                                           <i class="fa fa-edit mr-5">編輯</i>
                                       </a>
                                   </td>
                               </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{--{{$product->skus(10)->links()}}--}}
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function(){

        //可以排序
        $('#tbl-product-sku-supplier tbody').sortable({
            // placeholder         : 'sort-highlight',
            handle              : '.handle',
            forcePlaceholderSize: false,
            zIndex              : 999999,
            update              : table_order_tr
        });
        //Switch
        $bt_switch = $('.bt-switch');
        $bt_switch.bootstrapSwitch('toggleState', true);

        select2_item = $('.select2_item');
        select2_item.select2({
            theme: "bootstrap4"
        });
    });

    function table_order_tr() {
    //排序
    $('#tbl-product-sku-supplier tbody tr').each(function ($index) {
        input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
            $(this).children('td:eq(1)').html($index+1);
        })
    }


    function md_product_sku_supplier_edit(_this,  _php_inject) {
        ss_id = _php_inject.ss_id;
        sku_id = _php_inject.sku_id;
        s_id = _php_inject.s_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{route('member.product-sku-supplier.index')}}/'+ss_id+'/edit?ss_id='+ ss_id + '&sku_id='+ sku_id + '&s_id='+s_id,
            data: '',
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-lg .modal-title').html('SKU供應商 - 編輯');
                $('#modal-lg .modal-body').html(data.view);
            },
            error: function(data) {
            }
        });
    }

    function md_product_sku_supplier_create(_this,  _php_inject) {
        {{--p_id = _php_inject.master_id;--}}
        {{--sku_id = p_id = _php_inject.sku_id;--}}

        {{--//Product_SKUSupplier index--}}

        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}
        {{--$.ajax({--}}
            {{--type: 'get',--}}
            {{--url: '{{route('member.product-sku-supplier.index')}}?sku_id='+sku_id,--}}
            {{--data: '',--}}
            {{--async: true,--}}
            {{--crossDomain: true,--}}
            {{--contentType: false,--}}
            {{--processData: false,--}}
            {{--success: function(data) {--}}
                {{--$('#modal-left .modal-title').html('供應商 - 列表');--}}
                {{--$('#modal-left .modal-body').html(data.view);--}}
            {{--},--}}
            {{--error: function(data) {--}}
            {{--}--}}
        {{--});--}}
    }
</script>
