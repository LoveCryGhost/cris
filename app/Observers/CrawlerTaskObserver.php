<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
use App\Jobs\CrawlerTaskJob;
use App\Models\CrawlerTask;
use Illuminate\Support\Facades\Auth;


class CrawlerTaskObserver extends Observer
{

    public function saving(CrawlerTask $crawlertask)
    {
        if(request()->is_active == 1 or request()->is_active == true){
            $crawlertask->is_active = 1;
        }else{
            $crawlertask->is_active = 0;
        }
        //判別是否為admin建立
        if(Auth::guard('member')->user()!=null) {
            $crawlertask->member_id = Auth::guard('member')->user()->id;
        }
    }

    public function creating(CrawlerTask $crawlertask)
    {

    }

    public function created(CrawlerTask $crawlertask)
    {
        // $url = 'https://shopee.com.my/api/v2/search_items/?by=sales&limit=50&match_id=16&newest=50&order=desc&page_type=search&version=2';
        $crawlertask->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.crawlertask'), $crawlertask->ct_id);
        $crawlertask->save();

        //爬蟲
        $item_qty = $crawlertask->pages*50;
        $insert_item_qty = config('crawler.insert_item_qty');

        $index = ceil($item_qty/$insert_item_qty);
        for ($i=0; $i<=$index-1; $i++){
            $urls[] = 'https://'.$crawlertask->domain.'/api/v2/search_items/?by='.$crawlertask->sort_by.
                        '&limit='.$insert_item_qty.'&match_id='.$crawlertask->cat.'&newest='.($i*$insert_item_qty).'&order=desc&page_type=search&version=2';
        }

        foreach ($urls as $url){
            dispatch(new CrawlerTaskJob($crawlertask, $url));
        }
    }

    public function updating(CrawlerTask $crawlertask)
    {
    }

    public function saved(CrawlerTask $crawlertask)
    {

    }

    public function deleted( CrawlerTask $crawlertask)
    {

    }
}


