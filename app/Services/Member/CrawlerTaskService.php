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

//        $url = "https://shopee.tw/api/v2/search_items/?by=sales&fe_categoryids=2164&limit=50&newest=50&order=desc&page_type=search&version=2";
//        $ClientResponse = $this->shopeeHandler->ClientHeader_Shopee($url);
//        $json = json_decode($ClientResponse->getBody(), true);
//
//        foreach ($json['items'] as $item){
//            $item_info[] = [
//                'itemid' => $item['itemid'],
//                'shopid' => $item['shopid'],
//                'name' => $item['name'],
//                'images' => $item['images'][0],
//                'sold' => $item['sold'],
//                'historical_sold' => $item['historical_sold']
//            ];
//        };
        //dd($json['items'][17],$item_info);
    }

    public function index()
    {
        $crawlerTasks = $this->crawlertaskRepo->builder()->with(['member'])->paginate(10);
        return $crawlerTasks;
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
        $url_params = (new ShopeeHandler())->shopee_url($url);

        $data['url_params'] = $url_params;
        $data['local'] = $data['url_params']['local'];
        $data['sort_by'] = $data['url_params']['gets']['sortBy'];
        $data['domain'] = $data['url_params']['domain'];
        $data['cat'] = $data['url_params']['cat'];
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
