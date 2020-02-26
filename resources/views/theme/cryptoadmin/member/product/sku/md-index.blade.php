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
                           md_insert(this, php_inject={{json_encode(['master_id'=>$product->p_id])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-product-sku">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>排序</th>
                        <th>名稱</th>
                        <th>圖片</th>
                        <th>啟用</th>
                        @foreach($product->type->attributes as $attribute)
                            <th>{{$attribute->a_name}}</th>
                        @endforeach
                        <th>價錢</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                        @if(isset($product))
                            @foreach($product->skus(10) as $sku)
                                <tr class="handle" data-md-id="{{$sku->sku_id}}">
                                    <td>
                                            <span class="handle" style="cursor: move;">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                          </span>
                                    </td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$sku->sku_name}}</td>
                                    <td>
                                        <img src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}} " class="product-sku-thumbnail">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="bt-switch"  value="1" {{$product->is_active==1? "checked":""}}
                                        data-label-width="100%"
                                               data-label-text="啟用" data-size="min"
                                               data-on-text="On"    data-on-color="primary"
                                               data-off-text="Off"  data-off-color="danger"/>
                                    </td>
                                    @foreach($sku->skuAttributes as $attribute)
                                    <td>{{$attribute->a_value}}</td>
                                    @endforeach
                                    <td>{{$sku->price}}</td>
                                    <td>
                                        @include('theme.cryptoadmin.member.layouts.btn-md-index-table_tr', ['route_name'=> 'member.product-sku', 'm_id' => $sku->sku_id])
                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-left"
                                                onclick="event.preventDefault();
                                                md_product_sku_supplier_index(this, php_inject={{json_encode([ 'sku_id' => $sku->sku_id])}});">
                                        <i class="fa fa-plus mr-5">供應商</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                </table>
                {{$product->skus(10)->links()}}
            </div>
        </div>

    </div>
</div>

@section('js')
    @parent
    @yield('js')

    <script type="text/javascript">
        $(function () {
            //可以排序
            $('#tbl-product-sku tbody').sortable({
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
                url: '{{route('member.product-sku.create')}}?p_id=' + php_inject.master_id,
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-lg .modal-title').html('產品SKU');
                    $('#modal-lg .modal-body').html(data.view)
                },
                error: function(data) {
                }
            });
        }
        function table_order_tr() {
            //排序
            $('#tbl-product-sku tbody tr').each(function ($index) {
                input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                $(this).children('td:eq(1)').html($index+1);
            })
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
                url: '{{route('member.product-sku.index')}}/'+m_id+'/edit?m_id='+m_id,
                data: formData,
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-md .modal-title').html('編輯 - 產品SKU');
                    $('#modal-md .modal-body').html(data.view);
                },
                error: function(data) {
                }
            });
        }

        function md_product_sku_supplier_index(_this,  _php_inject) {
            sku_id = p_id = _php_inject.sku_id;

            //Product_SKUSupplier index

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{route('member.product-sku-supplier.index')}}?sku_id='+sku_id,
                data: '',
                async: true,
                crossDomain: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-left .modal-title').html('供應商 - 列表');
                    $('#modal-left .modal-body').html(data.view);
                },
                error: function(data) {
                }
            });
        }
    </script>
@endsection
