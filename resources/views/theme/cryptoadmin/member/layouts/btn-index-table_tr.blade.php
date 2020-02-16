<a class="btn btn-warning btn-sm" href="{{route('member.type.edit', ['type'=> $type->t_id])}}"><i class="fa fa-edit mr-5"></i>編輯</a>
<form action="{{route('member.type.destroy', ['type'=> $type->t_id])}}" method="post"
      style="display: inline-block;"
      onsubmit="return confirm('您确定要删除吗？');">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-secondary btn-sm">
        <i class="fa fa-trash mr-5"></i>刪除
    </button>
</form>