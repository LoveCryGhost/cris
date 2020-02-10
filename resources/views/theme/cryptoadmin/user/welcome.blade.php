@extends(config('theme.user.user-app'))

@section('title','使用者介面')

@section('content')
<div class="wrapper">
    <div class="content-wrapper" style="margin-left: 0px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h3>
                    Blank page
                </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                    <li class="breadcrumb-item active">Blank page</li>
                </ol>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Title</h4>
                            </div>
                            <div class="box-body">
                                This is some text within a card block.
                            </div>
                            <div class="box-footer">
                                Footer
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

        </div>
    </div>
</div>
@stop
