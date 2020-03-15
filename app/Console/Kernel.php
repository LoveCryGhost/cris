<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Str;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        //\App\Console\Commands\TestCron::class,
        \App\Console\Commands\CrawlerFirstTimeUpdateItemCron::class,
        \App\Console\Commands\CrawlerFirstTimeUpdateShopCron::class
    ];

    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('command:test_cron')->everyMinute();
        $schedule->command('command:crawler_first_time_update_item')->everyMinute();
        $schedule->command('command:crawler_first_time_update_shop')->everyMinute();
    }

    protected function commands()
    {
//        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
