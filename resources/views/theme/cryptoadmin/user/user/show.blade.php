@extends(config('theme.user.user-app'))

@section('title','個人訊息')

@section('content')
<div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    Members Profile
                </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Members</a></li>
                    <li class="breadcrumb-item active">Members Profile</li>
                </ol>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">

                        <!-- Profile Image -->
                        <div class="box bg-warning bg-deathstar-dark">
                            <div class="box-body box-profile">
                                <img class="rounded img-fluid mx-auto d-block max-w-150" src="{{asset('theme/cryptoadmin/images/5.jpg')}}" alt="User profile picture">

                                <h2 class="profile-username text-center mb-0">{{Auth::user()->name}}</h2>

                                <h4 class="text-center mt-0"><i class="fa fa-envelope-o mr-10"></i>{{Auth::user()->email}}</h4>

                                <div class="row social-states">
                                    <div class="col-6 text-right"><a href="#" class="link text-white"><i class="ion ion-ios-people-outline"></i> 254</a></div>
                                    <div class="col-6 text-left"><a href="#" class="link text-white"><i class="ion ion-images"></i> 54</a></div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="media-list media-list-hover media-list-divided w-p100 mt-30">
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">My Profile</span>
                                            </h4>
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">Invests</span>
                                            </h4>
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">The Wallet</span>
                                            </h4>
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">Deposit</span>
                                            </h4>
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">Reports</span>
                                            </h4>
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">Services</span>
                                            </h4>
                                            <h4 class="media media-single p-15">
                                                <i class="fa fa-arrow-circle-o-right mr-10"></i><span class="title">Support</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <h2 class="title w-p100 mt-10 mb-0 p-20">Last Transactions</h2>
                                    <div class="col-12">
                                        <div class="media-list media-list-hover w-p100 mt-0">
                                            <h5 class="media media-single py-10 px-0 w-p100 justify-content-between">
                                                <p>
                                                    <i class="fa fa-circle text-red pr-10 font-size-12"></i>Deal number 1548
                                                    <span class="subtitle pl-20 mt-10">by<span class="text-red">Johen Doe</span></span>
                                                </p>
                                                <p class="text-right pull-right"><span class="badge badge-sm badge-danger mb-10">sell</span><br>0.12458921 BTC</p>
                                            </h5>
                                            <h5 class="media media-single py-10 px-0 w-p100 justify-content-between">
                                                <p>
                                                    <i class="fa fa-circle text-success pr-10 font-size-12"></i>Deal number 1548
                                                    <span class="subtitle pl-20 mt-10">by<span class="text-success">Johen Doe</span></span>
                                                </p>
                                                <p class="text-right pull-right"><span class="badge badge-sm badge-success mb-10">sell</span><br>0.12458921 BTC</p>
                                            </h5>
                                            <h5 class="media media-single py-10 px-0 w-p100 justify-content-between">
                                                <p>
                                                    <i class="fa fa-circle text-success pr-10 font-size-12"></i>Deal number 1548
                                                    <span class="subtitle pl-20 mt-10">by<span class="text-success">Johen Doe</span></span>
                                                </p>
                                                <p class="text-right pull-right"><span class="badge badge-sm badge-success mb-10">sell</span><br>0.12458921 BTC</p>
                                            </h5>
                                            <h5 class="media media-single py-10 px-0 w-p100 justify-content-between">
                                                <p>
                                                    <i class="fa fa-circle text-red pr-10 font-size-12"></i>Deal number 1548
                                                    <span class="subtitle pl-20 mt-10">by<span class="text-red">Johen Doe</span></span>
                                                </p>
                                                <p class="text-right pull-right"><span class="badge badge-sm badge-danger mb-10">sell</span><br>0.12458921 BTC</p>
                                            </h5>
                                            <h5 class="media media-single py-10 px-0 w-p100 justify-content-between">
                                                <p>
                                                    <i class="fa fa-circle text-success pr-10 font-size-12"></i>Deal number 1548
                                                    <span class="subtitle pl-20 mt-10">by<span class="text-success">Johen Doe</span></span>
                                                </p>
                                                <p class="text-right pull-right"><span class="badge badge-sm badge-success mb-10">sell</span><br>0.12458921 BTC</p>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-header with-border">
                                <h3 class="box-title">Personal details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Johon">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Doe">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email Adress</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" placeholder="johone@dummy.com">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="tel" placeholder="123 456 7890">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-warning">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-header with-border">
                                <h3 class="box-title">Personal address</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Street</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="A-458, Lorem Ipsum, city">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Your City">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">State</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Your State">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Post Code</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" placeholder="123456">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-warning">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <div class="box box-solid box-inverse box-dark">
                            <div class="box-header with-border">
                                <h3 class="box-title">Social media</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Facebook</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="facebook id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Instagram</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="instagram id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Twitter</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="twitter id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Linkedin</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="linkedin id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-warning">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                </div>
            </section>
            <!-- /.content -->

        </div>
@stop
