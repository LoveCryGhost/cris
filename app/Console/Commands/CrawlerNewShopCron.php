<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerShopJob;
use App\Models\CrawlerShop;
use Illuminate\Console\Command;

class CrawlerNewShopCron extends Command
{

    protected $signature = 'command:crawler_shop';


    protected $description = 'Command crawler_shop';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        //找沒有created_at 的 CrawlerShop
        CrawlerShop::whereNull('created_at')->chunk(config('crawler.update_shop_qty'), function ($crawler_shops) {
            dispatch(new CrawlerShopJob($crawler_shops));
        });
    }
}
