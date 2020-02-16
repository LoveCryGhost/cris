<?php

namespace App\Repositories\Member;


use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{


//  取出Product數量
    public function all($row_qty)
    {
        if($row_qty==0){
            $types = Product::paginate(10);
        }else{
            $types = Product::paginate($row_qty);
        }
        return $types;
    }


}
