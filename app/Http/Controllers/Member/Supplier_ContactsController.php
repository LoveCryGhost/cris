<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\Supplier_ContactRequest;
use App\Services\Member\Supplier_ContactService;
use App\Services\Member\SupplierService;
use Illuminate\Http\Request;



class Supplier_ContactsController extends MemberCoreController
{


    private $supplierService;
    private $supplier_ContactService;

    public function __construct(SupplierService $supplierService, Supplier_ContactService $supplier_ContactService)
    {
        $this->middleware('auth:member');
        $this->supplier_ContactService= $supplier_ContactService;
        $this->supplierService= $supplierService;
    }

    public function create(Request $request)
    {
        $supplier= $this->supplierService->supplierRepo->getById($request->input('s_id'));
        $view = view(config('theme.member.view').'supplier.supplierContact.md-create', compact('supplier'))->render();
        return [
            'errors' => '',
            'models'=> [],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function store(Supplier_ContactRequest $request)
    {
        $data = $request->all();
        $supplierContact =$this->supplier_ContactService->store($data);
        return [
            'errors' => '',
            'models'=> [
                    'supplierContact' => $supplierContact
                ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

//    public function index()
//    {
//        $attributes = $this->attributeService->index();
//        return view(config('theme.member.view').'attribute.index', compact('attributes'));
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
