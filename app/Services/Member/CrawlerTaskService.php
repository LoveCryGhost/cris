<?php

namespace App\Services\Member;

use App\Handlers\ShopeeHandler;
use App\Repositories\Member\AttributeRepository;
use App\Repositories\Member\CrawlerTaskRepository;
use App\Repositories\Member\TypeRepository;

class CrawlerTaskService extends MemberCoreService implements MemberServiceInterface
{

    public $crawlertaskRepo;
    private $shopeeHandler;

    public function __construct(CrawlerTaskRepository $crawlerTaskRepository, ShopeeHandler $shopeeHandler)
    {
        $this->crawlertaskRepo = $crawlerTaskRepository;
        $this->shopeeHandler = $shopeeHandler;
    }

    public function index()
    {
        $crawlerTasks = $this->crawlertaskRepo->builder()->with(['member'])->paginate(10);
        return $crawlerTasks;
    }

    public function create()
    {
    }



    public function edit()
    {

    }

    public function store($data)
    {
        $url = $data['url'];
        $url_params = (new ShopeeHandler())->shopee_url($url);
        $data['url_params'] = $url_params;
        $data['local'] = $data['url_params']['local'];
        $data['domain'] = $data['url_params']['domain'];
        $data['sort_by'] = $data['url_params']['gets']['sortBy'];
        $data['cat'] = $data['url_params']['cat'];
        return $this->crawlertaskRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
        $crawlerTask = $model;
        return $crawlerTask->update($data);
    }

    public function destroy($model, $data)
    {
        $crawlertask = $model;
        return $crawlertask->delete();
    }




}
