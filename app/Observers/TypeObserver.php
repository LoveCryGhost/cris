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
    }

    public function creating(Type $type)
    {
        //判別是否為admin建立
        $type->admin_id = Auth::guard('admin')->user()->id;
    }

    public function created(Type $type)
    {
        $type->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.type'), $type->id);
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


