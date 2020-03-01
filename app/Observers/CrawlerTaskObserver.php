<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Jobs\CrawlerShopeeItemJob;
use App\Models\CrawlerTask;
use Illuminate\Support\Facades\Auth;


class CrawlerTaskObserver extends Observer
{

    public function saving(CrawlerTask $crawlerTask)
    {
        if($crawlerTask->is_active == 1 or $crawlerTask->is_active ==true){
            $crawlerTask->is_active = 1;
        }else{
            $crawlerTask->is_active = 0;
        }
        //判別是否為admin建立
        if(Auth::guard('member')->user()!=null) {
            $crawlerTask->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(CrawlerTask $crawlerTask)
    {

    }

    public function created(CrawlerTask $crawlerTask)
    {
        // $url = 'https://shopee.com.my/api/v2/search_items/?by=sales&limit=50&match_id=16&newest=50&order=desc&page_type=search&version=2';
        $crawlerTask->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.crawlertask'), $crawlerTask->ct_id);
        $crawlerTask->save();

        //爬蟲
        $items = $crawlerTask->pages*50;
        $qty = 100;
        $index = ceil($items/$qty);
        for ($i=0; $i<=$index-1; $i++){
            $urls[] = 'https://'.$crawlerTask->domain.'/api/v2/search_items/?by='.$crawlerTask->sort_by.
                        '&limit='.$qty.'&match_id='.$crawlerTask->cat.'&newest='.($i*10).'&order=desc&page_type=search&version=2';
        }

        foreach ($urls as $url){
            dispatch(new CrawlerShopeeItemJob($url));
        }
    }

    public function updating(CrawlerTask $crawlerTask)
    {
    }

    public function saved(CrawlerTask $crawlerTask)
    {

    }

    public function deleted( CrawlerTask $crawlerTask)
    {

    }
}


