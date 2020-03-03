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

class CrawlerItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shopeeHandler;

    public function __construct()
    {
        $this->shopeeHandler = new ShopeeHandler();
    }

    //處理的工作
    public function handle()
    {
        $member_id = Auth::guard('member')->check()?  Auth::guard('member')->user()->id: '1';

        $crawler_items = CrawlerItem::whereNull('updated_at')->take(config('crawler.update_item_qty'))->get();

        foreach ($crawler_items as $crawler_item){
            $url = 'https://shopee.tw/api/v2/item/get?itemid='.$crawler_item->itemid.'&shopid='.$crawler_item->shopid;
            $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
            $json = json_decode($ClientResponse->getBody(), true);

            //CrawlerItem
            $row_item[]=[
                'itemid' => $crawler_item->itemid,
                'shopid' => $crawler_item->shopid,
                'name' => $json['item']['name'],
                'sold' => $json['item']['sold'],
                'historical_sold' => $json['item']['historical_sold'],
                'local' => $crawler_item->local,
                'member_id' => $member_id,
                'updated_at'=> now()
            ];
        }

        if(count($crawler_items)>0){
            //Update CrawlerItem
            $crawlerItem = new CrawlerItem();
            $TF = (new MemberCoreRepository())->massUpdate($crawlerItem, $row_item);
            dispatch(new CrawlerItemJob());
        }
    }
}
