<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;

class CrawlerItemsController extends MemberCoreController
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function index()
    {
        $crawlerTask = CrawlerTask::find(request()->crawlerTask);
        $crawlerItems = CrawlerItem::paginate(5);
        return view(config('theme.member.view').'crawlerItem.index',
            [
                'crawlerTask' => $crawlerTask,
                'crawlerItems' => $crawlerItems,
                'filters' => [
                    'crawlerTask'  => $crawlerTask->ct_id,
                ]
            ]);
    }
}
