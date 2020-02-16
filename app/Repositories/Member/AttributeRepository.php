<?php

namespace App\Repositories\Member;


use App\Models\Attribute;

class AttributeRepository implements AttributeRepositoryInterface
{


//  取出Attribute數量
    public function all($row_qty)
    {
        if($row_qty==0){
            $types = Attribute::paginate(10);
        }else{
            $types = Attribute::paginate($row_qty);
        }
        return $types;
    }


}
