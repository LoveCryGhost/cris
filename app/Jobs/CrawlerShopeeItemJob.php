<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Repositories\Member\MemberCoreRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

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

        $member_id = Auth::guard('member')->check()?  Auth::guard('member')->user()->id: '1';
        foreach ($json['items'] as $item){
            $rows[] = [
                'itemid' => $item['itemid'],
                'shopid' => $item['shopid'],
                'name' => $item['name'],
                'images' => $item['images'][0],
                'sold' => $item['sold']!==null? $item['sold']: 0,
                'historical_sold' => $item['historical_sold'],
                'member_id' => $member_id
            ];
        };

        $crawlerTask = new CrawlerItem();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerTask, $rows);
    }
}
