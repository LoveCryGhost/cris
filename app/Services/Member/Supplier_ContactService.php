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

    private $supplierContactRepo;

    public function __construct(SupplierContactRepository $supplierContactRepository)
    {
        $this->supplierContactRepo = $supplierContactRepository;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {

        //儲存name_card
        //$data = $this->save_name_card($data);

        //儲存一般資料
        $supplierContact =$this->supplierContactRepo->builder()->create($data);

        return $supplierContact;

    }

    public function save_name_card($data){
        //處理Thumbnail
        $uploader =new ImageUploadHandler();
        if(request()->name_card!="undefined" and request()->name_card) {
            $result = $uploader->save(request()->thumbnail, 'supplier_contacts', '', 416);
            if ($result) {
                $data['name_card']=$result['path'];
            }
        }else{
            $data['name_card'] = null;
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
