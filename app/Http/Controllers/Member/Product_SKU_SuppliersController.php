<?php

namespace App\Http\Controllers\Member;

use App\Models\Supplier;
use App\Services\Member\Product_SKU_SupplierService;
use Illuminate\Http\Request;

class Product_SKU_SuppliersController extends MemberCoreController
{


    public $product_SKU_SupplierService;

    public function __construct(Product_SKU_SupplierService $product_SKU_SupplierService)
    {
        $this->middleware('auth:member');
        $this->product_SKU_SupplierService= $product_SKU_SupplierService;

    }


    public function index(Request $request)
    {
        $data = $request->all();
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $suppliers = $this->product_SKU_SupplierService->supplierRepo->builder()->get();
        $view = view(config('theme.member.view').'product.productSku.productSkuSupplier.md-index',compact('data', 'sku', 'suppliers'))->render();
        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
            ],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

//    public function create(Request $request)
//    {
//        $product= $this->product_SKUService->productRepo->getById($request->input('p_id'));
//        $view = view(config('theme.member.view').'product.sku.md-create', compact('product'))->render();
//        return ['view' => $view];
//    }
//
//    public function store(Product_SKURequest $request)
//    {
//        $data = $request->all();
//        $sku =$this->product_SKUService->store($data);
//
//        $sku = $this->product_SKUService->skuRepo->getById($sku->sku_id);
//        return response()->json([
//            'rows' => $sku,
//            'request' => $request->input()
//        ], 200);
//    }


    public function edit(Request $request, Supplier $product_sku_supplier)
    {
        $data = $request->all();
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $skuSupplier = $product_sku_supplier;
        $suppliers = $this->product_SKU_SupplierService->supplierRepo->builder()->get();

        $view = view(config('theme.member.view').'product.productSku.productSkuSupplier.md-edit',compact('sku', 'skuSupplier', 'suppliers'))->render();


        return [
            'errors' => '',
            'models'=> [
                'sku' => $sku,
                'skuSupplier' => $skuSupplier,
                'suppliers' => $suppliers
            ],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }



    public function update(Request $request)
    {

        $data = $request->all();
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        $TF = $this->product_SKU_SupplierService->update($sku, $data);
        $sku = $this->product_SKU_SupplierService->skuRepo->getById($data['sku_id']);
        return [
            'models' => [
                'sku' => $sku,
            ],
            'request' => $request->all(),
            'options' => []
        ];
    }

//
//    public function destroy(Attribute $attribute)
//    {
//        $toast = $this->attributeService->destroy($attribute);
//        return redirect()->route('member.attribute.index')->with('toast', $toast);
//    }
}
