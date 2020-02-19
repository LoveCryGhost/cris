<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_store(this, php_inject={{json_encode([])}});">
                    <i class="fa fa-save"></i></a>
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_insert_row(this, php_inject={{json_encode([])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder=""  value="自動生成">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">圖片</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="thumbnail" placeholder="SKU名稱"  value="{{old('thumbnail')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">產品名稱</label>
                    <div class="col-sm-10">
                        <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{old('is_active')==1? "checked":""}}
                        data-label-width="100%"
                               data-label-text="啟用" data-size="min"
                               data-on-text="On"    data-on-color="primary"
                               data-off-text="Off"  data-off-color="danger"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">SKU名稱</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="sku_name" placeholder="sku_name"  value="{{old('sku_name')}}">
                    </div>
                </div>
                @foreach($product->type->attributes as $attribute)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{$attribute->a_name}}</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="skus[{{$attribute->a_id}}]" placeholder=""  value="{{old('skus['.$attribute->a_id.']')}}">
                        </div>
                    </div>
                @endforeach
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">售價</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" placeholder="售價"  value="{{old('price')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function(){
        //Switch
        $bt_switch = $('.bt-switch');
        $bt_switch.bootstrapSwitch('toggleState', true);
    });
    function md_store(_this,  attributes){
        var formData = new FormData();
        formData.append('a_id', $('#a_id').val());
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

                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';
                id_code = data.rows.id_code +
                    '<input name="a_ids[]"  value="'+ data.rows.a_id+'">';
                a_name = data.rows.a_name;
                html='<tr><td>'+cursor_move+'</td><td></td><td>'+id_code+'</td><td>'+a_name+'</td><td>ggg</td></tr>';
                $('#tbl-type-attribute tbody').append(html);
                $('#modal-md').hide();

                //排序
                $('#tbl-type-attribute tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                    $(this).children('td:eq(1)').html($index+1);
                })

            },
            error: function(data) {
            }
        });
    }

    function md_insert_row() {
        tbl = $('#tbl-product-sku-create-modal');
    }
</script>
