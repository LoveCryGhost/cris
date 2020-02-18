<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Services\Member\AttributeService;


class AttributesController extends MemberCoreController
{

    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->middleware('auth:member');
        $this->attributeService = $attributeService;
    }

    public function create()
    {
        return view(config('theme.member.view').'attribute.create', compact(''));
    }

    public function store(AttributeRequest $request)
    {
        $data = $request->all();
        $toast = $this->attributeService->store($data);
        return redirect()->route('member.attribute.index')->with('toast',$toast);

    }

    public function index()
    {
        $attributes = $this->attributeService->index();
        return view(config('theme.member.view').'attribute.index', compact('attributes'));
    }

    public function edit(Attribute $attribute)
    {
        return view(config('theme.member.view').'attribute.edit', compact('attribute'));
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $data = $request->all();
        $toast = $this->attributeService->update($attribute, $data);
        return redirect()->route('member.attribute.index')->with('toast', $toast);
    }


    public function destroy(Attribute $attribute)
    {
        $toast = $this->attributeService->destroy($attribute);
        return redirect()->route('member.attribute.index')->with('toast', $toast);
    }
}
