{{--这个类名对应下面 JS 选择器里写的类名--}}
<ul class="infinite-scroll">
    {{--循环输出列表--}}
    @if(!empty($crawlerItems))
        @foreach($crawlerItems as $crawlerItem)
            <li class="media">
                [{{$crawlerItem->ci_id}}] -- {{$crawlerItem->name}}
            </li>
        @endforeach
    @endif

    {{--点击加载下一页的按钮--}}
    <div class="text-center">
        {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
        @if( $crawlerItems->currentPage() == $crawlerItems->lastPage())
            <span class="text-center text-muted">没有更多了</span>
        @else
            {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
            <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerItems->nextPageUrl() }}">
                加载更多....
            </a>
        @endif
    </div>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script>
    $(function() {
        var options = {
            // 当滚动到底部时,自动加载下一页
            autoTrigger: true,
            // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
            autoTriggerUntil: 0,
            // 设置加载下一页缓冲时的图片
            loadingHtml: '<img class="align-self-center" src="/img/loading.jpg" alt="Loading..." style="width: 80px"/>',
            //设置距离底部多远时开始加载下一页
            padding: 0,
            nextSelector: 'a.jscroll-next:last',

            // 下一个自动加载的位置
            contentSelector: 'ul.infinite-scroll'
        };

        $('.infinite-scroll').jscroll(options);
    });
</script>