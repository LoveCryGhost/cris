<?php

namespace App\Jobs;

use App\Handlers\ShopeeHandler;
use App\Models\CrawlerItem;
use App\Models\CrawlerShop;
use App\Repositories\Member\MemberCoreRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CrawlerTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $shopeeHandler;
    private $crawlerTask;

    public function __construct($crawlerTask, $url)
    {
        $this->url = $url;
        $this->crawlerTask = $crawlerTask;
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
            $row_items[] = [
                'itemid' => $item['itemid'],
                'shopid' => $item['shopid'],
                'name' => $item['name'],
                'images' => $item['images'][0],
                'sold' => $item['sold']!==null? $item['sold']: 0,
                'historical_sold' => $item['historical_sold'],
                'local' => $this->crawlerTask->local,
                'member_id' => $member_id,
            ];

            $row_shops[] =  [
                'shopid' => $item['shopid'],
                'shop_location' => "",
                'local' => $this->crawlerTask->local,
                'member_id' => $member_id
            ];
        };

        //批量儲存Item
        $crawlerItem = new CrawlerItem();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerItem, $row_items);

        //批量儲存Shop
        $crawlerShop = new CrawlerShop();
        $TF = (new MemberCoreRepository())->massUpdate($crawlerShop, $row_shops);

//        // CrawlerItem任務排程
//        foreach ($row_items as $item)
//        {
//            $stop=1;
//            for($i=1; $i<=$stop;$i++){
//                $url = 'https://shopee.tw/api/v2/item/get?itemid='.$item['itemid'].'&shopid='.$item['shopid'];
//                dispatch(new CrawlerItemJob($url, $item));
//            }
//            $stop++;
//        }
//

//        //CrawlerShop 任務排程
//        foreach ($row_shops as $shop){
//            $stop=1;
//            for($i=1; $i<=$stop;$i++) {
//                $url = 'https://shopee.tw/api/v2/shop/get?shopid=' . $shop['shopid'];
//                dispatch(new CrawlerShopJob($url, $shop));
//            }
//            $stop++;
//        }
    }
}
