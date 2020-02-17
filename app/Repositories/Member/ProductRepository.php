<?php

namespace App\Repositories\Member;


use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{


    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

//  取出Product數量
    public function all($row_qty)
    {
        $builder = $this->productModel->with('productThumbnails', 'skus');
        if($row_qty==0){
            $types = $builder->paginate(10);
        }else{
            $types = $builder->paginate($row_qty);
        }
        return $types;
    }


}
