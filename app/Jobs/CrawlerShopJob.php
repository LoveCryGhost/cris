<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerShop;
use App\Repositories\Member\MemberCoreRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CrawlerShopJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shopeeHandler;
    private $crawler_shops;

    public function __construct($crawler_shops)
    {
        $this->crawler_shops = $crawler_shops;
        $this->shopeeHandler = new ShopeeHandler();
    }

    //多次請求網址
    public function handle()
    {
        $member_id = Auth::guard('member')->check()?  Auth::guard('member')->user()->id: '1';

        foreach ($this->crawler_shops as $crawler_shop){
            $url = 'https://shopee.tw/api/v2/shop/get?shopid='.$crawler_shop->shopid;
            $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
            $json = json_decode($ClientResponse->getBody(), true);

            $row_shop[]=[
                'shopid' => $crawler_shop->shopid,
                'username' => $json['data']['account']['username'],
                'shop_location' => $json['data']['shop_location'],
                'local' => $crawler_shop->local,
                'member_id' => $member_id,
                'created_at' => now(),
                'updated_at'=>now()
            ];
        }

        //Update CrawlerShop
        $crawlerShop = new CrawlerShop();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerShop, $row_shop);
    }
}
