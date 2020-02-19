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
                    <label class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="自動生成"  disabled>
                    </div>
                </div>
                {{--Select2--}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">產品屬性</label>
                    <div class="col-sm-10">
                        <select class="select2-item" name="a_id" id="a_id">
                            <option value="">Select...</option>
                            @foreach($attributes as $attribute)
                            <option value="{{$attribute->a_id}}">{{$attribute->a_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    function md_store(_this,  attributes){
        var formData = new FormData();
        formData.append('a_id', 1);
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
                console.log(data);
                id_code = data.rows.id_code;
                a_name = data.rows.a_name;
                html='<tr><td><td><td>'+id_code+'</td><td>'+a_name+'</td></tr>';
                $('#tbl-type-attribute tbody').append(html);
                $('#modal-md').hide()
            // },
            error: function(data) {
            }
        });
    }
</script>
