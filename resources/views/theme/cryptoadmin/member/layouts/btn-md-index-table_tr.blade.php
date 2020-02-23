@php
    $route_param = str_replace('-','_',str_replace('member.','',$route_name));

    $route_edit = $route_name.'.edit';
    $route_destroy= $route_name.'.destroy';
    //dd($route_param,$route_edit,$route_destroy );
@endphp

{{--<a class="btn btn-warning btn-sm"--}}
   {{--href="{{route($route_edit,--}}
            {{--[$route_param => $m_id])}}">--}}
    {{--<i class="fa fa-edit mr-5"></i>編輯</a>--}}

<a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-md"
   onclick="event.preventDefault();
           md_edit(this, php_inject={{json_encode(['m_id'  => $m_id ])}});">
    <i class="fa fa-edit mr-5"></i>編輯</a>


{{--<form action="{{route($route_destroy, [$route_param=> $m_id])}}" method="post"--}}
      {{--style="display: inline-block;"--}}
      {{--onsubmit="return confirm('您确定要删除吗？');">--}}
    {{--@csrf--}}
    {{--@method('delete')--}}
    {{--<button type="submit" class="btn btn-secondary btn-sm">--}}
        {{--<i class="fa fa-trash mr-5"></i>刪除--}}
    {{--</button>--}}
{{--</form>--}}