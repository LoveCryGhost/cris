<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Jobs\SkuPriceJob;
use App\Models\SKU;
use Illuminate\Support\Facades\Auth;


class SKUObserver extends Observer
{

    public function saving(SKU $sku)
    {
        if($sku->is_active == 1 or $sku->is_active ==true){
            $sku->is_active = 1;
        }else{
            $sku->is_active = 0;
        }
        //判別是否為member建立
        if(Auth::guard('member')->user()!=null) {
            $sku->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(SKU $sku)
    {

    }

    public function created(SKU $sku)
    {
        $sku->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.sku'), $sku->sku_id);
        $sku->save();
    }

    public function updating(SKU $sku)
    {
    }

    public function saved(SKU $sku)
    {
//        for($i=1;$i<=10; $i++){
//            dispatch(new SkuPriceJob($sku));
//        }

        //更新Product
        $skus = SKU::where('p_id', $sku->p_id)->get();
        $min = $skus->min('price');
        $max = $skus->max('price');
        $product = $sku->product;
        $product->t_price = $max;
        $product->m_price = $min;
        $product->save();
    }

    public function deleted( SKU $sku)
    {

    }
}


