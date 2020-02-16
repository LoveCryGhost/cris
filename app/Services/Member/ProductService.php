<?php

namespace App\Services\Member;

use App\Repositories\Member\ProductRepository;

class ProductService extends MemberCoreService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function all(){
        return $this->productRepo->all(0);
    }


}
