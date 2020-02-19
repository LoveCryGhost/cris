<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\TypeRequest;
use App\Models\Type;
use App\Services\Member\TypeService;


class TypesController extends MemberCoreController
{

    protected $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->middleware('auth:member');
        $this->typeService = $typeService;
    }

    public function create()
    {
        return view(config('theme.member.view').'type.create', compact(''));
    }

    public function store(TypeRequest $request)
    {
        $data = $request->all();
        $toast = $this->typeService->store($data);
        return redirect()->route('member.type.index')->with('toast',$toast);

    }

    public function index()
    {
        $types = $this->typeService->index();
        return view(config('theme.member.view').'type.index', compact('types'));
    }

    public function edit(Type $type)
    {
        return view(config('theme.member.view').'type.edit', compact('type'));
    }

    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $toast = $this->typeService->update($type, $data);
        return redirect()->route('member.type.index')->with('toast', $toast);
    }


    public function destroy(Type $type)
    {
        $toast = $this->typeService->destroy($type);
        return redirect()->route('member.type.index')->with('toast', $toast);
    }


}
