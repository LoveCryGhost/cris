<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;


class AttributeObserver extends Observer
{

    public function saving(Attribute $attribute)
    {
        if(request()->input('is_active') == null){
            $attribute->is_active = 0;
        }
    }

    public function creating(Attribute $attribute)
    {
        //判別是否為admin建立
        $attribute->member_id = Auth::guard('member')->user()->id;
    }

    public function created(Attribute $attribute)
    {
        $attribute->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.attribute'), $attribute->a_id);
        $attribute->save();
    }

    public function updating(Attribute $attribute)
    {
    }

    public function saved(Attribute $attribute)
    {

    }

    public function deleted( Attribute $attribute)
    {

    }
}

