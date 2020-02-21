<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Repositories\Member\SupplierGroupRepository;

class SupplierGroupService extends MemberCoreService implements MemberServiceInterface
{
    public $supplierGroupRepo;
    public $attributeRepo;

    public function __construct(SupplierGroupRepository $supplierGroupRepository)
    {
        $this->supplierGroupRepo = $supplierGroupRepository;
    }

    public function index()
    {
        return $this->supplierGroupRepo->builder()->with(['member'])->paginate(10);
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
//        return $this->supplierGroupRepo->builder()->create($data);
    }

    public function update($model, $data)
    {
        $supplierGroup = $model;
        //處理Thumbnail
        $uploader =new ImageUploadHandler();
        if(request()->name_card!="undefined" and !empty(request()->name_card)) {
            $result = $uploader->save(request()->name_card, 'supplier_groups', $supplierGroup->sg_id, 416);
            if ($result) {
                $data['name_card']=$result['path'];
            }
        }else{
            $data['name_card'] = null;
        }


        return $supplierGroup->update($data);
    }

    public function destroy($model)
    {
        $supplierGroup = $model;
        return $supplierGroup->delete();
    }


}
