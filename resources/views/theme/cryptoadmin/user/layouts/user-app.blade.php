{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
@section('title','User Title')


{{--CSS--}}
@section('css')
    @parent
    @yield('css')
    @include(config('theme.user.css.default'))
@endsection


{{--繼承內容--}}
    @section('app-content-header')
        @yield('content-header')
    @endsection


    @section('app-content')
        <body class="hold-transition light-skin dark-sidebar sidebar-mini theme-yellow sidebar-collapse">
            <div id="app">
                @guest
                    @include(config('theme.user.header'))
                @else
                    @include(config('theme.user.header-login'))
                @endguest
                {{--內容--}}
                @yield('content')

                @include(config('theme.user.footer'))

            </div>
        </body>
    @endsection


    @section('app-content-footer')
        @yield('content-footer')
    @endsection


{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

{{--Footer--}}
@include(config('theme.user.js.default'))