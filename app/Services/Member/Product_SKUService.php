<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Models\SKUAttribute;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;

class Product_SKUService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;
    public $skuRepo;

    public function __construct(ProductRepository $productRepository, SKURepository $skuRepository)
    {
        $this->productRepo = $productRepository;
        $this->skuRepo = $skuRepository;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        //處理Thumbnail
        $uploader =new ImageUploadHandler();
        if(request()->thumbnail!="undefined") {
            $result = $uploader->save(request()->thumbnail, 'sku_thumbnails', $data['p_id'], 416);
            if ($result) {
                $data['thumbnail']=$result['path'];
            }
        }else{
            $data['thumbnail'] = null;
        }

        //儲存一般資料
        $sku= $this->skuRepo->create($data);

        //處理SkuAttributes

        foreach ($data['sku_attributes'] as $attribute_id => $attribute_value){
            $skuAttribute = new SKUAttribute();
            $skuAttribute->a_id = $attribute_id;
            $skuAttribute->a_value = $attribute_value;
            $skuAttribute->sku_id =$sku->sku_id;
            $skuAttribute->save();
        }
        return $data;
    }

    public function update($model, $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($model)
    {
        // TODO: Implement destroy() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }
}
