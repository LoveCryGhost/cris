<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerShopJob;
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
        dispatch(new CrawlerShopJob());
    }
}
