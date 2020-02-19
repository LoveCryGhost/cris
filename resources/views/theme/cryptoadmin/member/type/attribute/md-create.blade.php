<div class="box box-solid box-inverse box-dark">
    {{--<div class="box-header  p-5">--}}
        {{--<h5 class="box-title m-0">產品屬性</h5>--}}
    {{--</div>--}}
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_store(this, php_inject={{json_encode(['attributes' => $attributes])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Barcode</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" placeholder="自動生成"  disabled>
                    </div>
                </div>
                {{--Select2--}}
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">產品屬性</label>
                    <div class="col-sm-9">
                        <select class="select2_item form-control" name="a_id" id="a_id">
                            <option value="">Select...</option>
                            @foreach($attributes as $attribute)
                                <option value="{{$attribute->a_id}}" >{{$attribute->a_name}}</option>
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
    $(function() {

    });
</script>

<script type="text/javascript">

    $(function () {
        //Select2
        select2_item = $('.select2_item');
        select2_item.select2({
            theme: "bootstrap4"
        });
        //檢查是否有重複的Attribute & 並將其設定成Disable
        $('#tbl-type-attribute tbody tr').each(function () {
            select_a_id_val = $(this).children('td:eq(1)').find('input').val();
            $(".select2_item[id=a_id] option[value='"+select_a_id_val+"']").attr('disabled', 'disabled');
        });
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
            url: '{{route('member.type-attribute.store')}}',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {


                id_code = data.rows.id_code +
                            '<input name="a_ids[]"  value="'+ data.rows.a_id+'">';
                a_name = data.rows.a_name;
                html='<tr><td></td><td>'+id_code+'</td><td>'+a_name+'</td><td>ggg</td></tr>';
                $('#tbl-type-attribute tbody').append(html);
                $('#modal-md').hide();

                //排序
                $('#tbl-type-attribute tbody tr').each(function ($index) {
                    input_a_id = $(this).children('td:eq(1)').find('input').attr('name','a_ids['+($index+1)+']');
                    $(this).children('td:eq(0)').html($index+1);
                })

            },
            error: function(data) {
            }
        });
    }
</script>
