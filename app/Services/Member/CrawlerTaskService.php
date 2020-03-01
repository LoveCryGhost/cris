<?php

namespace App\Services\Member;

use App\Handlers\UrlHandler;
use App\Repositories\Member\AttributeRepository;
use App\Repositories\Member\CrawlerTaskRepository;
use App\Repositories\Member\TypeRepository;

class CrawlerTaskService extends MemberCoreService implements MemberServiceInterface
{

    public $crawlertaskRepo;

    public function __construct(CrawlerTaskRepository $crawlerTaskRepository)
    {
        $this->crawlertaskRepo = $crawlerTaskRepository;
    }

    public function index()
    {
//        return $this->typeRepo->builder()->with(['member'])->paginate(10);
    }

    public function create()
    {
//        return $this->get();
    }



    public function edit()
    {

    }

    public function store($data)
    {

        $url = $data['url'];
        $url_params = (new UrlHandler())->shopee_url($url);
        $data['url_params'] = $url_params;
        $data['local'] = $data['url_params']['local'];
        $data['sortBy'] = $data['url_params']['gets']['sortBy'];
        $data['website'] = $data['url_params']['shopee'];
        return $this->crawlertaskRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
//        $type = $model;
//        return $type->update($data);
    }

    public function destroy($model, $data)
    {
//        $type = $model;
//        return $type->delete();
    }


}
