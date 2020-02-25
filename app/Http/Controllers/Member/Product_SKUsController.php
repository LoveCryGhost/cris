<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\Product_SKURequest;
use App\Repositories\Member\SKURepository;
use App\Services\Member\AttributeService;
use App\Services\Member\Product_SKUService;
use App\Services\Member\ProductService;
use Illuminate\Http\Request;



class Product_SKUsController extends MemberCoreController
{


    public $product_SKUService;

    public function __construct(Product_SKUService $product_SKUService)
    {
        $this->middleware('auth:member');
        $this->product_SKUService= $product_SKUService;
    }

    public function create(Request $request)
    {
        $product= $this->product_SKUService->productRepo->getById($request->input('p_id'));
        $view = view(config('theme.member.view').'product.sku.md-create', compact('product'))->render();
        return ['view' => $view];
    }

    public function store(Product_SKURequest $request)
    {
        $data = $request->all();
        $sku =$this->product_SKUService->store($data);

        $sku = $this->product_SKUService->skuRepo->getById($sku->sku_id);
        return response()->json([
            'rows' => $sku,
            'request' => $request->input()
        ], 200);
    }

    public function edit(Request $request)
    {

        $sku = $this->product_SKUService->skuRepo->getById($request->input('m_id'));
        $product = $this->product_SKUService->productRepo->getById($sku->p_id);

        $view = view(config('theme.member.view').'product.sku.md-edit', compact('sku', 'product'))->render();
        return ['view' => $view];
    }



    public function update(Request $request)
    {
        $data = $request->all();
        $sku = $this->product_SKUService->skuRepo->getById($data['sku_id']);
        $TF = $this->product_SKUService->update($sku, $data);
        $sku = $this->product_SKUService->skuRepo->getById($data['sku_id']);
        return [
            'rows' => $sku,
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
