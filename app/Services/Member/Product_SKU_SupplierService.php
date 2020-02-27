<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Models\SKUAttribute;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\SupplierRepository;

class Product_SKU_SupplierService extends MemberCoreService implements MemberServiceInterface
{
    public $productRepo;
    public $typeRepo;
    public $skuRepo;
    public $supplierRepo;

    public function __construct(SKURepository $skuRepository, SupplierRepository $supplierRepository)
    {
        $this->skuRepo = $skuRepository;
        $this->supplierRepo = $supplierRepository;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
//        $data = $this->save_thumbnail($data);
//
//        //儲存一般資料
//        $sku= $this->skuRepo->create($data);
//
//        //處理SkuAttributes
//        foreach ($data['sku_attributes'] as $attribute_id => $attribute_value){
//            $skuAttribute = new SKUAttribute();
//            $skuAttribute->a_id = $attribute_id;
//            $skuAttribute->a_value = $attribute_value;
//            $skuAttribute->sku_id =$sku->sku_id;
//            $skuAttribute->save();
//        }
//        return $sku;
    }

    public function update($model, $data)
    {
        $sku= $model;
        return $TF = $sku->skuSuppliers()->syncWithoutDetaching([
            $data['ss_id'] => [
                                    'sku_id' => $data['sku_id'],
                                    's_id' => $data['s_id'],
                                    'price' => $data['price'],
                                    'url' => $data['url']
                                ]
        ]);
    }

    public function destroy($model, $data)
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

    public function save_thumbnail($data){
//        //處理Thumbnail
//        $uploader =new ImageUploadHandler();
//        if(request()->thumbnail!="undefined" and request()->thumbnail) {
//            $result = $uploader->save(request()->thumbnail, 'sku_thumbnails', '', 416);
//            if ($result) {
//                $data['thumbnail']=$result['path'];
//            }
//        }else{
//            unset($data['thumbnail']);
//        }
//
//        return $data;
    }
}
