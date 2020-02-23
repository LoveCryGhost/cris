<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                           md_update(this, php_inject={{json_encode([ 'original_md_id' => $sku->sku_id, 'sku' => $sku])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-10">
                @include(config('theme.member.view').'layouts.errors')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" placeholder="自動生成"  value="{{$sku->id_code}}" disabled>
                    </div>
                    <label class="col-sm-2 col-form-label">啟用</label>
                    <div class="col-sm-2">
                        <input type="checkbox" class="bt-switch" name="is_active" id="is_active" value="1" {{$sku->is_active==1? "checked":""}}
                        data-label-width="100%"
                               data-label-text="啟用" data-size="min"
                               data-on-text="On"    data-on-color="primary"
                               data-off-text="Off"  data-off-color="danger"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">售價</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" id="price"  placeholder="售價"  value="{{$sku->price}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">SKU名稱</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="sku_name" id="sku_name" placeholder="sku_name"  value="{{$sku->sku_name}}">
                    </div>
                </div>
                @foreach($sku->skuAttributes as $skuAttribute)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{$skuAttribute->attribute->a_name}}</label>
                        <div class="col-sm-10">
                            <input class="form-control attributes" type="text" name="sku_attributes[{{$skuAttribute->a_id}}]" placeholder=""  value="{{$skuAttribute->a_value}}">
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-2">
                <div class="form-group row">
                    <div class=" img-preview-frame text-center" >
                        <input type="file" name="sku_thumbnail" id="sku_thumbnail"  onchange="showPreview(this,['sku_thumbnail_img'])" style="display: none;"/>
                        <label for="sku_thumbnail">
                            <img id="sku_thumbnail_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$sku->thumbnail? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" width="200px">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script src="{{asset('js/images.js')}}"></script>
<script type="text/javascript">

    $(function () {
        //Select2
        select2_item = $('.select2_item');
        select2_item.select2({
            theme: "bootstrap4"
        });
    });

    function md_update(_this,  php_inject){
        original_md_id = php_inject.original_md_id;
        m_id = php_inject.sku.sku_id;
        var formData = new FormData();
        formData.append('_method', 'put');
        formData.append('sku_id', php_inject.sku.sku_id);
        formData.append('thumbnail', $('#sku_thumbnail')[0].files[0]);
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
            url: '{{route('member.product-sku.index')}}/'+ m_id,
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data,original_md_id);
                $('#tbl-product-sku tbody tr[data-md-id='+original_md_id+']').remove();

                //新增增加的
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';
                id_code = data.rows.id_code +
                    '<input name="a_ids[]" hidden value="'+ data.rows.a_id+'">';
                a_name = data.rows.a_name;
                crud_btn = '<a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-md"'+
                    'onclick="event.preventDefault();'+
                    'md_edit(this, php_inject={m_id:'+ m_id +'})">'+
                    '<i class="fa fa-edit mr-5"></i>編輯</a>';
                html='<tr data-md-id="'+data.rows.a_id+'"><td>'+cursor_move+'</td><td></td><td>'+id_code+'</td><td>'+a_name+'</td><td>'+crud_btn+'</td></tr>';
                $('#tbl-product-sku tbody').append(html);
                //關閉modal
                $('#modal-md').children().find('.close').click();

                //排序
                $('#tbl-product-sku tbody tr').each(function ($index) {
                    // input_a_id = $(this).children('td:eq(2)').find('input').attr('name','a_ids[]');
                    $(this).children('td:eq(1)').html($index+1);
                })

            },
            error: function(data) {
            }
        });
    }
</script>
