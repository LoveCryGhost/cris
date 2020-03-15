<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CrawlerCleanCron extends Command
{

    protected $signature = 'command:crawler_clean';

    protected $description = 'Command crawler_clean';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //清除CrawlerItem
        $statement = 'delete from crawler_items where ci_id Not in (select ci_id from ctasks_items)';
        DB::statement($statement);

        //清除CrawlerShop
        $statement = 'delete from crawler_shops where crawler_shops.shopid Not in (select crawler_items.shopid from crawler_items)';
        DB::statement($statement);

        //刪除SKU

        //山除SKU Detail
//        $name= 'a'.random_int(1000, 9999999);
//        $email = $name.'@app.comTestCorn';
//        User::create([
//            'name' => $name,
//            'email' => $email,
//            'email_verified_at' => now(),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//            'remember_token' => Str::random(10),
//            'avatar' => '',
//            'birthday' => null,
//            'introduction' => 'aaa',
//        ]);

    }
}
