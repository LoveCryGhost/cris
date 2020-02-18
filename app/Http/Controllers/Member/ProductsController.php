<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\ProductRequest;
use App\Models\Product;
use App\Services\Member\ProductService;


class ProductsController extends MemberCoreController
{

    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:member');
        $this->productService = $productService;
    }

    //Dashboard
    public function index(){
        $products = $this->productService->all();
        return view(config('theme.member.view').'product.index', compact('products'));
    }

    public function edit(Product $product)
    {
        return view(config('theme.member.view').'product.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {

        //取得參數
        $data = $request->all();
        $product->update($data);

        return redirect()->route('member.product.index')
            ->with('toast', [
                "heading" => "更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

    public function create()
    {
        return view(config('theme.member.view').'product.create', compact(''));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        Product::create($data);
        return redirect()->route('member.product.index')
            ->with('toast', [
                "heading" => "新增成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('member.product.index')
            ->with('toast', [
                "heading" => "刪除成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ]);
    }

}
