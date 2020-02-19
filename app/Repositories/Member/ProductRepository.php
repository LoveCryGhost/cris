<?php

namespace App\Repositories\Member;


use App\Models\Product;

class ProductRepository implements RepositoryInterface
{


    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function builder(){
        return $this->product;
    }



}
