<?php

namespace App\Services\Member;

use App\Models\Product;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\TypeRepository;

class ProductService extends MemberCoreService implements MemberServiceInterface
{
    protected $productRepo;
    public $typeRepo;

    public function __construct(ProductRepository $productRepository,  TypeRepository $typeRepository)
    {
        $this->productRepo = $productRepository;
        $this->typeRepo = $typeRepository;
    }

    public function index()
    {
        return $this->productRepo->builder()
            ->with(['Type', 'Productthumbnails'])->paginate(10);
    }


    public function store($data)
    {
        $this->productRepo->builder()->create($data);
        return parent::$toast_store;
    }

    public function update($model,$data)
    {
        $product = $model;
        $product->update($data);
        return parent::$toast_update;
    }

    public function destroy($model)
    {
        $product = $model;
        $product->delete();
        return parent::$toast_destroy;
    }


}
