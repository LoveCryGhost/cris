

    {{--繼承--}}
    @extends('layouts.app')


    {{--標題--}}
    @section('title','User Title')


    {{--CSS--}}
    @section('css')
        @parent
        @yield('css')
    @endsection


    {{--繼承內容--}}
    @section('app-content-header')
        @yield('content-header')
        {{--Header--}}
        @include('layouts.user.user-header')
    @endsection


    @section('app-content')

        <body class="hold-transition light-skin dark-sidebar sidebar-mini theme-yellow">
            <div id="app" class="{{ route_class() }}-page">
                {{--內容--}}
                @yield('content')
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
    @include('layouts.user.user-footer')