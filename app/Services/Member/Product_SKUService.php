<?php

namespace App\Services\Member;

use App\Models\Product;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\TypeRepository;

class Product_SKUService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;
    public $skuRepo;

    public function __construct(ProductRepository $productRepository, SKURepository $skuRepository)
    {
        $this->productRepo = $productRepository;
        $this->skuRepo = $skuRepository;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        //儲存一般資料
        $sku= $this->skuRepo->create($data);

        //儲存SKU資料
//        foreach ($data['skus'] as $sku_datta){
//            $p[]=[];
//        }
//        $sku->product->syn($p);

    }

    public function update($model, $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($model)
    {
        // TODO: Implement destroy() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }
}
