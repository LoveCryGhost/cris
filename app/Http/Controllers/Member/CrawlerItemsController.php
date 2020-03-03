<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;

class CrawlerItemsController extends MemberCoreController
{

    public function index(){
        $crawlerItems = CrawlerItem::paginate(10);
        return view(config('theme.member.view').'crawlerItem.index', compact('crawlerItems'));
    }

}
