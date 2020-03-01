<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CrawlerShopeeItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $shopeeHandler;

    public function __construct($url)
    {
        $this->url = $url;
        $this->shopeeHandler = new ShopeeHandler();
    }

    //處理的工作
    public function handle()
    {
        $url = $this->url;
        $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
        $json = json_decode($ClientResponse->getBody(), true);

        foreach ($json['items'] as $item){
            $item_info[] = [
                'itemid' => $item['itemid'],
                'shopid' => $item['shopid'],
                'name' => $item['name'],
                'images' => $item['images'][0],
                'sold' => $item['sold'],
                'historical_sold' => $item['historical_sold']
            ];
        };
        //dd($json['items'][17],$item_info);
    }
}
