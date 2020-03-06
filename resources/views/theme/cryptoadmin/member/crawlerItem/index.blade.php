@extends(config('theme.member.member-app'))

@section('title','Shopee任務 - 列表')

@section('content-header','')

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h3>
            Shopee任務 - 列表
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Members</a></li>
            <li class="breadcrumb-item active">Members List</li>
        </ol>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        {{--CrawlerTask 爬蟲任務--}}
                        <div class="">
                            <table class=" table-primary table-bordered table-striped">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr><td>任務名稱</td><td>{{$crawlerTask->ct_name}}</td></tr>
                                    <tr><td>網址</td><td>{{$crawlerTask->url}}</td></tr>
                                    <tr><td>網域</td><td>{{$crawlerTask->domain}}</td></tr>
                                    <tr><td>頁數</td><td>{{$crawlerTask->pages}}</td></tr>
                                    <tr><td>類別</td><td>{{$crawlerTask->cat}}</td></tr>
                                    <tr><td>搜索方式</td><td>{{$crawlerTask->sort_by}}</td></tr>
                                    <tr><td>國家</td><td>{{$crawlerTask->local}}</td></tr>
                                    <tr><td>創建者</td><td>{{$crawlerTask->member->name}}</tr>
                                </tbody>
                            </table>
                        </div>

                        {{--CrawlerItem 爬蟲項目--}}
                        <div class="infinite-scroll">
                            @foreach($crawlerItems as $crawlerItem)
                                <div class="media-heading item-div pull-up">
                                    <div class="row">
                                        <div class="col-md-1">
                                            [{{($crawlerItems->currentPage()-1)*($crawlerItems->perPage()) + $loop->iteration}}]
                                        </div>
                                        <div class="col-md-1">
                                            <img src="https://cf.shopee.tw/file/{{$crawlerItem->images}}_tn" class="item-image"><br>
                                        </div>
                                        <div class="col-md-7">
                                            <a>{{ $crawlerItem->name }}</a><br>
                                            <a class="btn btn-sm btn-info" target="_blank"
                                               href="https://shopee.tw/{{$crawlerItem->name}}-i.{{$crawlerItem->shopid}}.{{$crawlerItem->itemid}}" ><i class="fa fa-external-link"></i></a>
                                            <a class="btn btn-sm btn-info" target="_blank"
                                               href="https://shopee.tw/shop/{{$crawlerItem->shopid}}" ><i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-left"
                                               onclick="show_crawler_item_skus(this, php_inject={{json_encode(['models' => ['crawlerItem' => $crawlerItem]])}})">SKU-明細</a><br>
                                            銷量 : {{$crawlerItem->sold}}<br>
                                            歷史銷量 : {{$crawlerItem->historical_sold}}<br>
                                            最後更新時間 : {{$crawlerItem->updated_at->diffForHumans()}}<br>

                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            {{--点击加载下一页的按钮--}}
                            <div class="text-center">
                                {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                @if( $crawlerItems->currentPage() == $crawlerItems->lastPage())
                                    <span class="text-center text-muted">没有更多了</span>
                                @else
                                    {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                    <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $crawlerItems->appends($filters)->nextPageUrl() }}">
                                        加载更多....
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    @parent
<script src="https://cdn.bootcss.com/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script type="text/javascript">
// $('ul.pagination').hide();
$(function() {
    $('.infinite-scroll').jscroll({
        // 当滚动到底部时,自动加载下一页
        autoTrigger: true,
        // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
        autoTriggerUntil: 4-1,
        // 设置加载下一页缓冲时的图片
        loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
        padding: 0,
        nextSelector: 'a.jscroll-next:last',
        contentSelector: 'div.infinite-scroll',

    });
});

function show_crawler_item_skus(_this, php_inject) {
    $.ajaxSetup(active_ajax_header());
    $.ajax({
        type: 'get',
        url: '{{route('member.crawleritemsku.index')}}?ci_id='+php_inject.models.crawlerItem.ci_id,
        data: '',
        async: true,
        crossDomain: true,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#modal-left .modal-title').html('SKUs - 列表');
            $('#modal-left .modal-body').html(data.view)
        },
        error: function(data) {
        }
    });

}

</script>
@endsection