<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div>
            <a href="#" data-provide="fullscreen" class="sidebar-toggle" title="Full Screen">
                <i class="mdi mdi-crop-free"></i>
            </a>
        </div>

        <div class="msg_box">您已經登入<button class="tst4 btn btn-danger btn-block mb-15">Danger Message</button></div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <li class="search-bar">
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="search">
                    </div>
                </li>

                {{--消息通知--}}
                @include(config('theme.user.header-notifications'))

                {{--使用者資料--}}
                @include(config('theme.user.header-user-profiles'))
            </ul>
        </div>
    </nav>
</header>
