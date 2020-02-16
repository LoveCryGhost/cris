<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Services\Member\AttributeService;
use Illuminate\Support\Facades\Route;


class AttributesController extends MemberCoreController
{

    protected $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->middleware('auth:member');
        $this->attributeService = $attributeService;
    }

    //Dashboard
    public function index(){

        $attributes = $this->attributeService->all();
        return view(config('theme.member.view').'attribute.index', compact('attributes'));
    }

    public function edit(Attribute $attribute)
    {
        return view(config('theme.member.view').'attribute.edit', compact('attribute'));
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {

        //取得參數
        $data = $request->all();
        $attribute->update($data);

        return redirect()->route('member.attribute.index')
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
        return view(config('theme.member.view').'attribute.create', compact(''));
    }

    public function store(AttributeRequest $request)
    {
        $data = $request->all();
        Attribute::create($data);
        return redirect()->route('member.attribute.index')
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

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('member.attribute.index')
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
