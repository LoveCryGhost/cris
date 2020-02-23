<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
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
        $view = view(config('theme.member.view').'type.attribute.md-create_edit', compact('attributes'))->render();
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

    public function edit(Request $request)
    {

        $attribute = $this->attributeService->attributeRepo->getById($request->input('m_id'));
        $attributes = $this->attributeService->attributeRepo->builder()->all();
        $view = view(config('theme.member.view').'type.attribute.md-edit', compact('attributes','attribute'))->render();
        return ['view' => $view];
    }

    public function update(Request $request)
    {
        $attribute = $this->attributeService->attributeRepo->builder()->find($request->input('a_id'));
        return [
            'rows' => $attribute,
            'request' => $request,
            'options' => []
        ];
    }
//
//
//    public function destroy(Attribute $attribute)
//    {
//        $toast = $this->attributeService->destroy($attribute);
//        return redirect()->route('member.attribute.index')->with('toast', $toast);
//    }
}
