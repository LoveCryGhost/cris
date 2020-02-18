<?php

namespace App\Services\Member;

use App\Models\Product;
use App\Repositories\Member\ProductRepository;

class ProductService extends MemberCoreService implements MemberServiceInterface
{
    protected $productRepo;
    private $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        return $builder = $this->productRepo->builder()
            ->with(['Type', 'Productthumbnails'])->paginate(10);
    }


    public function create()
    {

    }

    public function edit($model)
    {

    }

    public function store($data)
    {
        Product::create($data);
        return $toast = [
                    "heading" => "新增成功",
                    "text" =>  '',
                    "position" => "top-right",
                    "loaderBg" => "#ff6849",
                    "icon" => "success",
                    "hideAfter" => 3000,
                    "stack" => 6
                ];
    }

    public function update($model,$data)
    {
        $product = $model;
        $product->update($data);
        return $toast = [
                "heading" => "更新成功",
                "text" =>  '',
                "position" => "top-right",
                "loaderBg" => "#ff6849",
                "icon" => "success",
                "hideAfter" => 3000,
                "stack" => 6
            ];
    }

    public function destroy($model)
    {
        $product = $model;
        $product->delete();
        return $toas =  [
            "heading" => "刪除成功",
            "text" =>  '',
            "position" => "top-right",
            "loaderBg" => "#ff6849",
            "icon" => "success",
            "hideAfter" => 3000,
            "stack" => 6
        ];
    }


}
