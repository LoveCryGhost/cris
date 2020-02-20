<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                           md_store(this, php_inject={{json_encode(['product' => $product])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-10">
                @include(config('theme.member.view').'layouts.errors')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="自動生成"  value="自動生成" disabled>
                    </div>


                    <label class="col-sm-2 col-form-label">啟用</label>
                    <div class="col-sm-4">
                        <input type="checkbox" class="bt-switch" name="is_active" id="is_active" value="1" {{old('is_active')==1? "checked":""}}
                        data-label-width="100%"
                               data-label-text="啟用" data-size="min"
                               data-on-text="On"    data-on-color="primary"
                               data-off-text="Off"  data-off-color="danger"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">售價</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" id="price"  placeholder="售價"  value="{{old('price')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">SKU名稱</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="sku_name" id="sku_name" placeholder="sku_name"  value="{{old('sku_name')}}">
                    </div>
                </div>
                @foreach($product->type->attributes as $attribute)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{$attribute->a_name}}</label>
                        <div class="col-sm-10">
                            <input class="form-control attributes" type="text" name="skus[{{$attribute->a_id}}]" placeholder=""  value="{{old('skus['.$attribute->a_id.']')}}">
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-2">
                <div class="form-group row">
                    <div class=" img-preview-frame text-center" >
                        <input type="file" name="thumbnail" id="thumbnail"  onchange="showPreview(this,['avatar_img'])" style="display: none;"/>
                        <label for="thumbnail">
                            <img id="avatar_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$product->thumbnail? asset($product->thumbnail):asset('images/default/products/product.jpg')}}" width="200px">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/images.js')}}"></script>
<!-- Form validator JavaScript -->
<script src="{{asset('theme/cryptoadmin/js/pages/validation.js')}}"></script>
<script src="{{asset('theme/cryptoadmin/js/pages/form-validation.js')}}"></script>
<script type="text/javascript">

    $(function(){

        //Switch
        $bt_switch = $('.bt-switch');
        $bt_switch.bootstrapSwitch('toggleState', true);
    });
    function md_store(_this,  php_inject){
        var formData = new FormData();
        formData.append('p_id', php_inject.product.p_id);
        formData.append('thumbnail', $('#thumbnail')[0].files[0]);
        formData.append('is_active', $('#is_active').prop('checked'));
        formData.append('sku_name', $('#sku_name').val());

        //數性值
        $(".attributes").each(function(){
           //取得元素
           input_el = $(this);
           //將值綁定到Form中
            formData.append(input_el.attr('name'), input_el.val());
        });
        formData.append('price', $('#price').val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{route('member.product-sku.store')}}',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                //關閉modal
                _modal = $('#modal-lg');
                _modal.children().find('.close').click();
                //清除modal
                _modal.children().find('.modal-body').html('');
                // cursor_move = '<span class="handle" style="cursor: move;">' +
                //     '                                        <i class="fa fa-ellipsis-v"></i>' +
                //     '                                        <i class="fa fa-ellipsis-v"></i>' +
                //     '                                  </span>';
                // id_code = data.rows.id_code +
                //     '<input name="a_ids[]"  value="'+ data.rows.a_id+'">';
                // a_name = data.rows.a_name;
                // html='<tr><td>'+cursor_move+'</td><td></td><td>'+id_code+'</td><td>'+a_name+'</td><td>ggg</td></tr>';
                // $('#tbl-type-attribute tbody').append(html);
                // $('#modal-md').hide();
                //
                // //排序
                // $('#tbl-type-attribute tbody tr').each(function ($index) {
                //     input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                //     $(this).children('td:eq(1)').html($index+1);
                // })

            },
            error: function(data) {
                //轉換物件
                var request = $.parseJSON(data.responseText);
                error_bag = $(_this).parents().closest('div.box-body').children().find('#modal_errors_div');
                error_bag.html('');
                $.each(request.errors, function(key, value) {
                    error_bag.append('<li>' + value + '</li>');
                });
                error_bag.show();
            }
        });
    }
</script>
