<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\SupplierGroupRequest;
use App\Models\SupplierGroup;
use App\Services\Member\SupplierGroupService;


class SuppliersController extends MemberCoreController
{

//    protected $productService;

//    public function __construct(SupplierGroupService $productService)
//    {
//        $this->middleware('auth:member');
//        $this->productService = $productService;
//    }
//
//    public function create()
//    {
//        $types = $this->productService->typeRepo->builder()->all();
//        return view(config('theme.member.view').'product.create', compact('types'));
//    }
//
//    public function store(SupplierGroupRequest $request)
//    {
//        $data = $request->all();
//        $toast = $this->productService->store($data);
//        return redirect()->route('member.product.index')->with('toast', parent::$toast_store);
//
//    }
//
//    public function index()
//    {
//        $products = $this->productService->index();
//        return view(config('theme.member.view').'product.index', compact('products'));
//    }
//
//    public function edit(SupplierGroup $product)
//    {
//        $types = $this->productService->typeRepo->builder()->all();
//        return view(config('theme.member.view').'product.edit', compact('product','types'));
//    }
//
//    public function update(SupplierGroupRequest $request, SupplierGroup $product)
//    {
//        $data = $request->all();
//        $toast = $this->productService->update($product, $data);
//        return redirect()->route('member.product.index')->with('toast',  parent::$toast_update);
//    }
//
//
//    public function destroy(SupplierGroup $product)
//    {
//        $toast = $this->productService->destroy($product);
//        return redirect()->route('member.product.index')->with('toast',  parent::$toast_destroy);
//    }

}
