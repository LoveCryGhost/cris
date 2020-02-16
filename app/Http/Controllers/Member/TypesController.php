<?php

namespace App\Http\Controllers\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Requests\Member\TypeRequest;
use App\Models\Member;
use App\Models\Type;
use App\Rules\CurrentPasswordRule;
use App\Services\Type\TypeService;
use App\Services\User\UserService;
use Illuminate\Http\Request;


class TypesController extends MemberCoreController
{

    protected $typeService;
    public function __construct(TypeService $typeService)
    {
        $this->middleware('auth:member');
        $this->typeService = $typeService;
    }

    //Dashboard
    public function index(){
        $types = $this->typeService->all();
        return view(config('theme.member.view').'type.index', compact('types'));
    }

    public function edit(Type $type)
    {
        return view(config('theme.member.view').'type.edit', compact('type'));
    }

    public function update(TypeRequest $request, Type $type)
    {

        //取得參數
        $data = $request->all();
        $type->update($data);

        return redirect()->route('member.type.index')
            ->with('toast', [
                "heading" => "更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

    public function create()
    {
        return view(config('theme.member.view').'type.create', compact(''));
    }

    public function store(TypeRequest $request)
    {
        $data = $request->all();
        Type::create($data);
        return redirect()->route('member.type.index')
            ->with('toast', [
                "heading" => "新增成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('member.type.index')
            ->with('toast', [
                "heading" => "刪除成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

}
