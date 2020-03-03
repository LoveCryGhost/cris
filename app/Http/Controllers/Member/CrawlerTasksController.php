<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;

class CrawlerTasksController extends MemberCoreController
{

    protected $crawlerTaskService;

    public function __construct(CrawlerTaskService $crawlerTaskService)
    {
        $this->middleware('auth:member');
        $this->crawlerTaskService = $crawlerTaskService;

//        $this->crawlerTask = CrawlerTask::find(1);
//        $crawlerItem_ids = CrawlerItem::whereNull('created_at')->pluck('ci_id');
//
//        $this->crawlerTask->crawlerItems()->sync($crawlerItem_ids);
//        $crawlerItem = new CrawlerItem();
//        $crawlerItem->timestamps = false;
//        $crawlerItem->whereIn('ci_id',$crawlerItem_ids)->update(['created_at' => now()]);
    }

    public function create()
    {
        return view(config('theme.member.view').'crawlerTask.create', compact(''));
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

//    public function update(TypeRequest $request, Type $type)
//    {
//        $data = $request->all();
//        $TF = $this->typeService->update($type, $data);
//
//        $a_ids = array_values($data['a_ids']);
//        $this->typeService->attributeRepo->save($type, $a_ids);
//        return redirect()->route('member.type.index')->with('toast', parent::$toast_update);
//    }
//
//
//    public function destroy(Request $request, Type $type)
//    {
//        $data = $request->all();
//        $toast = $this->typeService->destroy($type, $data);
//        return redirect()->route('member.type.index')->with('toast', parent::$toast_destroy);
//    }

}
