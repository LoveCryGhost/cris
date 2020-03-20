<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\AddUsersCron::class,
        \App\Console\Commands\CrawlerCleanCron::class,
        \App\Console\Commands\CrawlerFirstTimeUpdateItemCron::class,
        \App\Console\Commands\CrawlerFirstTimeUpdateShopCron::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:add_users')->everyMinute();
        $schedule->command('command:crawler_first_time_update_item')->everyMinute();
        $schedule->command('command:crawler_first_time_update_shop')->everyMinute();
        $schedule->command('command:crawler_clean')->everyThirtyMinutes();
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
