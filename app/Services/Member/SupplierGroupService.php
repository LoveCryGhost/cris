<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;
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
        return $supplierGroup->update($data);
    }

    public function destroy($model)
    {
//        $supplierGroup = $model;
//        return $supplierGroup->delete();
    }


}
