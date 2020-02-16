{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
<title>Member - @yield('title')</title>


{{--CSS--}}
@section('css')
    @parent
    @yield('css')
    @include(config('theme.member.css.default'))
@endsection


{{--繼承內容--}}
    @section('app-content-header')
        @yield('content-header')
    @endsection

    <body class="hold-transition light-skin dark-sidebar sidebar-mini theme-grey sidebar-collapse">
        <div id="app">
            @section('app-content')
                @guest('member')
                    @include(config('theme.member.header'))
                @else
                    @include(config('theme.member.header-login'))
                @endguest
                {{--內容--}}
                <div class="wrapper">
                    <div class="content-wrapper" style="margin-left: 0px;">
                        @yield('content')
                    </div>
                </div>
            @endsection
            @section('app-content-footer')
                @yield('content-footer')
                @include(config('theme.member.footer'))
            @endsection
        </div>
    </body>

{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

{{--Footer--}}
@include(config('theme.member.js.default'))