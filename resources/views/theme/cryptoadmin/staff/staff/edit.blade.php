@extends(config('theme.staff.staff-app'))

@section('title','個人信息')

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    個人訊息
                </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>首頁</a></li>
                    <li class="breadcrumb-item"><a href="#">staffs</a></li>
                    <li class="breadcrumb-item active">staffs Profile</li>
                </ol>
            </div>

            <!-- Main content -->
            <section class="content">
                <form method="post" action="{{route('staff.update', ['staff'=>$staff->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @include(config('theme.staff.view').'layouts.errors')
                        </div>
                        {{--個人信息--}}
                        <div class="col-xl-12 col-lg-12">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">個人信息</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">員工編號</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="is_active" placeholder="使用者名稱" value="{{$staff->name}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">啟用</label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="is_active" placeholder="使用者名稱" value="{{$staff->name}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">鎖定</label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="is_block" placeholder="使用者名稱" value="{{$staff->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">姓名</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="name" placeholder="姓名" value="{{$staff->name}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">性別</label>
                                                <div class="col-sm-1">
                                                    <input class="form-control" type="text" name="sex" placeholder="Sex" value="{{$staff->sex}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">身份字號</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="sex" placeholder="Sex" value="{{$staff->sex}}">
                                                </div>

                                                <label class="col-sm-2 col-form-label">生日</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$staff->birthday}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group row pull-right">
                                                <div class="img-preview-frame text-center" >
                                                    <input type="file" name="avatar" id="avatar"  onchange="showPreview(this,['avatar_img'])" style="display: none;"/>
                                                    <label for="avatar">
                                                        <img id="avatar_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$staff->avatar? asset($staff->avatar):asset('theme/cryptoadmin/images/2.jpg')}}" width="200px">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">面試日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$staff->birthday}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">入職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$staff->birthday}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">社保日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$staff->birthday}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">申請離職</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$staff->birthday}}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">離職日期</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{$staff->birthday}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">郵箱</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" value="{{$staff->email}}" placeholder="郵箱" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">自我介紹</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" type="text" name="introduction" placeholder="自我介紹">{{$staff->introduction}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row pull-right">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12">
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-header with-border">
                                <h3 class="box-title">聯繫人</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row"></div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">聯繫人1</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="text" name="contact1" placeholder="聯繫人1" value="{{$staff->contact1}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">電話1</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="text" name="tel1" placeholder="電話1" value="{{$staff->tel1}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">手機1</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="text" name="phone1"  placeholder="手機1" value="{{$staff->phone1}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">聯繫人2</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="text" name="contact2" placeholder="聯繫人2" value="{{$staff->contact2}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">電話2</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="text" name="tel2" placeholder="電話2" value="{{$staff->tel2}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">手機2</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="text" name="phone2" placeholder="手機2"  value="{{$staff->phone2}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <div class="form-group row pull-right">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-warning">提交訊息</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>







{{--                        --}}
                        <div class="col-xl-4 col-lg-5">
                            <!-- Profile Image -->
                            <div class="box bg-warning bg-deathstar-dark">
                                <div class="box-body box-profile">
                                    <div class="img-preview-frame text-center" >
                                        <input type="file" name="avatar" id="avatar"  onchange="showPreview(this,['avatar_img'])" style="display: none;"/>
                                        <label for="avatar">
                                            <img id="avatar_img" class="rounded img-fluid mx-auto d-block max-w-150" style="cursor: pointer;" src="{{$staff->avatar? asset($staff->avatar):asset('theme/cryptoadmin/images/2.jpg')}}" width="200px">
                                        </label>
                                    </div>

                                    <h2 class="profile-username text-center mb-0">{{$staff->name}}</h2>

                                    <h4 class="text-center mt-0"><i class="fa fa-envelope-o mr-10"></i>{{$staff->email}}</h4>
                                    <h5 class="text-center mt-0">加入時間 : {{$staff->created_at->diffForHumans()}}</h5>
                                    <div class="row social-states">
                                        <div class="col-6 text-right"><a href="#" class="link text-white"><i class="ion ion-ios-people-outline"></i> 254</a></div>
                                        <div class="col-6 text-left"><a href="#" class="link text-white"><i class="ion ion-images"></i> 54</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        {{--相關訊息--}}
                        <div class="col-xl-8 col-lg-7">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">個人信息</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">






                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                {{--更改密碼--}}
                <form method="post" action="{{route('staff.update_password', ['staff'=>$staff->id])}}" >
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xl-8 offset-xl-4 col-lg-8 offset-lg-4">
                            <div class="box box-solid box-inverse box-dark">
                                <div class="box-header with-border">
                                    <h3 class="box-title">密碼</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">舊密碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="old_password" placeholder="新密碼" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">新密碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="new_password" placeholder="新密碼" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">再次確認密碼</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="new_password_confirmation" placeholder="再次確認密碼" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-warning">提交訊息</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </section>
            <!-- /.content -->

        </div>
@stop

@section('js')
@parent
<script src="{{asset('js/images.js')}}"></script>
@endsection


