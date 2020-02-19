<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;
use App\Repositories\Member\TypeRepository;

class TypeService extends MemberCoreService implements MemberServiceInterface
{
    public $typeRepo;
    public $attributeRepo;

    public function __construct(TypeRepository $typeRepository, AttributeRepository $attributeRepository)
    {
        $this->typeRepo = $typeRepository;
        $this->attributeRepo = $attributeRepository;
    }

    public function index()
    {
        return $this->typeRepo->builder()->paginate(10);
    }

    public function create()
    {
        return $this->get();
    }

    public function edit()
    {

    }

    public function store($data)
    {
        $this->typeRepo->builder()->create($data);
        return parent::$toast_store;
    }

    public function update($model,$data)
    {
        $type = $model;
        $type->update($data);
        return parent::$toast_update;
    }

    public function destroy($model)
    {
        $type = $model;
        $type->delete();
        return parent::$toast_destroy;
    }


}
