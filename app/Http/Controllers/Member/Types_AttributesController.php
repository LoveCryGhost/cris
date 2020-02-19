<?php

namespace App\Http\Controllers\Member;

use App\Services\Member\AttributeService;
use Illuminate\Http\Request;


class Types_AttributesController extends MemberCoreController
{

    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->middleware('auth:member');
        $this->attributeService = $attributeService;
    }

    public function create()
    {
        $attributes = $this->attributeService->attributeRepo->builder()->all();
        $view = view(config('theme.member.view').'type.attribute.md-create', compact('attributes'))->render();
        return ['view' => $view];
    }

    public function store(Request $request)
    {
        $attribute = $this->attributeService->attributeRepo->builder()->find($request->input('a_id'));
        return [
            'rows' => $attribute,
            'request' => $request,
            'options' => []
        ];
        //return redirect()->route('member.attribute.index')->with('toast',$toast);
    }

    public function index()
    {
        $attributes = $this->attributeService->index();
        return view(config('theme.member.view').'attribute.index', compact('attributes'));
    }
//
//    public function edit(Attribute $attribute)
//    {
//        return view(config('theme.member.view').'attribute.edit', compact('attribute'));
//    }
//
//    public function update(AttributeRequest $request, Attribute $attribute)
//    {
//        $data = $request->all();
//        $toast = $this->attributeService->update($attribute, $data);
//        return redirect()->route('member.attribute.index')->with('toast', $toast);
//    }
//
//
//    public function destroy(Attribute $attribute)
//    {
//        $toast = $this->attributeService->destroy($attribute);
//        return redirect()->route('member.attribute.index')->with('toast', $toast);
//    }
}
