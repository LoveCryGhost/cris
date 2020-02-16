@extends(config('theme.member.member-app'))

@section('title','產品 - 類型')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                產品 - 類型
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-xl-12 col-lg-12 text-right mb-5">
                                <a class="btn btn-warning" href="{{route('member.type.create')}}" ><i class="fa fa-plus"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="d-none">
                                            <th>check</th>
                                            <th>Barcode</th>
                                            <th>名稱</th>
                                            <th></th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($types as $type)
                                        <tr>
                                            <td class="w-20 text-center">{{$loop->iteration}}</td>
                                            <td>{{$type->id_code}}</td>
                                            <td class="w-300">
                                                <p class="mb-0">
                                                    <a href="#"><strong>{{$type->t_name}}</strong></a><br>
                                                </p>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="bt-switch" name="is_active"  value="1" {{$type->is_active===1? "checked": ""}}
                                                       data-label-width="100%"
                                                       data-label-text="啟用"
                                                       data-on-text="On"    data-on-color="primary"
                                                       data-off-text="Off"  data-off-color="danger"/>
                                            </td>
                                            <td>
                                                <nav class="nav mt-2">
                                                    <a class="nav-link" href="#"><i class="fa fa-facebook"></i></a>
                                                    <a class="nav-link" href="#"><i class="fa fa-twitter"></i></a>
                                                    <a class="nav-link" href="#"><i class="fa fa-github"></i></a>
                                                    <a class="nav-link" href="#"><i class="fa fa-linkedin"></i></a>
                                                </nav>
                                            </td>

                                            <td>
                                                <a class="btn btn-warning btn-sm" href="{{route('member.type.edit', ['type'=> $type->t_id])}}"><i class="fa fa-edit mr-5"></i>編輯</a>
                                                <form action="{{route('member.type.destroy', ['type'=> $type->t_id])}}" method="post"
                                                      style="display: inline-block;"
                                                      onsubmit="return confirm('您确定要删除吗？');">
                                                        @csrf
                                                        @method('delete')
                                                    <button type="submit" class="btn btn-secondary btn-sm">
                                                        <i class="fa fa-trash mr-5"></i>刪除
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class=""> {{$types->links("pagination::bootstrap-4")}}</div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            $bt_switch = $('.bt-switch');
            $bt_switch.bootstrapSwitch('toggleState');
        })
    </script>

@endsection




