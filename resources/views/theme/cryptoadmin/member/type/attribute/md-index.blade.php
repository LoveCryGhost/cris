<div class="box box-solid box-inverse box-dark">
    <div class="box-header  p-5">
        <h5 class="box-title m-0">產品類型</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-md"
                   onclick="event.preventDefault();
                           md_insert(this, php_inject={{json_encode(['attributes' => ''])}});">
                    <i class="fa fa-plus"></i></a>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover" id="tbl-type-attribute">
                    <thead>

                    </thead>

                    <tbody>
                        @foreach($attributes as $attribute)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$attribute->id_code}}</td>
                                <td>{{$attribute->a_name}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@section('js')
<script type="text/javascript">
    function md_insert(_this,  attributes){
        //取得所有formData
        var formData = new FormData();
        //formData.append('_method','DELETE');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{route('member.type-attribute.create')}}',
            data: formData,
            async: true,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-md .modal-title').html('產品屬性');
                $('#modal-md .modal-body').html(data.view)
            },
            error: function(data) {
                swal('爬蟲錯誤', '', 'error');
            }
        });
    }
</script>
@endsection
