<div class="box box-solid box-inverse box-dark">

    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_update(this, php_inject={{json_encode(['original_md_id' => $attribute->a_id])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-12">
                {{--Select2--}}
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">產品屬性</label>
                    <div class="col-sm-9">
                        <select class="select2_item form-control" name="a_id" id="a_id">
                            <option value="">Select...</option>
                            @foreach($attributes as $attr)
                                <option value="{{$attr->a_id}}">{{$attr->id_code}} - {{$attr->a_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">


<script type="text/javascript">

    $(function () {
        //Select2
        select2_item = $('.select2_item');
        select2_item.select2({
            theme: "bootstrap4"
        });
        //檢查是否有重複的Attribute & 並將其設定成Disable
        $('#tbl-type-attribute tbody tr').each(function () {
            select_a_id_val = $(this).children('td:eq(2)').find('input').val();
            $(".select2_item[id=a_id] option[value='"+select_a_id_val+"']").attr('disabled', 'disabled').append(' -- (Disabled)');
        });
    });

    function md_update(_this,  php_inject){
        original_md_id = php_inject.original_md_id;
        var formData = new FormData();
        m_id = $('#a_id').val();
        formData.append('a_id', m_id);
        formData.append('_method', 'put');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{route('member.type-attribute.index')}}/'+ m_id,
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                //移除原本的
                $('#tbl-type-attribute tbody tr[data-md-id='+original_md_id+']').remove();

                //新增增加的
                cursor_move = '<span class="handle" style="cursor: move;">' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                        <i class="fa fa-ellipsis-v"></i>' +
                    '                                  </span>';
                id_code = data.rows.id_code +
                            '<input name="a_ids[]" hidden value="'+ data.rows.a_id+'">';
                a_name = data.rows.a_name;
                html='<tr data-md-id="'+data.rows.a_id+'"><td>'+cursor_move+'</td><td></td><td>'+id_code+'</td><td>'+a_name+'</td><td>ggg</td></tr>';
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
</script>
