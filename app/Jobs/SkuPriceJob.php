<?php

namespace App\Jobs;

use App\Models\SKU;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SkuPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $sku;

    public function __construct(SKU $sku)
    {
        $this->sku = $sku;
    }

    //處理的工作
    public function handle()
    {
        sleep(30);
        //更新Product
        $skus = SKU::where('p_id',  $this->sku->p_id)->get();
        $min = $skus->min('price');
        $max = $skus->max('price');
        $product = $this->sku->product;
        $product->m_price = date('i');
        $product->t_price = date('s');
        $product->save();
    }
}
