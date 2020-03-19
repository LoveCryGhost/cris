<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerItemJob;
use Illuminate\Console\Command;

class CrawlerFirstTimeUpdateItemCron extends Command
{

    protected $signature = 'command:crawler_first_time_update_item';


    protected $description = 'Command crawler_first_time_update_item';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerItemJob())->onQueue('low'));
    }
}
