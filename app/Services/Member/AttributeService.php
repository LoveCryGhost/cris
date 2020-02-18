<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;

class AttributeService extends MemberCoreService
{
    public $attributeRepo;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepo = $attributeRepository;
    }

    public function index()
    {
        return $this->attributeRepo->builder()->paginate(10);
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store($data)
    {
        $this->attributeRepo->builder()->create($data);
        return parent::$toast_store;
    }

    public function update($model,$data)
    {
        $attribute = $model;
        $attribute->update($data);
        return parent::$toast_update;
    }

    public function destroy($model)
    {
        $attribute = $model;
        $attribute->delete();
        return parent::$toast_destroy;
    }


}
