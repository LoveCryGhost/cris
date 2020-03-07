<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use Illuminate\Http\Request;

class CrawlerItemsController extends MemberCoreController
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function index()
    {
        $crawlerTask = CrawlerTask::find(request()->crawlerTask);
        $crawlerItems = CrawlerItem::where('is_active', request()->is_active)->paginate(5);
        return view(config('theme.member.view').'crawlerItem.index',
            [
                'crawlerTask' => $crawlerTask,
                'crawlerItems' => $crawlerItems,
                'filters' => [
                    'crawlerTask'  => $crawlerTask->ct_id,
                    'is_active' => request()->is_active
                ]
            ]);
    }

    public function toggle(Request $request){
        $crawlerItem = CrawlerItem::find($request->ci_id);
        if($crawlerItem->is_active==1){
            $crawlerItem->is_active=0;
        }else{
            $crawlerItem->is_active=1;
        }
        $crawlerItem->save();
    }
}
