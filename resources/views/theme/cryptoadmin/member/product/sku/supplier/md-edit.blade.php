<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                           md_product_sku_supplier_update(this, php_inject={{json_encode(['ss_id' => $data['ss_id'] , 's_id' => $supplier->s_id])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-2">
                <div class="form-group row">
                    <div class=" img-preview-frame text-center" >
                        <label for="sku_thumbnail">
                            <img id="sku_thumbnail_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$sku->thumbnail? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" width="200px">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-10">
                @include(config('theme.member.view').'layouts.errors')
                <table class="table table-bordered">
                    <tbody>
                        <tr class="m-0"><td>Barcode</td><td>{{$sku->id_code}}</td></tr>
                        <tr class="m-0"><td>啟用</td>
                            <td>
                                <input type="checkbox" class="bt-switch" name="is_active" id="is_active" value="1" {{$sku->is_active==1? "checked":""}}
                                data-label-width="100%"
                                       data-label-text="啟用" data-size="min"
                                       data-on-text="On"    data-on-color="primary"
                                       data-off-text="Off"  data-off-color="danger"/>
                            </td>
                        </tr>
                        <tr class="m-0"><td>售價</td><td>{{$sku->price}}</td></tr>
                        <tr class="m-0"><td>SKU名稱</td><td>{{$sku->sku_name}}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <select class="select2_item form-control" name="sku_supplier" id="sku_supplier" style="z-index: 9999;">
                    <option value="">Select...</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{$supplier->s_id}}">{{$supplier->id_code}} - {{$supplier->s_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">進貨價</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" id="price" placeholder="url">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="url" id="url" placeholder="url">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript">

    $(function () {
        //Select2
        select2_item = $('.select2_item');
        select2_item.select2({
            theme: "bootstrap4"
        });

        $bt_switch = $('.bt-switch');
        //$bt_switch.bootstrapSwitch('toggleState');

        //檢查是否有重複的Attribute & 並將其設定成Disable
        $('#tbl-product-sku-supplier tbody tr').each(function () {
            select_a_id_val = $(this).children('td:eq(3)').find('input').val();
            $(".select2_item[id=sku_supplier] option[value='"+select_a_id_val+"']").attr('disabled', 'disabled').append(' -- (Disabled)');
        });
    });

    function md_product_sku_supplier_update(_this,  _php_inject) {
        ss_id = _php_inject.ss_id;
        s_id =  _php_inject.s_id;
        var formData = new FormData();
        formData.append('_method', 'put');
        formData.append('ss_id', ss_id);
        formData.append('s_id', s_id);
        formData.append('url', $('#url').val());
        formData.append('price', $('#price').val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{route('member.product-sku-supplier.index')}}/'+ss_id+'?sku_id='+sku_id,
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                //搜尋sku_supplier
                sku_supplier = data.models.sku.sku_suppliers.find(function(sku_supplier, index, array){
                    return sku_supplier.pivot.ss_id == ss_id;
                });

                //關閉modal
                $('#modal-lg').children().find('.close').click();

                //顯示到modal left
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';

                url_path = "{{asset('/')}}";
                if(sku_supplier.name_card != null){
                    img_supplier  = '<img src="'+url_path+sku_supplier.name_card+'" style="width:70px;">';
                }else{
                    img_supplier  = '<img src="'+url_path+'/images/default/products/product.jpg" style="width:70px;">';
                }
                s_name = sku_supplier.s_name;

                switch_btn_checked="";
                if(sku_supplier.is_active === 1) {
                    switch_btn_checked = "checked";
                }
                switch_btn = '<input type="checkbox" class="bt-switch" name="is_active"  value="1" '+switch_btn_checked +
                    '                                                   data-label-width="100%"' +
                    '                                                   data-label-text="啟用"' +
                    '                                                   data-on-text="On"    data-on-color="primary"' +
                    '                                                   data-off-text="Off"  data-off-color="danger"/>';

                console.log(sku_supplier,sku_supplier.pivot);
                price = sku_supplier.pivot.price;
                url = sku_supplier.pivot.url;

                html ='<tr><td>'+cursor_move+'</td><td></td><td>'+img_supplier+'</td><td>'+s_name+'</td><td>'+switch_btn+'</td><td>'+price+'</td><td>'+url+'</td><td></td></tr>';
                tr = $('#tbl-product-sku-supplier tbody tr[data-ss-id='+ss_id+']');
                tr.after(html);
                tr.remove();

                //排序
                $('#tbl-product-sku-supplier tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(2)').find('input').attr('name','sku_suppliers[s_id]');
                    $(this).children('td:eq(1)').html($index+1);
                })

                $bt_switch = $('.bt-switch');
                $bt_switch.bootstrapSwitch('toggleState');



        },
            error: function(data) {
            }
        });
    }
</script>
