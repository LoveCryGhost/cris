<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\SupplierRequest;
use App\Models\Supplier;
use App\Services\Member\SupplierService;


class SuppliersController extends MemberCoreController
{

    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->middleware('auth:member');
        $this->supplierService = $supplierService;
    }

//    public function create()
//    {
//        $types = $this->supplierService->supplierRepo->builder()->all();
//        return view(config('theme.member.view').'supplier.create', compact('types'));
//    }

//    public function store(SupplierRequest $request)
//    {
//        $data = $request->all();
//        $toast = $this->supplierService->store($data);
//        return redirect()->route('member.supplier.index')->with('toast', parent::$toast_store);
//
//    }
//
    public function index()
    {
        $suppliers = $this->supplierService->index();
        return view(config('theme.member.view').'supplier.index', compact('suppliers'));
    }

    public function edit(Supplier $supplier)
    {
        $types = $this->supplierService->supplierRepo->builder()->all();
        return view(config('theme.member.view').'supplier.edit', compact('supplier','types'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $data = $request->all();
        $toast = $this->supplierService->update($supplier, $data);
        return redirect()->route('member.supplier.index')->with('toast',  parent::$toast_update);
    }
//
//
//    public function destroy(Supplier $supplier)
//    {
//        $toast = $this->supplierService->destroy($supplier);
//        return redirect()->route('member.supplier.index')->with('toast',  parent::$toast_destroy);
//    }

}
