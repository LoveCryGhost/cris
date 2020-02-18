{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
<title>User - @yield('title')</title>


{{--CSS--}}
@include(config('theme.user.css.default'))
@section('css')
    @parent
    @yield('css')
@endsection


{{--繼承內容--}}
    @section('app-content-header')
        @yield('content-header')
    @endsection

<body class="hold-transition light-skin dark-sidebar sidebar-mini theme-yellow sidebar-collapse">
    <div id="app">
        @section('app-content')
            @guest('web')
                @include(config('theme.user.header'))
            @else
                @include(config('theme.user.header-login'))
            @endguest
        @endsection
            {{--內容--}}
            <div class="wrapper">
                <div class="content-wrapper" style="margin-left: 0px;">
                    @yield('content')
                </div>
            </div>
        @section('app-content-footer')
            @yield('content-footer')

            @auth
                @include(config('theme.user.footer'))
            @endauth
        @endsection
    </div>
</body>

{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

{{--Footer--}}
@include(config('theme.user.js.default'))