<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerItemJob;
use App\Models\CrawlerItem;
use Illuminate\Console\Command;

class CrawlerNewItemCron extends Command
{

    protected $signature = 'command:crawler_item';


    protected $description = 'Command crawler_item';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        //找沒有created_at 的 CrawlerShop
        CrawlerItem::whereNull('created_at')->chunk(config('crawler.update_item_qty'), function ($crawler_items) {
            dispatch(new CrawlerItemJob($crawler_items));
        });
    }
}
