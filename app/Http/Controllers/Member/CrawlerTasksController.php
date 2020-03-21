<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Models\CrawlerItem;
use App\Models\CrawlerItemSKU;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerTaskService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function destroy(Request $request, CrawlerTask $crawlertask)
    {
        $data = $request->all();
        $toast = $this->crawlerTaskService->destroy($crawlertask, $data);
        return redirect()->route('member.crawlertask.index')->with('toast', parent::$toast_destroy);
    }

    public function refresh()
    {
        //CrawlerTask
        DB::table('crawler_tasks')->update(array('updated_at' => null));

        //CrawlerItem
        DB::table('crawler_items')->update(array('updated_at' => null));

        return redirect()->route('member.crawlertask.index');
    }
}
