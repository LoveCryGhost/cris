<?php

namespace App\Observers;

use App\Handlers\BarcodeHandler;
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
        $crawlerTask->id_code = (new BarcodeHandler())->barcode_generation(config('barcode.crawlertask'), $crawlerTask->ct_id);
        $crawlerTask->save();
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


