<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;


class TypeObserver extends Observer
{

    public function saving(Type $type)
    {
        if(request()->input('is_active') == null){
            $type->is_active = 0;
        }
        //判別是否為admin建立
        if(Auth::guard('member')->user()!=null) {
            $type->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(Type $type)
    {

    }

    public function created(Type $type)
    {
        $type->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.type'), $type->t_id);
        $type->save();
    }

    public function updating(Type $type)
    {
    }

    public function saved(Type $type)
    {

    }

    public function deleted( Type $type)
    {

    }
}


