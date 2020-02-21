<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Repositories\Member\SupplierRepository;

class SupplierService extends MemberCoreService implements MemberServiceInterface
{
    public $supplierRepo;
    public $attributeRepo;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepo = $supplierRepository;
    }

    public function index()
    {
        return $this->supplierRepo->builder()->with(['member'])->paginate(10);
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
        $data = $this->save_name_card($data);
        return $this->supplierRepo->builder()->create($data);
    }

    public function update($model, $data)
    {
        $supplier = $model;
        //處理name_card
        $data = $this->save_name_card($data);
        return $supplier->update($data);
    }

    public function save_name_card($data)
    {
        $uploader =new ImageUploadHandler();
        if(request()->name_card and request()->name_card!="undefined") {
            $result = $uploader->save(request()->name_card, 'suppliers', '', 416);
            if ($result) {
                $data['name_card']=$result['path'];
            }
        }else{
            unset($data['name_card']);
        }
        return $data;
    }
    public function destroy($model)
    {
        $supplier = $model;
        return $supplier->delete();
    }


}
