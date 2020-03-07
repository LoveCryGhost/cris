

<div class="infinite-scroll">
    @foreach($crawlerItems as $crawlerItem)
        <h4 class="media-heading">[{{ $crawlerItem->ci_id}}] -- {{ $crawlerItem->name }}
            <small>{{ $crawlerItem->created_at->diffForHumans() }}</small>
        </h4>
        <hr>
    @endforeach

    {{ $crawlerItems->links() }}
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>