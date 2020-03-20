<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerShopJob;
use Illuminate\Console\Command;

class CrawlerFirstTimeUpdateShopCron extends Command
{

    protected $signature = 'command:crawler_first_time_update_shop';


    protected $description = 'Command crawler_first_time_update_shop';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerShopJob())->onQueue('low'));
    }
}
