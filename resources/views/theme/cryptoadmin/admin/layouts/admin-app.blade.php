{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
@section('title','User Title')


{{--CSS--}}
@section('css')
    @parent
    @yield('css')
    @include(config('theme.admin.css.default'))
@endsection


{{--繼承內容--}}
    @section('app-content-header')
        @yield('content-header')
    @endsection

    <body class="hold-transition fixed light-skin dark-sidebar sidebar-mini theme-blue">
        <div id="app">
            @section('app-content')
                @guest('admin')
                    @include(config('theme.admin.header'))
                @else
                    @include(config('theme.admin.header-login'))
                    @include(config('theme.admin.sidebar'))
                @endguest
                {{--內容--}}
                <div class="wrapper">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>
            @endsection
            @section('app-content-footer')
                @yield('content-footer')
                @include(config('theme.admin.footer'))
            @endsection
        </div>
    </body>



{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

{{--Footer--}}
@include(config('theme.admin.js.default'))