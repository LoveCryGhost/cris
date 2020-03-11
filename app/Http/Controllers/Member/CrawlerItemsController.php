<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Illuminate\Http\Request;

class CrawlerItemsController extends MemberCoreController
{
    /**
     * @var CrawlerItemService
     */
    private $crawlerService;

    public function __construct(CrawlerItemService $crawlerItemService)
    {
        $this->middleware('auth:member');
        $this->crawlerService = $crawlerItemService;
    }

    public function index()
    {
        $crawlerTask = $this->crawlerService->crawlerTaskRepo->getById(request()->crawlerTask);
        $crawlerItems = $this->crawlerService->crawlerItemRepo->builder()->where('is_active', request()->is_active)->paginate(5);
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
        $crawlerItem = $this->crawlerService->crawlerItemRepo->getById($request->ci_id);
        if($crawlerItem->is_active==1){
            $crawlerItem->is_active=0;
        }else{
            $crawlerItem->is_active=1;
        }
        $crawlerItem->save();
    }
}
