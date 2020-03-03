<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerItemJob;
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
        dispatch(new CrawlerItemJob());
    }
}
