<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerItem;
use App\Models\CrawlerItemSKU;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;
use Carbon\Carbon;

class CrawlerTasksController extends MemberCoreController
{

    protected $crawlerTaskService;

    public function __construct(CrawlerTaskService $crawlerTaskService)
    {
        $this->middleware('auth:member');
        $this->crawlerTaskService = $crawlerTaskService;
    }

    public function create()
    {
        return view(config('theme.member.view').'crawlerTask.create');
    }

    public function store(CrawlerTaskRequest $request)
    {
        $data = $request->all();
        $crawlerTask = $this->crawlerTaskService->store($data);
        return redirect()->route('member.crawlertask.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {
        $crawlerTasks = $this->crawlerTaskService->index();
        return view(config('theme.member.view').'crawlerTask.index', compact('crawlerTasks'));
    }

    public function edit(CrawlerTask $crawlertask)
    {
        return view(config('theme.member.view').'crawlerTask.edit', compact('crawlertask'));
    }

    public function update(CrawlerTaskRequest $request, CrawlerTask $crawlertask)
    {
        $data = $request->all();
        $TF = $this->crawlerTaskService->update($crawlertask,$data);

        return redirect()->route('member.crawlertask.index')->with('toast', parent::$toast_update);
    }

//    public function destroy(Request $request, Type $type)
//    {
//        $data = $request->all();
//        $toast = $this->typeService->destroy($type, $data);
//        return redirect()->route('member.type.index')->with('toast', parent::$toast_destroy);
//    }

}
