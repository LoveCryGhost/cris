<?php

namespace App\Repositories\Type;


use App\Models\Type;

class TypeRepository implements TypeRepositoryInterface
{


//  取出Type數量
    public function all($row_qty)
    {
        if($row_qty==0){
            $types = Type::paginate(10);
        }else{
            $types = Type::paginate($row_qty);
        }
        return $types;
    }


}
