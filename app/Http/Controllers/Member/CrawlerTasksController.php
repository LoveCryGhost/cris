<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\CrawlerTaskRequest;
use App\Http\Requests\Member\TypeRequest;
use App\Models\Type;
use App\Services\Member\CrawlerTaskService;
use App\Services\Member\TypeService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
        return view(config('theme.member.view').'crawlerTask.create', compact(''));
    }

    public function store(CrawlerTaskRequest $request)
    {
        $data = $request->all();
        $crawlerTask = $this->crawlerTaskService->store($data);
        dd($crawlerTask);
        return redirect()->route('member.rawlertask.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {

        //國內或是國外商品
        $url = $Shopee['fe_category'];
        $ClientResponse = $this->ClientHeader($url);
        $json = json_decode($ClientResponse->getBody(), true);
        return $Rows = $json['data']['category_list'];


//        $types = $this->typeService->index();
//        return view(config('theme.member.view').'type.index', compact('types'));
    }
//
//    public function edit(Type $type)
//    {
//        $attributes = $this->typeService->attributeRepo->builder()->all();
//        return view(config('theme.member.view').'type.edit', compact('type', 'attributes'));
//    }
//
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
