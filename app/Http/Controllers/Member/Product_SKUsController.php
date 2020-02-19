<?php

namespace App\Http\Controllers\Member;

use App\Repositories\Member\SKURepository;
use App\Services\Member\AttributeService;
use App\Services\Member\ProductService;
use Illuminate\Http\Request;


class Product_SKUsController extends MemberCoreController
{


    public $productService;

    public function __construct(ProductService $productService, SKURepository $skuRepository)
    {
        $this->middleware('auth:member');
        $this->productService= $productService;
        $this->skuRepo = $skuRepository;
    }

    public function create(Request $request)
    {
        $product= $this->productService->productRepo->getById($request->input('p_id'));
        $view = view(config('theme.member.view').'product.sku.md-create', compact('product'))->render();
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
