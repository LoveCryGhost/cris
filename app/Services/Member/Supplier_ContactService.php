<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Models\Product;
use App\Models\SupplierContact;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\SupplierContactRepository;
use App\Repositories\Member\TypeRepository;

class Supplier_ContactService extends MemberCoreService implements MemberServiceInterface
{

    public function __construct(SupplierContactRepository $supplierContactRepository)
    {
        $this->supplierContactRepository = $supplierContactRepository;
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

        return $data;

        //儲存SKU資料
//        foreach ($data['skus'] as $sku_datta){
//            $p[]=[];
//        }
//        $sku->product->syn($p);

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
